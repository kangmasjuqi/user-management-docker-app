<?php

namespace App\Jobs;

use App\Mail\BulkNotificationMail;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendBulkEmailNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public array $userIds,
        public string $subject,
        public string $message,
        public string $template
    ) {}

    public function handle(): void
    {
        $users = User::whereIn('id', $this->userIds)->get();
        
        foreach ($users as $user) {
            Mail::to($user->email)->queue(
                (new BulkNotificationMail($user, $this->subject, $this->message, $this->template))
                    ->onQueue('emails_bulk_notifications')
            );
        }
    }
}