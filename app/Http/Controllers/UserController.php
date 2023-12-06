<?php

namespace App\Http\Controllers;

use App\Models\Airport;
use App\Models\Flight;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $flights = Flight::all();
        $airports = Airport::all();
        $date = Carbon::now()->format('Y-m-d');
        
        if (auth()->check()) {
            if (auth()->user()->role == 'superadmin' || auth()->user()->role == 'admin') {
                abort(403, "You can't access this page");
            }
            
            // Other role checks and logic can go here

            return view('frontend.index', compact('flights', 'airports', 'date'));
        }

        return view('frontend.index', compact('flights', 'airports', 'date'));
    }

    public function flightList()
    {
        return view('user.flight-list');
    }

    // public function returnflightList()
    // {
    //     return view('user.return-flight-list');
    // }

    public function policy()
    {
        return view('user.policy');
    }

    public function about()
    {
        return view('user.about');
    }
}