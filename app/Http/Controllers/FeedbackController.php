<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{

    public function index()
    {
        $feedback = Feedback::with('user')->get();

        return view('user.feedback', compact('feedback'));
    }
    public function rateFlight(Request $request)
    {
        // Validate the request if needed
        $request->validate([
            'rating' => 'nullable|integer|min:1|max:5',
            'comment' => 'nullable|string',
        ]);
    
        // Check if the user is authenticated
        if (Auth::check()) {
            $user_id = Auth::id();
        } else {
            // Handle the case where the user is not authenticated (redirect, display an error, etc.)
            return redirect()->back()->with('error', 'You must be logged in to provide feedback.');
        }
    
        // Save the rating and comment to the database
        $rating = $request->input('rating');
        $comment = $request->input('comment');
    
        // Save the rating and comment to your database
        Feedback::create([
            'user_id' => $user_id,
            'rating' => $rating,
            'comment' => $comment,
        ]);
    
        return redirect()->back()->with('success', 'Thank you for your feedback!');
    }
    
}
