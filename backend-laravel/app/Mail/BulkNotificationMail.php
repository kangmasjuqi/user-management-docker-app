<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BulkNotificationMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public User $user;
    public string $emailSubject;
    public string $emailMessage;
    public string $template;

    /**
     * Create a new message instance.
     */
    public function __construct(User $user, string $subject, string $message, string $template = 'default')
    {
        $this->user = $user;
        $this->emailSubject = $subject;
        $this->emailMessage = $message;
        $this->template = $template;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->emailSubject,
            from: config('mail.from.address', 'noreply@yourapp.com'),
            replyTo: config('mail.reply_to.address', 'support@yourapp.com')
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.bulk-notification',
            with: [
                'user' => $this->user,
                'message_content' => $this->emailMessage,
                'template' => $this->template,
                'appName' => config('app.name', 'Your App'),
                'appUrl' => config('app.url', 'https://yourapp.com')
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}