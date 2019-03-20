<?php
/**
 * Created by PhpStorm.
 * User: manuelgeek
 * Date: 8/1/18
 * Time: 4:18 PM
 */

namespace App\Firebase;

class FirebaseHelper
{
    static function sendFirebasePaymentNotification($title,$message,$firebaseId,$description = 'Sales CRM'){
        $firebase = new Firebase();
        $push = new Push();
        //$push->setCode($transaction->result_code);
        $payload = array();
        $push->setTitle($title);
        $push->setMessage($message);
        $payload['desc'] = $description;
        $push->setPayload($payload);

        $json = $push->getPush();
        $response = $firebase->send($firebaseId, $json);
        return $response;
    }
}