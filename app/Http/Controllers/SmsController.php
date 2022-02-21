<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kavenegar;
use App\Sms;

class SmsController extends Controller
{
    public function send_sms()
    {

try{
    $sender = "10005500005550";
    $message = "خدمات پیام کوتاه کاوه نگار";
    $receptor = array("09210906176");
    $result = Kavenegar::Send($sender,$receptor,$message);
    if($result){
        foreach($result as $r){
            $sms = new Sms();
            $sms->receptor = $r->receptor;
            $sms->message	 = $r->message;
            $sms->sender =  $r->sender;
            $sms->message_id =  $r->messageid;
            $sms->status =  $r->status;
            $sms->status_text =  $r->statustext;
            $sms->date =  $r->date;
            $sms->cost =  $r->cost;
            $sms->save();

            echo "messageid = $r->messageid";
            echo "message = $r->message";
            echo "status = $r->status";
            echo "statustext = $r->statustext";
            echo "sender = $r->sender";
            echo "receptor = $r->receptor";
            echo "date = $r->date";
            echo "cost = $r->cost";
        }
    }
}
catch(\Kavenegar\Exceptions\ApiException $e){
    // در صورتی که خروجی وب سرویس 200 نباشد این خطا رخ می دهد
    echo $e->errorMessage();
}
catch(\Kavenegar\Exceptions\HttpException $e){
    // در زمانی که مشکلی در برقرای ارتباط با وب سرویس وجود داشته باشد این خطا رخ می دهد
    echo $e->errorMessage();
}




    }




    public function lookup_send()
    {
        $template = "active";
        $token = "678543";
        $receptor = '09210906176';

        $postRequest = array(
            'token' =>  $token,
            'template' => $template,
            'receptor' =>  $receptor,
        );

         $cURLConnection = curl_init('https://api.kavenegar.com/v1/4448743370634D615A70594C59586A747334797955515368324F5A6477587130/verify/lookup.json');
         curl_setopt($cURLConnection, CURLOPT_POSTFIELDS, $postRequest);
         curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);

         $apiResponse = curl_exec($cURLConnection);
         curl_close($cURLConnection);

         // $apiResponse - available data from the API request
         $jsonArrayResponse = json_decode($apiResponse);
         dd($jsonArrayResponse);

    }
}
