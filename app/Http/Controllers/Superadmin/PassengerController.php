<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Mail\FlightApproved;
use App\Mail\FlightCanceled;
use App\Models\Booking;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;

class PassengerController extends Controller
{
    public function index()
    {
        $tickets = Booking::where('status', '0')->get(); 
        return view('superadmin.passenger.index', compact('tickets'));
    }

    public function show($id)
    {
        $ticket = Booking::findOrFail($id);
        $tickets = [$ticket];
        return view('superadmin.passenger.details', compact('tickets'));
    }
   
    private function generatePDF($ticket, $additionalData) {
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);

        $dompdf = new Dompdf($options);
        $html = view('pdf.approval', compact('ticket'))->render();

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        return $dompdf;
    }

    public function updateTicket(Request $request, $id)
    {
        $ticket = Booking::findOrFail($id);
        $numberofPassengers = $ticket->adultPassengers + $ticket->childPassengers + $ticket->infantPassengers;
        $previousStatus = $ticket->status; // Store the previous status for comparison
        $ticket->status = $request->status;
        $ticket->save();

        $additionalData = [
            'email' => auth()->user()->email,
            'name' => $request->name,
            'booking_date' => Carbon::now()->toFormattedDateString(),
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
            'firstNames' => $request->first_name,
            'lastNames' => $request->last_name,
            'flightType' => $request->flight_type,
            'numberofPassengers' => $numberofPassengers,
        ];

        if ($request->status == 1 && $previousStatus != 1) {
            // Send approval email to the passenger
            Mail::to($ticket->user->email)->send(new FlightApproved($ticket, $additionalData));

            
        } elseif ($request->status == 2 && $previousStatus != 2) {
            // Send cancellation email to the passenger
            $reason = $request->input('cancellation_reason');
            Mail::to($ticket->user->email)->send(new FlightCanceled($ticket, $reason));
        }

        return redirect('superadmin/passenger-history')->with('success', 'Reservation Updated Successfully');
    }

    public function history()
    {
        $tickets = Booking::whereIn('status', ['1', '2'])->get();
        return view('superadmin.passenger.history', compact('tickets'));
    }
    
}
