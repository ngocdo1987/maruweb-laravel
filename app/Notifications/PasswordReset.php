<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PasswordReset extends Notification
{
    use Queueable;

    public $name;
    public $email;
    public $token;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($name, $email, $token)
    {
        $this->name = $name;
        $this->email = $email;
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('[自動送信]パスワードの再設定について')
                    ->line($this->name.'様')
                    ->line('一般社団法人リファイニング建築・都市再生協会です。')
                    ->line('弊会サイトのご利用、誠にありがとうございます。')
                    ->line('以下のリンクよりパスワードを再設定してください。')
                    ->action(__('Reset Password'), url('password/reset', $this->token).'?email='.$this->email)
                    ->line('何卒よろしくお願いします。');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
