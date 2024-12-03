<?php

namespace App\Http\Services;

use App\Events\EventNotification;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail;


class SendNotificationService
{


    public function __construct()
    {}

    /**
     * send notification.
     */
    public static function send($message)
    {
        broadcast(new EventNotification($message));
    }

    public static function toEmail($tasks , $user)
    {

        Mail::to($user->email)->send(new SendMail($tasks));

    }


}
