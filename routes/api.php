<?php

use App\Email;
use App\Sms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Carbon\Carbon;

Route::get('email/send', 'EmailController@send')->name('enail.send');
Route::get('sms/send', 'SmsController@send_sms')->name('sms.send');
Route::get('sms/lookup_send', 'SmsController@lookup_send')->name('lookup_send');





Route::get('moka/send', 'MokaController@send')->name('moka_send');










Route::get('status', function () {



    $date = Carbon::today()->subDays(30);
   $messageID2 =   \DB::table('emails')->where('status','!=',7)->where('created_at','>=',$date)->pluck('message_id');
   dd( $messageID2);

   foreach(  $messageID2 as $messageID ){

    $results = json_decode( file_get_contents("https://api.elasticemail.com/v2/email/status?apikey=D2CD53BB6350D5C8D3D54930B973F1D0588418AF44A9155936FC077E1B8CE850BE8C5B9C2394E41AED82551FB0209DCF&messageID=$messageID"));




    Email::where('message_id', $messageID)->update([
        'status_name' => $results->data->statusname,+
        'status' => $results->data->status,
        'status_change_date' => $results->data->statuschangedate,
        'date_sent' => $results->data->datesent,
        'error_message' => $results->data->errormessage,
        'date_opened' => $results->data->dateopened,
        'date_clicked' => $results->data->dateclicked,
        'date' => $results->data->date,
    ]);

   }
   return redirect('/');


     });




Route::get('sms/status', function () {


    $message_id2 =   \DB::table('sms')->pluck('message_id');

   foreach( $message_id2 as $message_id ){

    $result = Kavenegar::Status($message_id);
    if($result){
        foreach($result as $r){

            Sms::where('message_id', $message_id)->update([
                'status' => $r->status,
                'status_text' => $r->statustext,
            ]);
        }

        return redirect('/');
    }




    Email::where('message_id', $messageID)->update([
        'status_name' => $results->data->statusname,+
        'status' => $results->data->status,
        'status_change_date' => $results->data->statuschangedate,
        'date_sent' => $results->data->datesent,
        'error_message' => $results->data->errormessage,
        'date_opened' => $results->data->dateopened,
        'date_clicked' => $results->data->dateclicked,
        'date' => $results->data->date,
    ]);

   }
   return redirect('/');


     });


Route::get('/users', 'UserController@index')->name('user');

