<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\LearningLab;
use App\Mail\LearningLabReminderMail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class SendLearningLabReminderEmails extends Command
{
    protected $signature = 'learninglabs:send-reminders';
    protected $description = 'Send reminder emails 3 days before Learning Lab starts';

    public function handle()
    {
        $targetDate = Carbon::today()->addDays(3);

        $labs = LearningLab::whereDate('date', $targetDate)
            ->where('is_published', true)
            ->with('registrations')
            ->get();

        foreach ($labs as $lab) {
            foreach ($lab->registrations as $registration) {
                Mail::to($registration->email)
                    ->send(new LearningLabReminderMail($lab, $registration));
            }
        }

        $this->info('Learning Lab reminder emails sent.');
    }
}
