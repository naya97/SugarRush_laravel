<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function showNotifications() {
        $user = Auth::user();
        if(!$user) {

            return response()->json(['message' => 'you have to login/signup again']);
        }
       
        return response()->json([$user->notifications,200]);
    }

    public function readNotifications() {
        $user = Auth::user();
        if(!$user) {

            return response()->json(['message' => 'you have to login/signup again']);
        }

        if ($user->notifications) { 
            $user->notifications->markAsRead(); 
            return response()->json(['message' => 'Notification marked as read']);
        }
       
        // return response()->json([$user->readNotifications,200]);
    }

    public function unreadNotifications() {
        $user = Auth::user();
        if(!$user) {

            return response()->json(['message' => 'you have to login/signup again']);
        }
       
        return response()->json([$user->unreadNotifications,200]);
    }
}
