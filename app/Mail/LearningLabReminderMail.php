<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;

class LearningLabReminderMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(
        public $lab,
        public $registration,
        public int $daysBefore
    ) {}

    public function build()
    {
        return $this->subject('Learning Lab Registration Confirmation & Reminder')
            ->view('emails.learning_lab_reminder');
    }
}
