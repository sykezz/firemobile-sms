<?php

namespace Sykez\FireMobileSms;

use Sykez\FireMobileSms\SmsMessage;
use Illuminate\Notifications\Notification;

class SmsChannel
{
    protected $sms;

    public function __construct(Sms $sms)
    {
        $this->sms = $sms;
    }

    /**
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return void
     */
    public function send($notifiable, Notification $notification)
    {
        if (! $to = $notifiable->routeNotificationFor('sms', $notification)) {
            return;
        }
        
        $message = $notification->toSms($notifiable);

        if (is_string($message)) {
            $message = new SmsMessage($message);
        }

        return $this->sms->sendSms($message, $to);
    }
}