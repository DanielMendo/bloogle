<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        $notifications = Auth::user()->unreadNotifications;

        Auth::user()->unreadNotifications->markAsRead();

        return view('notifications.index', [
            'notifications' => $notifications
        ]);
    }
}
