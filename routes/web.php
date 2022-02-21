<?php

use App\Mail\Yekpay;
use Illuminate\Http\Request;
use Facades\Spatie\Referer\Referer;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;




Route::post('/email/send', function () {

   return $result = file_get_contents('https://api.elasticemail.com/v2/contact/list?apikey=D2CD53BB6350D5C8D3D54930B973F1D0588418AF44A9155936FC077E1B8CE850BE8C5B9C2394E41AED82551FB0209DCF&to=farhad.sadeghi@yekpay.com');
})->name('send');


Route::get('load', function () {

    $a ='New Default Template:2022-01-26 09:43:07';
    $str = urlencode($a);


     $results = json_decode( file_get_contents("https://api.elasticemail.com/v2/template/loadtemplate?apikey=D2CD53BB6350D5C8D3D54930B973F1D0588418AF44A9155936FC077E1B8CE850BE8C5B9C2394E41AED82551FB0209DCF&name=$str"));

   $txt =  $results->data->bodyhtml;
    $a = str_replace('amet','mehrdad',$txt);
   $myfile = fopen("email.blade.php", "w");
   fwrite($myfile, $txt);
   fclose($myfile);


   $txt2 = urlencode($txt);



   $postRequest = array(
    'apikey' => 'D2CD53BB6350D5C8D3D54930B973F1D0588418AF44A9155936FC077E1B8CE850BE8C5B9C2394E41AED82551FB0209DCF',
    'to' => 'farhad.sadeghi@yekpay.com',
    'from' => 'info@yekpay.com',
    'bodyHtml' => $a,
);

$cURLConnection = curl_init('https://api.elasticemail.com/v2/email/send');
curl_setopt($cURLConnection, CURLOPT_POSTFIELDS, $postRequest);
curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);

$apiResponse = curl_exec($cURLConnection);
curl_close($cURLConnection);

// $apiResponse - available data from the API request
$jsonArrayResponse = json_decode($apiResponse);
dd($jsonArrayResponse);


});



Route::post('/', function (Request $request) {


    dd( Referer::get());


    dd($request);


});