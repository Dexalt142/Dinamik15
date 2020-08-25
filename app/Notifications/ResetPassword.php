<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword as Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPassword extends Notification
{
    /**
     * Generate reset password email
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Password reset')
            ->line('Anda menerima email ini karena anda meminta untuk mengatur ulang password anda.')
            ->action('Reset Password', $this->resetUrl($notifiable))
            ->line('Jika anda tidak meminta untuk mengatur ulang password anda, abaikan email ini.');
    }

    /**
     * Get the reset password URL for the given notifiable.
     *
     * @param  mixed  $notifiable
     * @return string
     */
    protected function resetUrl($notifiable)
    {
        $appUrl = config('app_url');

        return url("$appUrl/password/reset/$this->token") . '?email=' . urlencode($notifiable->email);
    }
}
