<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Airline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AirlineController extends Controller
{
    public function index()
    {
        // // Get the currently authenticated superadmin
        // $superadmin = Auth::user();
    
        // // Get all airlines added by the superadmin with ID 3
        // $airlines = Airline::where('user_id', $superadmin->id)->get();
        $airlines = Airline::with('users')->get();
        return view('superadmin.airline.index', compact('airlines'));
    }
    
    
    public function create()
    {
        return view('superadmin.airline.create');
    }

    public function store(Request $request)
    {
        // Validate request data
        $request->validate([
            'logo' => 'image|mimes:jpeg,png,jpg|unique:airlines,logo',
            'airline' => 'required|unique:airlines,airline',
            'flight_number' => 'required|string|size:2',
        ], [
            'airline.unique' => 'The airline has already been added. Please input another airline.',
            'flight_number.size' => 'The flight number prefix must be exactly 2 characters.',
        ]);
    
        $airlines = new Airline();
    
        // Set the user_id to the id of the currently authenticated user (superadmin)
        $airlines->user_id = auth()->user()->id;
    
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('assets/upload/airline/', $filename);
            $airlines->logo = $filename;
        }
    
        $airlines->airline = $request->input('airline');
        $airlines->flight_number = $request->input('flight_number');
    
        $airlines->save();
    
        return redirect('superadmin/airline-lists')->with('success', 'Airline Added Successfully');
    }
    
 
    public function edit($id)
    {
        $airlines = Airline::find($id);
        return view('superadmin.airline.edit', compact('airlines'));
    }

    public function update(Request $request, $id)
    {
        $airlines = Airline::find($id);
        if ($request->hasFile('logo')) {
            $path = 'assets/upload/airline/' .$airlines->logo;
            if (File::exists($path))
            $file = $request->file('logo');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('assets/upload/airline/', $filename);
            $airlines->logo = $filename;
        }

        $airlines->airline = $request->input('airline');

        $airlines->flight_number = $request->input('flight_number');
     
        $airlines->update();
        return redirect('superadmin/airline-lists')->with('success', 'Airline Updated Successfully');
    }

    // public function view($id)
    // {
      

    //     // Get only the airlines added by the current admin using the relationship
    //     $airlines = Airline::all();
    //     dd($airlines);
    //     return view('superadmin.airline.view', compact('airlines'));
    // }
    
    
    
    
    
}
