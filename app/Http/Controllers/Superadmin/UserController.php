<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Airline;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function addAdmin()
    {
        $superadmin = Auth::user();
        $airlines = Airline::where('user_id', $superadmin->id)->get();
        return view('superadmin.user.create', compact('airlines'));
    }

    public function storeAdmin(Request $request)
    {
        // Validate request data
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'airline_id' => 'required|exists:airlines,id',
        ]);
    
        // Check if there is already an admin assigned to the selected airline
        $existingAdmin = User::where('role', 'admin')
            ->whereHas('airlines', function ($query) use ($request) {
                $query->where('airlines.id', $request->input('airline_id'));
            })
            ->first();
    
        if ($existingAdmin) {
            return redirect('superadmin/add-admin')
                ->with('error', 'Selected airline already assigned to another admin');
        }
    
        // Create a new user
        $user = new User();
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->role = 'admin';
        $user->save();
    
        // Assign the selected airline to the user
        $airline = Airline::findOrFail($request->input('airline_id'));
        $user->airlines()->sync($airline);
    
        return redirect('superadmin/user-lists')->with('success', 'Admin added successfully');
    }
    
}
