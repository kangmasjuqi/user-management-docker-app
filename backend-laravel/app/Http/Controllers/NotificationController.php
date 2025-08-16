<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Jobs\SendBulkEmailNotification;

class NotificationController extends Controller
{
    public function sendNotif()
    {
        $user_ids = [1, 2, 3, 4, 5]; // Example user IDs to send notifications to

        // Dispatch job to RabbitMQ queue 
        SendBulkEmailNotification::dispatch(
            $user_ids,
            "Welcome to Our Platform!",
            "Thank you for joining us. Your account has been successfully created.",
            "success"
        );

        return response()->json([
            'status' => 'success',
            'message' => 'Bulk email notifications queued for processing'
        ]);
    }
}