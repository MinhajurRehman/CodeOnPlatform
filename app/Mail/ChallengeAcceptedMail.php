<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ChallengeAcceptedMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $challenge;
    public $url;

    public function __construct($challenge, $url)
    {
        $this->challenge = $challenge;
        $this->url = $url;
    }

    public function build()
    {
        return $this->from('albert.08774573829920@gmail.com', 'Challenger')
                    ->view('emails.challenge_accepted')
                    ->subject('Your Challenge Was Accepted!')
                    ->with([
                        'url' => $this->url,
                        'receiverName' => $this->challenge->receiver->name,
                    ]);
    }


    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Challenge Accepted Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.challenge_accepted',
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