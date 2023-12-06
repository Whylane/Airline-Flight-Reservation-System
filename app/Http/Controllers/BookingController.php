<?php

namespace App\Http\Controllers;

use App\Mail\ReceiptMail;
use App\Models\Booking;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\Airline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $last_name = $request->input('last_name');
        $first_name = $request->input('first_name');
        $middle_initial = $request->input('middle_initial');
        $contact_number = $request->input('contact_number');
        $address = $request->input('address');
        $date_of_birth = $request->input('date_of_birth');
        $pwd = $request->input('pwd') ;
        $special_assistance_type = $request->input('inputs') ;


      $numberofPassengers = $request->input('adultPassengers') +  $request->input('childPassengers') + $request->input('infantPassengers');


      for ($i = 1; $i <= $numberofPassengers; $i++) {
        $specialAssistance[]  = $request->input("special_asssitance{$i}")[0] ?? null;
        $adds_on_baggage[]  = $request->input("adds_on_baggage{$i}")[0] ?? null;

        $ticket_id[] = $this->generateTicketID();


        if (is_null($request->seat)) {
            $seat[] = $this->generateRandomSeat();
        } else {
            $seat = $request->input('seat');
        }
    }

        $totalSeats = DB::table('airlines')->where('airline', $request->input('airline'))->pluck('total_seats')->first();
        $availableSeats = max(0, $totalSeats - $numberofPassengers);
        DB::table('airlines')->where('airline', $request->input('airline'))->update(['total_seats' => $availableSeats]);
        // Fetch the 'flight_number' from the selected airline
        $airline = Airline::where('airline', $request->input('airline'))->first();
        $flightNumber = $airline ? $airline->flight_number : null;
 
        $booking = Booking::create([
            'user_id' => auth()->user()->id,
            'flight_type' => $request->input('flight_type'),
            'airline' => $request->input('airline'),
            'flight_number' => $flightNumber, 
            'departure_date' => $request->input('departure_date'),
            'arrival_date' => $request->input('arrival_date'),
            'duration' => $request->input('duration'),
            'price' => $request->input('price'),
            'adultPassengers' => $request->input('adultPassengers'),
            'childPassengers' => $request->input('childPassengers'),
            'infantPassengers' => $request->input('infantPassengers'),
            'originAirportCode' => $request->input('originAirportCode'),
            'destinationAirportCode' => $request->input('destinationAirportCode'),
            'destinationAirportLocation' => $request->input('destinationAirportLocation'),
            'originAirportName' => $request->input('originAirportName'),
            'destinationAirportName' => $request->input('destinationAirportName'),
            'originAirportLocation' => $request->input('originAirportLocation'),
            'departureTime' => $request->input('departureTime'),
            'arrivalTime' => $request->input('arrivalTime'),
            'seat' => /* $this->generateRandomSeat(), */implode('|',$seat),
            'last_name' => implode('|',$last_name),
            'first_name' => implode('|',$first_name),
            'middle_initial' => implode('|',$middle_initial),
            'contact_number' => implode('|',$contact_number),
            'address' => implode('|',$address),
            'date_of_birth' => implode('|',$date_of_birth),
            'pwd' => !empty($pwd) ? implode('|', $pwd) : null,
            'special_asssitance' =>  implode('|',$specialAssistance),
            'special_assistance_type' => !empty($special_assistance_type) ? implode('|', $special_assistance_type) : null,
            'adds_on_baggage' =>   implode('|',$adds_on_baggage),
            'seatClass' => $request->input('seatClass'),
            'gate' => $this->generateRandomGate(),
            'ticket_id' =>  implode('|',$ticket_id),
            'cancel' => $request->input('cancel'),
            'booking_id' => $request->input('booking_id'),
        ]);

            $bookingId = $booking->id;
            $showUrl = route('tickets.index', ['id' => $bookingId]);

            $numberofPassengers = $request->adultPassengers + $request->childPassengers + $request->infantPassengers;

            $data = [
                'email' => auth()->user()->email,
                'name' => $request->name,
                'booking_date' =>Carbon::now()->toFormattedDateString(),
                'booking_id' => $request->booking_id,
                'origin_code' => $request->originAirportCode,
                'destination_code' => $request->destinationAirportCode,
                'departure_date' => $request->departure_date,
                'departureTime' => $request->departureTime,
                'originAirportLocation' => $request->originAirportLocation,
                'destinationAirportLocation' => $request->destinationAirportLocation,
                'destinationAirportName' => $request->destinationAirportName,
                'originAirportName' => $request->originAirportName,
                'departure_date_return' => $request->departure_date_return,
                'departureTimeReturn' => $request->departureTimeReturn,
                'arrivalTimeReturn' => $request->arrivalTimeReturn,
                'arrival_date_return' => $request->arrival_date_return,
                'arrivalTime' => $request->arrivalTime,
                'arrival_date' => $request->arrival_date,
                'numberofPassengers' =>$numberofPassengers,
                'firstNames' =>$request->first_name,
                'lastNames' =>$request->last_name,
                'flightType' =>$request->flight_type,
            ];


            // Or log it using Laravel's Log facade
// Log::info($emailContent);

            // Mail::to($data['email'])->send(new ApproveScheduleEmail($data));

            Mail::to($data['email'])->send(new ReceiptMail($booking, $data));


        return redirect($showUrl);
    }

    private function generatePDF($booking, $data) {
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);

        $dompdf = new Dompdf($options);
        $html = view('emails.receipt', compact('booking'))->render();

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        return $dompdf;
    }

     /* Seat */
     public function generateRandomSeat()
     {
         $rows = ['C', 'D'];
         $columns = ['1', '2', '3', '4', '5'];

         $randomRow = array_rand($rows);
         $randomColumn = array_rand($columns);

         $randomSeat = $rows[$randomRow] . $columns[$randomColumn];

         return $randomSeat;
     }

    /* tikcet id */
    function generateTicketID($length = 10) {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $ticketID = '';
        $maxIndex = strlen($characters) - 1;

        for ($i = 0; $i < $length; $i++) {
            $ticketID .= $characters[mt_rand(0, $maxIndex)];
        }

        return $ticketID;
    }

    /* Gate */
    function generateRandomGate() {
        // Define characters for gates
        $characters = 'ABCDEFGHI';
        $numbers = '123456789';

        // Generate random character from 'A' to 'I'
        $randomChar = $characters[rand(0, strlen($characters) - 1)];

        // Generate random number from '1' to '9'
        $randomNumber = $numbers[rand(0, strlen($numbers) - 1)];

        // Concatenate the random character and number to form the gate
        $randomGate = $randomChar . $randomNumber;

        return $randomGate;
    }

    /* Cancel flight */

    public function cancelFlight(Request $request)
    {
       Booking::where('id', $request->id)->update([
            'status' => 2,
        ]);

        return redirect('myFlights');
    }

    public function rebookFlight(Request $request)
    {
        Booking::where('id', $request->id)->update([
            'status' => 0,
        ]);
    
        return redirect('myFlights');
    }
    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        //
    }
}
