<?php

namespace App\Mail;

use App\Models\User;
use App\Models\Appointment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WelcomeEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $appointment;

    public function __construct(User $user, Appointment $appointment)
    {
        $this->user = $user;
        $this->appointment = $appointment;
    }

    public function envelope()
    {
        return new Envelope(
            subject: 'Your Free Home Audit is Scheduled — Please Prepare Your Valuables',
        );
    }

    public function content()
    {
        return new Content(
            view: 'emails.welcome',
        );
    }
}