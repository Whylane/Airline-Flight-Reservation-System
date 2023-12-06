<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function getUserNotifications()
    {
        $users = User::whereIn('role', ['user'])->get();

        // Check if the $users collection is not empty
        if ($users->isNotEmpty()) {
            $isNewUser = now()->diffInDays($users->last()->created_at) <= 1;
            $newUserCount = $isNewUser ? $users->count() : 0;
        } else {
            $isNewUser = false;
            $newUserCount = 0;
        }

        return compact('isNewUser', 'users', 'newUserCount');
    }
}
