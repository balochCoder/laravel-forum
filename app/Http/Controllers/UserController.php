<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function notifications()
    {
        Auth::user()->unreadNotifications->markAsRead();

        return view('users.notifications',[
            'notifications'=>Auth::user()->notifications
        ]);
    }
}
