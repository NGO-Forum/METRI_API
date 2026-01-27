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
    protected $description = 'Send reminder emails 3 days and 1 day before learning lab';

    public function handle()
    {
        $now = now();

        // 3 days before
        $this->sendReminder(3, $now);

        // 1 day before
        $this->sendReminder(1, $now);

        return Command::SUCCESS;
    }

    private function sendReminder(int $daysBefore, Carbon $now)
    {
        $labs = LearningLab::whereDate(
            'date',
            $now->copy()->addDays($daysBefore)->toDateString()
        )
            ->where('is_published', true)
            ->with('registrations')
            ->get();

        foreach ($labs as $lab) {
            foreach ($lab->registrations as $registration) {
                Mail::to($registration->email)
                    ->queue(new LearningLabReminderMail(
                        $lab,
                        $registration,
                        $daysBefore
                    ));
            }
        }
    }
}
