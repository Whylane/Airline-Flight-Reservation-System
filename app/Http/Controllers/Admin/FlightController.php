<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Airline;
use App\Models\Airport;
use App\Models\Flight;
use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FlightController extends Controller
{
    // public function index()
    // {
    //     $statusLabels = [
    //         0 => 'Pending',
    //         1 => 'Approved',
    //         3 => 'Rejected',
    //     ];
    
    //     $flights = Flight::whereIn('status', array_keys($statusLabels))->get();
    
    //     foreach ($flights as $flight) {
    //         $duration = $flight->duration;
    //         $formattedDuration = $this->formatDurationForDisplay($duration);
    //         $flight->formatted_duration = $formattedDuration;
    //     }
    
    //     return view('admin.flight.index', compact('flights', 'statusLabels'));
    // }

    public function index()
{
    // Get the currently authenticated admin
    $admin = Auth::user();

    $statusLabels = [
        0 => 'Pending',
        1 => 'Approved',
        3 => 'Rejected',
    ];

    // Retrieve flights added by the currently logged-in admin
    $flights = Flight::where('user_id', $admin->id)
                    ->whereIn('status', array_keys($statusLabels))
                    ->get();

    foreach ($flights as $flight) {
        $duration = $flight->duration;
        $formattedDuration = $this->formatDurationForDisplay($duration);
        $flight->formatted_duration = $formattedDuration;
    }

    return view('admin.flight.index', compact('flights', 'statusLabels'));
}

    
    public function create()
    {
        // Get the currently authenticated admin
        $admin = Auth::user();

        // Get only the airlines added by the current admin
        $airlines = Airline::where('user_id', $admin->id)->get();

        $airports = Airport::all();
        return view('admin.flight.create', compact('airlines', 'airports'));
    }

    // public function store(Request $request)
    // {
    //     // Define validation rules
    //     $rules = [
    //         'flight_type' => 'required',
    //         'origin_id' => 'required',
    //         'destination_id' => 'required',
    //         'departure_date' => 'required|date_format:Y-m-d',
    //         'departure_time' => 'required|date_format:H:i',
    //         'arrival_date' => 'required|date_format:Y-m-d',
    //         'arrival_time' => 'required|date_format:H:i',
    //         'departure_date_return' => 'nullable|date_format:Y-m-d',
    //         'arrival_date_return' => 'nullable|date_format:Y-m-d',
    //         'departure_time_return' => 'nullable|date_format:H:i',
    //         'arrival_time_return' => 'nullable|date_format:H:i',
    //         'price' => 'required|numeric',
    //         'return_price' => 'nullable|numeric',
    //         'airline_id' => 'nullable',
    //         'flight_number' => 'nullable',
    //         'return_flight_number' => 'nullable',
    //     ];
    
    //     // Apply the validation rules to the request data
    //     $request->validate($rules);
    
    // // Get the currently authenticated admin
    // $admin = Auth::user();

    // // Get the selected airline based on the provided airline_id
    // $selectedAirline = Airline::where('user_id', $admin->id)
    //     ->where('id', $request->input('airline_id'))
    //     ->first();

    //     // Retrieve the flight number and return flight number from the associated Airline model
    //     $flightNumber = $selectedAirline->flight_number;
    //     $returnFlightNumber = $selectedAirline->return_flight_number;
      
    
    //     // Create a new Flight instance
    //     $flight = new Flight([
    //         'flight_type' => $request->input('flight_type'),
    //         'origin_id' => $request->input('origin_id'),
    //         'destination_id' => $request->input('destination_id'),
    //         'departure_date' => $request->input('departure_date'),
    //         'arrival_date' => $request->input('arrival_date'),
    //         'departure_time' => $request->input('departure_time'),
    //         'arrival_time' => $request->input('arrival_time'),
    //         'departure_date_return' => $request->input('departure_date_return'),
    //         'arrival_date_return' => $request->input('arrival_date_return'),
    //         'departure_time_return' => $request->input('departure_time_return'),
    //         'arrival_time_return' => $request->input('arrival_time_return'),
    //         'price' => $request->input('price'),
    //         'return_price' => $request->input('return_price'),
    //         'airline_id' => $request->input('airline_id'),
    //         'flight_number' => $flightNumber,
    //         'return_flight_number' => $returnFlightNumber,
    //     ]);
    
    //     // Parse departure and arrival date and time as Carbon DateTime objects
    //     $departureDateTime = Carbon::parse($flight->departure_date . ' ' . $flight->departure_time);
    //     $arrivalDateTime = Carbon::parse($flight->arrival_date . ' ' . $flight->arrival_time);
    
    //     // Check if arrival time is earlier than departure time
    //     if ($arrivalDateTime < $departureDateTime) {
    //         $arrivalDateTime->addDay(); // Add a day to the arrival time
    //     }
    
    //     // Calculate the duration in seconds
    //     $durationInSeconds = $arrivalDateTime->diffInSeconds($departureDateTime);
    
    //     // Calculate days, hours, and minutes
    //     $days = floor($durationInSeconds / (60 * 60 * 24));
    //     $hours = floor(($durationInSeconds % (60 * 60 * 24)) / (60 * 60));
    //     $minutes = floor(($durationInSeconds % (60 * 60)) / 60);
    
    //     // Format the duration
    //     $duration = "";
    
    //     if ($days > 0) {
    //         $duration .= $days . 'd ';
    //     }
    
    //     if ($hours > 0) {
    //         $duration .= $hours . 'h ';
    //     }
    
    //     if ($minutes > 0) {
    //         $duration .= $minutes . 'm';
    //     }
    
    //     $flight->duration = $duration;
    
    //     // Save the Flight instance
    //     $flight->save();
    
    //     return redirect('admin/flight');
    // }
    
 
    public function store(Request $request)
    {
        // Define validation rules
        $rules = [
            'flight_type' => 'required',
            'origin_id' => 'required',
            'destination_id' => 'required',
            'departure_date' => 'required|date_format:Y-m-d',
            'departure_time' => 'required|date_format:H:i',
            'arrival_date' => 'required|date_format:Y-m-d',
            'arrival_time' => 'required|date_format:H:i',
            'departure_date_return' => 'nullable|date_format:Y-m-d',
            'arrival_date_return' => 'nullable|date_format:Y-m-d',
            'departure_time_return' => 'nullable|date_format:H:i',
            'arrival_time_return' => 'nullable|date_format:H:i',
            'price' => 'required|numeric',
            'return_price' => 'nullable|numeric',
            'airline_id' => 'nullable',
            'flight_number' => 'nullable',
            'return_flight_number' => 'nullable',
        ];
    
        // Apply the validation rules to the request data
        $request->validate($rules);
    
        // Get the currently authenticated admin
        $admin = Auth::user();
    
        // Get the selected airline based on the provided airline_id
        $selectedAirline = Airline::where('user_id', $admin->id)
            ->where('id', $request->input('airline_id'))
            ->first();
    
        // Retrieve the flight number and return flight number from the associated Airline model
        $flightNumber = $selectedAirline->flight_number;
        $returnFlightNumber = $selectedAirline->return_flight_number;

        $flight = new Flight([
            'flight_type' => $request->input('flight_type'),
            'origin_id' => $request->input('origin_id'),
            'destination_id' => $request->input('destination_id'),
            'departure_date' => $request->input('departure_date'),
            'arrival_date' => $request->input('arrival_date'),
            'departure_time' => $request->input('departure_time'),
            'arrival_time' => $request->input('arrival_time'),
            'departure_date_return' => $request->input('departure_date_return'),
            'arrival_date_return' => $request->input('arrival_date_return'),
            'departure_time_return' => $request->input('departure_time_return'),
            'arrival_time_return' => $request->input('arrival_time_return'),
            'price' => $request->input('price'),
            'return_price' => $request->input('return_price'),
            'airline_id' => $request->input('airline_id'),
            'flight_number' => $flightNumber,
            'return_flight_number' => $returnFlightNumber,
            'user_id' => $admin->id, // Assign the user_id
        ]);
    
        // Parse departure and arrival date and time as Carbon DateTime objects
        $departureDateTime = Carbon::parse($flight->departure_date . ' ' . $flight->departure_time);
        $arrivalDateTime = Carbon::parse($flight->arrival_date . ' ' . $flight->arrival_time);
    
        // Check if arrival time is earlier than departure time
        if ($arrivalDateTime < $departureDateTime) {
            $arrivalDateTime->addDay(); // Add a day to the arrival time
        }
    
        // Calculate the duration in seconds
        $durationInSeconds = $arrivalDateTime->diffInSeconds($departureDateTime);
    
        // Calculate days, hours, and minutes
        $days = floor($durationInSeconds / (60 * 60 * 24));
        $hours = floor(($durationInSeconds % (60 * 60 * 24)) / (60 * 60));
        $minutes = floor(($durationInSeconds % (60 * 60)) / 60);
    
        // Format the duration
        $duration = "";
    
        if ($days > 0) {
            $duration .= $days . 'd ';
        }
    
        if ($hours > 0) {
            $duration .= $hours . 'h ';
        }
    
        if ($minutes > 0) {
            $duration .= $minutes . 'm';
        }
    
        $flight->duration = $duration;
    
        // Save the Flight instance
        $flight->save();
    
        return redirect('admin/flight');
    }    

    public function edit($id)
    {
        $flights = Flight::find($id);
        // Get the currently authenticated admin
        $admin = Auth::user();

        // Get only the airlines added by the current admin
        $airlines = Airline::where('user_id', $admin->id)->get();
        $airports = Airport::all();
        return view('admin.flight.edit', compact('flights', 'airlines', 'airports'));
    }

    public function update(Request $request, $id)
    {
        // Retrieve the superadmin's assigned airline
        // $superadminAssignedAirline = auth()->user()->airlines()->first();

        // // Function to generate a unique flight number
        // function generateUniqueFlightNumber($airline) {
        //      // Generate a default random number
        //     $randomNumber = str_pad(rand(0, 999), 3, '0', STR_PAD_LEFT);
        //     return $airline->flight_number . $randomNumber;
        // }
 
        // $flightNumber = generateUniqueFlightNumber($superadminAssignedAirline);
        // $flightNumberReturn = generateUniqueFlightNumber($superadminAssignedAirline);
 
        // Define validation rules
        $rules = [
            'flight_type' => 'required',
            'origin_id' => 'required',
            'destination_id' => 'required',
            'departure_date' => 'required|date_format:Y-m-d',
            'departure_time' => 'required|date_format:H:i',
            'arrival_date' => 'required|date_format:Y-m-d',
            'arrival_time' => 'required|date_format:H:i',
            'departure_date_return' => 'nullable|date_format:Y-m-d',
            'arrival_date_return' => 'nullable|date_format:Y-m-d',
            'departure_time_return' => 'nullable|date_format:H:i',
            'arrival_time_return' => 'nullable|date_format:H:i',
            'price' => 'required|numeric',
            'return_price' => 'nullable|numeric',
            'airline_id' => 'nullable',
            // 'flight_number' => 'nullable',
            // 'return_flight_number' => 'nullable',
        ];

        // Apply the validation rules to the request data
        $request->validate($rules);

        $flight = Flight::find($id);
        $flight->flight_type = $request->input('flight_type');
        $flight->origin_id = $request->input('origin_id');
        $flight->destination_id = $request->input('destination_id');
        $flight->departure_date = $request->input('departure_date');
        $flight->arrival_date = $request->input('arrival_date');
        $flight->departure_time = $request->input('departure_time');
        $flight->arrival_time = $request->input('arrival_time');

        $flight->departure_date_return = $request->input('departure_date_return');
        $flight->arrival_date_return = $request->input('arrival_date_return');
        $flight->departure_time_return = $request->input('departure_time_return');
        $flight->arrival_time_return = $request->input('arrival_time_return');
        $flight->price = $request->input('price');
        $flight->return_price = $request->input('return_price');
        $flight->airline_id = $request->input('airline_id');

        // // Set the airline_id
        //  $flight->airline_id = $superadminAssignedAirline->id;

        // $flight->flight_number = $flightNumber;
        // $flight->return_flight_number = $flightNumberReturn;
        
       // Parse departure and arrival date and time as Carbon DateTime objects
        $departureDateTime = Carbon::parse($flight->departure_date . ' ' . $flight->departure_time);
        $arrivalDateTime = Carbon::parse($flight->arrival_date . ' ' . $flight->arrival_time);

        // Check if arrival time is earlier than departure time
        if ($arrivalDateTime < $departureDateTime) {
            $arrivalDateTime->addDay(); // Add a day to the arrival time
        }

        // Calculate the duration in seconds
        $durationInSeconds = $arrivalDateTime->diffInSeconds($departureDateTime);

        // Calculate days, hours, and minutes
        $days = floor($durationInSeconds / (60 * 60 * 24));
        $hours = floor(($durationInSeconds % (60 * 60 * 24)) / (60 * 60));
        $minutes = floor(($durationInSeconds % (60 * 60)) / 60);

        // Format the duration
        $duration = "";

        if ($days > 0) {
            $duration .= $days . 'd ';
        }

        if ($hours > 0) {
            $duration .= $hours . 'h ';
        }

        if ($minutes > 0) {
            $duration .= $minutes . 'm';
        }

        $flight->duration = $duration;


        $flight->update();

        return redirect('admin/flight');
    }

    private function formatDurationForDisplay($duration)
    {
        $timeComponents = explode(':', $duration);

        // Check if the exploded array contains at least two elements (hours and minutes)
        if (count($timeComponents) >= 2) {
            list($hours, $minutes) = $timeComponents;

            $days = floor($hours / 24);
            $remainingHours = $hours % 24;

            $formattedDuration = "";

            if ($days > 0) {
                $formattedDuration .= $days . 'd ';
            }

            if ($remainingHours > 0) {
                $formattedDuration .= $remainingHours . 'h ';
            }

            if ($minutes > 0) {
                $formattedDuration .= $minutes . 'm';
            }

            return trim($formattedDuration);
        }

        // If the duration format is incorrect, return the original duration as is
        return $duration;
    }


    public function report(Request $request)
    {
        $departureDate = $request->input('departure_date');
        $returnDate = $request->input('departure_date_return');
        $flightType = $request->input('flight_type');

        $departureDate = $departureDate ? Carbon::parse($departureDate)->format('Y-m-d') : now()->format('Y-m-d');
        $returnDate = $returnDate ? Carbon::parse($returnDate)->format('Y-m-d') : now()->format('Y-m-d');

        $flightsQuery = Flight::where('departure_date', '=', $departureDate);

        if ($flightType !== 'all') {
            $flightsQuery->where('flight_type', $flightType);

            if ($flightType === 'round_trip') {
                $flightsQuery->where('departure_date_return', '=', $returnDate);
            }
        }

        $flights = $flightsQuery->get();

        // If no flight type is selected or 'All' is selected, retrieve all flights
        if (empty($flightType) || $flightType === 'all') {
            $flights = Flight::all();  // No need for date conditions when 'All' is selected
        }

        $allFlights = Flight::all();
        $totalPriceAll = $allFlights->sum('price');
        $totalPriceFiltered = $flights->sum('price');

        $dateString = $request->departure_date;
        try {
            $date = Carbon::createFromFormat('Y-m-d', $dateString);
        } catch (\Exception $e) {
            $date = now();
        }

        $formattedInputDate = $date->format('M d Y, D') . ".";

        $fullyBookedPassengers = Booking::whereIn('id', $flights->pluck('id'))
            ->where('status', '1')
            ->when($flightType !== 'all', function ($query) use ($formattedInputDate) {
                $query->where('departure_date', $formattedInputDate);
            })
            ->get();

        $totalTicketAmount = $this->calculateTotalTicketAmount($fullyBookedPassengers);

        return view('admin.report.index', compact('flights', 'allFlights', 'totalPriceAll', 'totalPriceFiltered', 'fullyBookedPassengers', 'totalTicketAmount'));
    }

    private function calculateTotalTicketAmount($fullyBookedPassengers)
    {
        $totalTicketAmount = 0;

        foreach ($fullyBookedPassengers as $book) {
            $numberofPassengers = $book->adultPassengers + $book->childPassengers + $book->infantPassengers;
            $baggage_array = explode('|', $book->adds_on_baggage);
            $baggage_sum = array_sum($baggage_array);

            $seat_prices = [];
            $seat = explode('|', $book->seat);

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

            $totalTicketAmount += $book->price * $numberofPassengers + $baggage_sum + $total_seat_price;
        }

        return $totalTicketAmount;
    }

}
