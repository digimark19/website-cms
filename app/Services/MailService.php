<?php

namespace App\Services;

use Illuminate\Support\Facades\Mail;
use App\Mail\ContactNotificationAdmin;
use App\Mail\ContactAcknowledgementUser;
use App\Mail\NewsletterNotificationAdmin;
use App\Mail\NewsletterAcknowledgementUser;
use App\Models\SiteSetting;

class MailService
{
    /**
     * Send contact form notifications.
     *
     * @param array $data
     * @return void
     */
    public function sendContactNotifications(array $data)
    {
        $settings = SiteSetting::first();
        $adminEmail = $settings->notification_email ?? config('mail.from.address');
        $ccEmails = [];

        if (!empty($settings->notification_cc)) {
            $ccEmails = array_map('trim', explode(',', $settings->notification_cc));
            $ccEmails = array_filter($ccEmails, fn($email) => filter_var($email, FILTER_VALIDATE_EMAIL));
        }

        // 1. Notificación al Administrador
        $mailAdmin = Mail::to($adminEmail);
        if (!empty($ccEmails)) {
            $mailAdmin->cc($ccEmails);
        }
        $mailAdmin->send(new ContactNotificationAdmin($data));

        // 2. Notificación al Usuario
        if (!empty($data['correo'])) {
            Mail::to($data['correo'])->send(new ContactAcknowledgementUser($data));
        }
    }

    /**
     * Send newsletter subscription notifications.
     *
     * @param array $data
     * @return void
     */
    public function sendNewsletterNotifications(array $data)
    {
        $settings = SiteSetting::first();
        $adminEmail = $settings->notification_email ?? config('mail.from.address');
        $ccEmails = [];

        if (!empty($settings->notification_cc)) {
            $ccEmails = array_map('trim', explode(',', $settings->notification_cc));
            $ccEmails = array_filter($ccEmails, fn($email) => filter_var($email, FILTER_VALIDATE_EMAIL));
        }

        // 1. Notificación al Administrador
        $mailAdmin = Mail::to($adminEmail);
        if (!empty($ccEmails)) {
            $mailAdmin->cc($ccEmails);
        }
        $mailAdmin->send(new NewsletterNotificationAdmin($data));

        // 2. Notificación al Usuario
        Mail::to($data['email'])->send(new NewsletterAcknowledgementUser($data));
    }
}
