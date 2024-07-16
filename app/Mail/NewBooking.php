<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewBooking extends Mailable
{
    use Queueable, SerializesModels;

    public $booking;
    public $user;

    /**
     * Create a new message instance.
     */
    public function __construct($record, $user)
    {
        $this->booking = $record;
        $this->user = $user;
//        dump($this->booking);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Booking',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.new-booking',
            with: ["booking" => $this->booking]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
//        return ["booking" => $this->booking];
        return [];
    }
}
