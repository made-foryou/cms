<?php

namespace Made\Cms\Analytics\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Maatwebsite\Excel\Facades\Excel;
use Made\Cms\Analytics\Enums\VisitSavingStrategy;
use Made\Cms\Analytics\Exports\PastVisitsLogExport;

class LogsBackupGeneratedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        protected readonly VisitSavingStrategy $strategy,
    ) {}

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->greeting('Hello ' . $notifiable->name)
            ->line('Here is a new backup with past visit logs. These have also been removed from the database.')
            ->salutation('Made CMS')
            ->attach(Excel::download(new PastVisitsLogExport($this->strategy), 'past-visits.xlsx'));
    }

    public function toArray($notifiable): array
    {
        return [];
    }
}
