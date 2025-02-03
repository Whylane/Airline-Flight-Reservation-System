<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Airline;
use App\Models\Airport;
use App\Models\Booking;
use App\Models\Flight;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class AdminController extends Controller
{

    // public function index()
    // {
    //     // $airlines = Airline::count();
    //      // Get the currently authenticated admin
    //     $admin = Auth::user();

    //      // Get only the airlines added by the current admin
    //     $airlines = Airline::where('user_id', $admin->id)->count();
     
    //     $flights = Flight::count();
    //     $airports = Airport::count();
    //     $totalPassengers = Booking::sum('adultPassengers') + Booking::sum('childPassengers') + Booking::sum('infantPassengers');
    //     $tickets = Booking::all();
    //     $totalTicketAmount = $this->calculateTotalTicketAmount($tickets);
    
    //     // Retrieve updated data after delaying a flight
    //     $todayFlights = Flight::whereDate('departure_date', Carbon::today())->get();

    //     // Remove the delayed flights from today's flights
    //     $delayedFlights = collect(Session::get('delayed_flights', []));
    //     $todayFlights = $todayFlights->reject(function ($todayFlight) use ($delayedFlights) {
    //         return $delayedFlights->contains('id', $todayFlight->id);
    //     });

    //     return view('admin.index', compact('airlines', 'flights', 'airports', 'todayFlights', 'delayedFlights', 'totalPassengers', 'totalTicketAmount'));
    // }

    public function index()
    {
        // Get the currently authenticated admin
        $admin = Auth::user();
    
        // Get only the airlines added by the current admin
        $airlines = Airline::where('user_id', $admin->id)->count();
    
        $flights = Flight::count();
        $airports = Airport::count();
    
        // Retrieve the bookings associated with the admin's assigned airline
        $tickets = Booking::whereHas('airline', function ($query) use ($admin) {
            $query->where('user_id', $admin->id);
        })->get();
    
        // Calculate the total number of passengers
        $totalPassengers = $this->calculateTotalPassengers($tickets);
    
        $totalTicketAmount = $this->calculateTotalTicketAmount($tickets);
    
        // Retrieve updated data after delaying a flight
        $todayFlights = Flight::whereDate('departure_date', Carbon::today())->get();
    
        // Remove the delayed flights from today's flights
        $delayedFlights = collect(Session::get('delayed_flights', []));
        $todayFlights = $todayFlights->reject(function ($todayFlight) use ($delayedFlights) {
            return $delayedFlights->contains('id', $todayFlight->id);
        });
    
        return view('admin.index', compact('airlines', 'flights', 'airports', 'todayFlights', 'delayedFlights', 'totalPassengers', 'totalTicketAmount'));
    }    

    private function calculateTotalPassengers($tickets)
    {
        $totalPassengers = 0;

        foreach ($tickets as $ticket) {
            $totalPassengers += $ticket->adultPassengers + $ticket->childPassengers + $ticket->infantPassengers;
        }

        return $totalPassengers;
    }
    
    public function delayFlight(Request $request, $flightId)
    {
        $flight = Flight::findOrFail($flightId);
    
        // Retrieve today's flights from the session
        $todayFlights = Flight::whereDate('departure_date', Carbon::today())->get();
    
        // Check if the flight is in today's flights before removing it
        $todayFlights = $todayFlights->reject(function ($todayFlight) use ($flightId) {
            return $todayFlight->id == $flightId;
        });
    
        // Update today's flights session
        Session::put('today_flights', $todayFlights->all());
    
        // Retrieve delayed flights from the session
        $delayedFlights = collect(Session::get('delayed_flights', []));
    
        // Check if the flight is already delayed before adding it
        $isAlreadyDelayed = $delayedFlights->contains('id', $flightId);
    
        if (!$isAlreadyDelayed) {
            // Add the delayed flight to the session for display in the "Today's Flight Issues" table
            $delayedFlights->push($flight);
            Session::put('delayed_flights', $delayedFlights->all());
        }
    
        // Redirect back or to the issues page
        return redirect()->back();
    }
    
    public function moveFlight(Request $request, $flightId)
    {
        // Retrieve the delayed flight from the session
        $delayedFlights = collect(Session::get('delayed_flights', []));
        $flight = $delayedFlights->where('id', $flightId)->first();
    
        // Handle the case where the flight is not found
        if (!$flight) {
            return redirect()->back()->with('error', 'Flight not found in delayed flights.');
        }
    
        // Remove the flight from the delayed flights in the session
        $delayedFlights = $delayedFlights->reject(function ($delayedFlight) use ($flightId) {
            return $delayedFlight['id'] == $flightId;
        });
        Session::put('delayed_flights', $delayedFlights->all());
    
        $todayFlights = collect(Session::get('today_flights', []));
        $todayFlights->push($flight);
        Session::put('today_flights', $todayFlights->all());
    
        // Redirect back or to the today's flights page
        return redirect()->back();
    }
  
    // private function calculateTotalTicketAmount($tickets)
    // {
    //     $totalTicketAmount = 0;

    //     foreach ($tickets as $ticket) {
    //         $numberofPassengers = $ticket->adultPassengers + $ticket->childPassengers + $ticket->infantPassengers;
    //         $baggage_array = explode('|', $ticket->adds_on_baggage);
    //         $baggage_sum = array_sum($baggage_array);

    //         $seat_prices = [];
    //         $seat = explode('|', $ticket->seat);

    //         for ($i = 1; $i <= $numberofPassengers; $i++) {
    //             if (in_array($seat[$i - 1], ["A1", "A2", "A3", "A4", "A5", "A6"])) {
    //                 $seat_prices[] = 390;
    //             } elseif (in_array($seat[$i - 1], ["B1", "B2", "B3", "B4", "B5", "B6"])) {
    //                 $seat_prices[] = 245;
    //             } else {
    //                 $seat_prices[] = 200;
    //             }
    //         }

    //         $total_seat_price = array_sum($seat_prices);

    //         $totalTicketAmount += $ticket->price * $numberofPassengers + $baggage_sum + $total_seat_price;
    //     }

    //     return $totalTicketAmount;
    // }

    private function calculateTotalTicketAmount($tickets)
{
    $totalTicketAmount = 0;

    foreach ($tickets as $ticket) {
        $numberofPassengers = $ticket->adultPassengers + $ticket->childPassengers + $ticket->infantPassengers;
        $baggage_array = explode('|', $ticket->adds_on_baggage);
        $baggage_sum = array_sum($baggage_array);

        $seat_prices = [];
        $seat = explode('|', $ticket->seat);

        for ($i = 1; $i <= $numberofPassengers; $i++) {
            if (in_array($seat[$i - 1], ["A1", "A2", "A3", "A4", "A5", "A6"])) {
                $seat_prices[] = 390;
            } elseif (in_array($seat[$i - 1], ["B1", "B2", "B3", "B4", "B5", "B6"])) {
                $seat_prices[] = 245;
            } else {
                $seat_prices[] = 200;
            }
        }

        $total_seat_price = array_sum($seat_prices);

        $totalTicketAmount += $ticket->price * $numberofPassengers + $baggage_sum + $total_seat_price;
    }

    return $totalTicketAmount;
}
}
