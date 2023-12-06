<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Airport;
use Illuminate\Http\Request;

class AirportController extends Controller
{
    public function index()
    {
        $airports = Airport::all();
        return view('admin.airport.index', compact('airports'));
    }

    public function create()
    {
        return view('admin.airport.create');
    }

    public function store(Request $request)
    {
        $airports = new Airport();
        $airports->code = $request->input('code');
        $airports->airport = $request->input('airport');
        $airports->location = $request->input('location');
        $airports->save();
        return redirect('admin/airport');
    }

    public function edit($id)
    {
        $airports = Airport::find($id);
        return view('admin.airport.edit', compact('airports'));
    }

    public function update(Request $request, $id)
    {
        $airports = Airport::find($id);
        $airports->code = $request->input('code');
        $airports->airport = $request->input('airport');
        $airports->location = $request->input('location');
        $airports->code = $request->input('code');
        $airports->update();
        return redirect('admin/airport');
    }
}
