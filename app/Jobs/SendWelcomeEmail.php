<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\Appointment;
use App\Mail\AppointmentConfirmation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendWelcomeEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    protected $appointment;

    public function __construct(User $user, Appointment $appointment = null)
    {
        $this->user = $user;
        $this->appointment = $appointment;
    }

    public function handle()
    {
        if ($this->appointment) {
            Mail::to($this->user->email)->send(new AppointmentConfirmation($this->user, $this->appointment));
        }
    }
}
