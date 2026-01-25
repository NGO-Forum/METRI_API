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

        // ===== 3 DAYS BEFORE =====
        $this->sendReminder(
            daysBefore: 3,
            sentColumn: 'reminder_3d_sent_at',
            now: $now
        );

        // ===== 1 DAY BEFORE =====
        $this->sendReminder(
            daysBefore: 1,
            sentColumn: 'reminder_1d_sent_at',
            now: $now
        );

        return Command::SUCCESS;
    }

    private function sendReminder(int $daysBefore, string $sentColumn, Carbon $now)
    {
        $targetStart = $now->copy()->addDays($daysBefore)->startOfDay();
        $targetEnd   = $now->copy()->addDays($daysBefore)->endOfDay();

        $labs = LearningLab::whereBetween('date', [$targetStart, $targetEnd])
            ->whereNull($sentColumn)
            ->where('is_published', true)
            ->with('registrations')
            ->get();

        foreach ($labs as $lab) {
            foreach ($lab->registrations as $registration) {
                Mail::to($registration->email)
                    ->queue(new LearningLabReminderMail($lab, $registration, $daysBefore));
            }

            // Mark reminder as sent
            $lab->update([
                $sentColumn => now(),
            ]);
        }
    }
}
