<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Airline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AirlineController extends Controller
{  
    public function index()
    {
        // Get the currently authenticated admin
        $admin = Auth::user();

        // Get only the airlines added by the current admin
        $airlines = Airline::where('user_id', $admin->id)->get();
    
        return view('admin.airline.index', compact('airlines'));
    }

    public function create()
    {
        // Retrieve the superadmin's assigned airline
        $superadminAssignedAirline = auth()->user()->airlines()->first(); 
    
        // Generate a default random number
        $randomNumber = str_pad(rand(0, 999), 3, '0', STR_PAD_LEFT);
    
        // Combine the prefix and random number to form the complete flight number
        $completeFlightNumber = $superadminAssignedAirline->flight_number . $randomNumber;
    
        return view('admin.airline.create', compact('completeFlightNumber'));
    }
    
    public function store(Request $request)
    {
        // Validate request data
        $request->validate([
            'total_seats' => 'required|integer',
        ]);
    
        // Create a new airline instance
        $airlines = new Airline();
    
        // Set the user_id to the id of the currently authenticated user (admin)
        $airlines->user_id = auth()->user()->id;
    
        // Retrieve the superadmin's assigned airline
        $superadminAssignedAirline = auth()->user()->airlines()->first();
    
        // Set airline properties using the superadmin's assigned airline
        $airlines->logo = $superadminAssignedAirline->logo;
        $airlines->airline = $superadminAssignedAirline->airline;
    
        // Set the remaining properties
        $airlines->total_seats = $request->input('total_seats');
    
        // Retrieve the flight number prefix set by the superadmin from the database
        $adminFlightNumberPrefix = $superadminAssignedAirline->flight_number;
    
        // Add the random number to the flight number prefix
        $airlines->flight_number = $adminFlightNumberPrefix . str_pad(rand(0, 999), 3, '0', STR_PAD_LEFT);
    
        $airlines->save();
    
        // Attach the logged-in admin user to the airline
        auth()->user()->airlines()->attach($airlines->id);
    
        return redirect('admin/airline')->with('success', 'Flight Number and Seats Added Successfully');
    }
    
    
    
    
    public function edit($id)
    {
        $airlines = Airline::find($id);
        return view('admin.airline.edit', compact('airlines'));
    }


    public function update(Request $request, $id)
    {
        $airlines = Airline::find($id);

        // Set the user_id to the id of the currently authenticated user (admin)
        $airlines->user_id = auth()->user()->id;
    
        // Retrieve the superadmin's assigned airline
        $superadminAssignedAirline = auth()->user()->airlines()->first();
    
        // Set airline properties using the superadmin's assigned airline
        $airlines->logo = $superadminAssignedAirline->logo;
        $airlines->airline = $superadminAssignedAirline->airline;
    
        // Set the remaining properties
        $airlines->total_seats = $request->input('total_seats');
    
        // Retrieve the flight number prefix set by the superadmin from the database
        $adminFlightNumberPrefix = $superadminAssignedAirline->flight_number;
    
        // Add the random number to the flight number prefix
        $airlines->flight_number = $adminFlightNumberPrefix . str_pad(rand(0, 999), 3, '0', STR_PAD_LEFT);
    
        
         // Save the airline to get its ID
         $airlines->update();
     
         // Attach the logged-in admin user to the airline
         Auth::user()->airlines()->attach($airlines->id);
     
         return redirect('admin/airline')->with('success', 'Flight Number and Seats Updated Successfully');
    }
}
