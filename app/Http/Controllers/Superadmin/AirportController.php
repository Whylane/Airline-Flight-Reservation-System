<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Airport;
use Illuminate\Http\Request;

class AirportController extends Controller
{
    public function index()
    {
        $airports = Airport::all();
        return view('superadmin.airport.index', compact('airports'));
    }

    public function create()
    {
        return view('superadmin.airport.create');
    }

    public function store(Request $request)
    {
        $airports = new Airport();
        $airports->code = $request->input('code');
        $airports->airport = $request->input('airport');
        $airports->location = $request->input('location');
        $airports->save();
        return redirect('superadmin/airport-lists')->with('success', 'Airport Added Successfully');
    }

    public function edit($id)
    {
        $airports = Airport::find($id);
        return view('superadmin.airport.edit', compact('airports'));
    }

    public function update(Request $request, $id)
    {
        $airports = Airport::find($id);
        $airports->code = $request->input('code');
        $airports->airport = $request->input('airport');
        $airports->location = $request->input('location');
        $airports->code = $request->input('code');
        $airports->update();
        return redirect('superadmin/airport-lists')->with('success', 'Airport Updated Successfully');
    }
}
