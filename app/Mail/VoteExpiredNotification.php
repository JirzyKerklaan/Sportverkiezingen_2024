<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VoteExpiredNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $vote;
    /**
     * Create a new message instance.
     */
    public function __construct($vote)
    {
        $this->vote = $vote;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Sportverkiezingen 2024 | Uw stem is verwijderd',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'email.vote-expired',
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

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->from('noreply@sportverkiezingen.nl', 'Team Sportverkiezingen 2024')
                    ->view('email.vote-expired')
                    ->with(['name' => $this->vote->name]);
    }
}
