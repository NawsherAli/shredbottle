<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function markAsRead(Request $request, $id)
    {	
    	// dd($id);
        $notification = auth()->user()->notifications()->where('id', $id)->first();

        if ($notification) {
            $notification->markAsRead();
            return response()->json(['message' => 'Notification marked as read.']);
        } else {
            return response()->json(['error' => 'Notification not found.'], 404);
        }
    }
}
