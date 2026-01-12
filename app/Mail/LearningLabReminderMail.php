<?php

namespace App\Mail;

use App\Models\LearningLab;
use App\Models\LearningLabRegistration;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LearningLabReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $lab;
    public $registration;

    public function __construct(LearningLab $lab, LearningLabRegistration $registration)
    {
        $this->lab = $lab;
        $this->registration = $registration;
    }

    public function build()
    {
        return $this->subject('Learning Lab Registration Confirmation & Reminder')
            ->view('emails.learning_lab_reminder');
    }
}
