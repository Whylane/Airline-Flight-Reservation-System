<?php

namespace App\Http\Controllers;

use App\Models\Airport;
use App\Models\Flight;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $flights = Flight::where('status', '1')->get();
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

    public function policy()
    {
        return view('user.policy');
    }

    public function about()
    {
        return view('user.about');
    }
}