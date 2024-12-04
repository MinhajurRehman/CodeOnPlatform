<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ChallengeNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */

    public $challenge;
    public $action;

    public function __construct($challenge, $action = null)
    {
        $this->challenge = $challenge;
        $this->action = $action;
    }

    public function build()
    {
        $subject = $this->action === 'accepted' ? 'Challenge Accepted!' : ($this->action === 'rejected' ? 'Challenge Rejected!' : 'New Challenge!');

        return $this->from('albert.08774573829920@gmail.com', 'Challenger')
                    ->view('emails.challenge_notification')
                    ->subject($subject);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Challenge Notification Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.challenge_notification',
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