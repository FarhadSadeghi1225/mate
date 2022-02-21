<?php

namespace App\Http\Controllers;

use App\Email;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function send()
    {

        $filename ='Copy Disruption of the payment gateway';
        $str = urlencode($filename);

         $results = json_decode( file_get_contents("https://api.elasticemail.com/v2/template/loadtemplate?apikey=D2CD53BB6350D5C8D3D54930B973F1D0588418AF44A9155936FC077E1B8CE850BE8C5B9C2394E41AED82551FB0209DCF&name=$str"));

        //  dd($results);

       $txt =  $results->data->bodyhtml;
        $a = str_replace('amet','mehrdad',$txt);


       $postRequest = array(
        'apikey' => 'D2CD53BB6350D5C8D3D54930B973F1D0588418AF44A9155936FC077E1B8CE850BE8C5B9C2394E41AED82551FB0209DCF',
        'to' => 'farhad.sadeghi@yekpay.com',
        'from' => 'info@yekpay.com',
        'channel' => 'HTTP API',
        'charset' => 'utf-8',
        'fromname' => $results->data->fromname,
        'subject' => $results->data->subject,
        'template' => $results->data->templateid,
        'bodyHtml' => $a,
        'bodyText' =>  $results->data->bodytext,
        'isTransactional' => false ,
    );

     $cURLConnection = curl_init('https://api.elasticemail.com/v2/email/send');
     curl_setopt($cURLConnection, CURLOPT_POSTFIELDS, $postRequest);
     curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);

     $apiResponse = curl_exec($cURLConnection);
     curl_close($cURLConnection);

     // $apiResponse - available data from the API request
     $jsonArrayResponse = json_decode($apiResponse);
    //  dd($jsonArrayResponse);


     $email = new Email();
     $email->from = 'info@yekpay.com';
     $email->to = 'farhad.sadeghi@yekpay.com';
     $email->apikey = 'D2CD53BB6350D5C8D3D54930B973F1D0588418AF44A9155936FC077E1B8CE850BE8C5B9C2394E41AED82551FB0209DCF';
     $email->channel = 'HTTP API';
     $email->charset = 'utf-8';
     $email->from_name = $results->data->fromname;
     $email->subject = $results->data->subject;
     $email->template = $results->data->templateid;
     $email->body_html = $txt;
     $email->file_name = $filename;
     $email->transaction_id = $jsonArrayResponse->data->transactionid;
     $email->message_id = $jsonArrayResponse->data->messageid;
     $email->is_transactional = false;
     $email->save();

     return redirect('/');


    }
}
