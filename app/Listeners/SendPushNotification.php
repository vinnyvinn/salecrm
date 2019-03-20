<?php

namespace App\Listeners;

use App\Events\AppPushNotification;
use App\Firebase\FirebaseHelper;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendPushNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  AppPushNotification  $event
     * @return void
     */
    public function handle(AppPushNotification $event)
    {
        FirebaseHelper::sendFirebasePaymentNotification($event->title,$event->message,$event->description, $event->firebaseId);
    }
}
