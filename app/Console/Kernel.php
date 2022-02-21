<?php

namespace App\Console;

use App\Email;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {


            

            $messageID2 =   \DB::table('emails')->pluck('message_id');

            foreach(  $messageID2 as $messageID ){

             $results = json_decode( file_get_contents("https://api.elasticemail.com/v2/email/status?apikey=D2CD53BB6350D5C8D3D54930B973F1D0588418AF44A9155936FC077E1B8CE850BE8C5B9C2394E41AED82551FB0209DCF&messageID=$messageID"));


            Email::where('message_id', $messageID)->update(['status' => $results->data->statusname]);

            }

        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
