<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserNotificationsController extends Controller
{
    public function index()
    {
        return auth()->user()->unreadNotifications;
    }

}
