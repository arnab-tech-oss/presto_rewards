<?php

namespace App\Listeners;

use App\Events\SentOtpMessage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendMessage
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
     * @param  object  $event
     * @return void
     */
    public function handle(SentOtpMessage $event)
    {
        //
        $mobile = $event->mobile;
        $message = $event->message;

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://unify.smsgateway.center/SMSApi/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('userid' => 'prestoplast', 'mobile' => $mobile, 'senderid' => 'PRESPI', 'dltEntityId' => '1101530480000076450', 'msg' => $message, 'sendMethod' => 'quick', 'msgType' => 'text', 'output' => 'json', 'duplicatecheck' => 'true'),
            CURLOPT_HTTPHEADER => array(
                'apikey: 0f1eaefa6fd1b5448bc179f59ea11d4b649bf67e',
                'Cookie: SERVERID=webC2'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $event->response = json_decode($response, true);
        return $event->response;

    }
}
