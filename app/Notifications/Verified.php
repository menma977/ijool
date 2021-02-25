<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\URL;

class Verified extends Notification
{
  use Queueable;

  /**
   * The callback that should be used to create the verify email URL.
   *
   * @var Closure|null
   */
  public static $createUrlCallback;

  /**
   * Get the notification's delivery channels.
   *
   * @return array
   */
  public function via(): array
  {
    return ['mail'];
  }

  /**
   * Get the mail representation of the notification.
   *
   * @param mixed $notifiable
   * @return MailMessage
   */
  public function toMail($notifiable): MailMessage
  {
    $verificationUrl = $this->verificationUrl($notifiable);
    return (new MailMessage)
      ->subject('Verify Email Address')
      ->view('mail.password.reset', [
        "url" => $verificationUrl
      ]);
  }

  /**
   * Get the verification URL for the given notifiable.
   *
   * @param mixed $notifiable
   * @return string
   */
  protected function verificationUrl($notifiable): string
  {
    if (static::$createUrlCallback) {
      return call_user_func(static::$createUrlCallback, $notifiable);
    }

    return URL::temporarySignedRoute(
      'verification.verify',
      Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
      [
        'id' => $notifiable->getKey(),
        'hash' => sha1($notifiable->getEmailForVerification()),
      ]
    );
  }
}
