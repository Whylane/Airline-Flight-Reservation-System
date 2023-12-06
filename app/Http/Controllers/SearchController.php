<?php

namespace App\Http\Controllers;

use App\Models\Airline;
use App\Models\Booking;
use App\Models\Flight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function searchResults(Request $request)
    {
        $queryOrigin = $request->input('origin_id');
        $queryDestination = $request->input('destination_id');
        $queryDeparture = $request->input('departure_date');
        $queryDepartureReturn = $request->input('departure_date_return');
        $queryArrivalReturn = $request->input('arrival_date_return');
        $queryArrival = $request->input('arrival_date');
        $queryAdultPassenger = $request->input('adultPassengers');
        $querySeatClass = $request->input('seatClassRoundtrip');
        $queryFlightType = $request->input('flight_type');

        $originAirport = DB::table('airports')
                            ->select('code', 'airport', 'location')
                            ->where('id', $queryOrigin)
                            ->first();
        // destination
        $destinationAirport = DB::table('airports')
                            ->select('code', 'airport', 'location')
                            ->where('id', $queryDestination)
                            ->first();

        if ($originAirport) {
            $originAirportCode = $originAirport->code;
            $originAirportName = $originAirport->airport;
            $originAirportLocation = $originAirport->location;
        } else {
            // Handle case where airport with given ID is not found
            dd('origin airport not found');
        }

        if ($destinationAirport) {
            $destinationAirportCode = $destinationAirport->code;
            $destinationAirportName = $destinationAirport->airport;
            $destinationAirportLocation = $destinationAirport->location;
        } else {
            // Handle case where airport with given ID is not found
            dd('destination airport not found');
        }

        $results = Flight::where('origin_id', 'like', '%' . $queryOrigin . '%')
        ->where('destination_id', 'like', '%' . $queryDestination . '%')
        ->where('flight_type', 'like', '%' . $queryFlightType . '%')
        ->where('departure_date', 'like', '%' . $queryDeparture . '%')
        ->when($queryFlightType === 'round_trip', function ($query) use ($queryDepartureReturn) {
            return $query->where('departure_date_return', 'like', '%' . $queryDepartureReturn . '%');
        })
        ->where('status', '1') // Add this condition for approved flights
        ->get();



        /* get the number of adult, child and infants in query */
         $adult = $request->adultPassengers;
         $child = $request->childPassengers;
         $infant = $request->infantPassengers;


        // Redirect to a results page and pass the search results
        return view('user.flight-list', compact('results', 'querySeatClass', 'adult', 'child', 'infant',
            'originAirportCode', 'queryDeparture', 'queryArrival',  'originAirportLocation', 'destinationAirportCode',
             'destinationAirportLocation','queryFlightType'
        ));
    }

    public function passengerDetails(Request $request, $id)
    {
        $queryFlightType = $request->input('flight_type');
        $queryOrigin = $request->input('origin_id');
        $queryDestination = $request->input('destination_id');
        $queryDeparture = $request->input('departure_date');
        $queryArrival = $request->input('arrival_date');
        $querySeatClass = $request->input('seatClass');


        if($queryFlightType === "one_way") {
            $selected_departure = Flight::where('id', $request->selected_flight)->get();
            $selected_return = [];
        } else {
            $selected_departure = Flight::where('id', $request->selected_departure)->get();
            $selected_return = Flight::where('id', $request->selected_return)->get();
        }

        // retrieving the airport data
        $flight = Flight::find($id);

       $origin =  $selected_departure->pluck('origin_id')->firstOrFail();
       $destination =  $selected_departure->pluck('destination_id')->firstOrFail();


        if ($flight) {
            // origin
            $originAirport = DB::table('airports')
                            ->select('code', 'airport', 'location')
                            ->where('id', $origin)
                            ->first();
            // destination
            $destinationAirport = DB::table('airports')
                            ->select('code', 'airport', 'location')
                            ->where('id', $destination)
                            ->first();

            // departure time
            $departureTime =  $flight->departure_time;
            // arrival time
            $arrivalTime =  $flight->arrival_time;

            if ($originAirport) {
                $originAirportCode = $originAirport->code;
                $originAirportName = $originAirport->airport;
                $originAirportLocation = $originAirport->location;
            } else {
                // Handle case where airport with given ID is not found
                dd('origin airport not found');
            }

            if ($destinationAirport) {
                $destinationAirportCode = $destinationAirport->code;
                $destinationAirportName = $destinationAirport->airport;
                $destinationAirportLocation = $destinationAirport->location;
            } else {
                // Handle case where airport with given ID is not found
                dd('destination airport not found');
            }

        } else {
            // Handle case where flight with given ID is not found
            dd('flight not found');
        }


        try {
            $result = Flight::where('origin_id', $queryOrigin)
                        ->where('destination_id', $queryDestination)
                        ->where('departure_date', $queryDeparture)
                        ->where('arrival_date', $queryArrival)
                        ->findorFail($id);
        /* get the number of adult, child and infants in query */
         $adult = $request->adultPassengers;
         $child = $request->childPassengers;
         $infant = $request->infantPassengers;

         $seats = [
            'A1', 'A2', 'A3', 'A4', 'A5', 'A6',
            'B1', 'B2', 'B3', 'B4', 'B5', 'B6',
            'C1', 'C2', 'C3', 'C4', 'C5', 'C6',
            'D1', 'D2', 'D3', 'D4', 'D5', 'D6'
            // ... other seats
        ];
        // dd($result);


         $acquiredSeats = Booking::where('originAirportCode', $originAirportCode)->where('destinationAirportCode', $destinationAirportCode)->pluck('seat')->toArray();

            return view('user.booking-steps.passenger-details', compact(
                'originAirport', 'destinationAirport',
                'flight', 'queryFlightType',
                'originAirportName',  'originAirportLocation', 'destinationAirportName', 'originAirportName',
                'destinationAirportName', 'acquiredSeats',
                'destinationAirportLocation', 'seats', 'querySeatClass',
                'selected_departure', 'selected_return',
                'result', 'departureTime', 'arrivalTime', 'adult', 'child', 'infant', 'originAirportCode', 'destinationAirportCode'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // User not found
            abort(404, 'Resource not found');
        }
    }
}