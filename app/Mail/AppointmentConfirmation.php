<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AppointmentConfirmation extends Mailable
{
    public function __construct(public Appointment $appointment)
    {}

    public function build()
    {
        return $this->subject('Your Free Home Audit is Scheduled')
                    ->markdown('emails.appointment-confirmation');
    }
}
