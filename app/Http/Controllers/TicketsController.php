<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class TicketsController extends Controller
{
    public function index()
    {
        $tickets = Booking::where('user_id', auth()->user()->id)->latest()->get();
        return view('user.tickets.index', compact('tickets'));
    }

    // public function show($id) {
    //     $ticket = Booking::find($id);
    //     return view('user.tickets.show',   compact('ticket'));
    // }
}
