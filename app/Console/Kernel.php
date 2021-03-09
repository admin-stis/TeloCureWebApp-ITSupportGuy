<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\Admin_transaction;
use Log;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    //protected $commands = [
        //
    //];

    //test purpose

    protected $commands = [
        //Commands\Admin_transaction::class, //mridul 03-02-21
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */

    protected function schedule(Schedule $schedule)
    {
        //this log works
        Log::info("cron job  kernel schedule method entered ");
        //following log doesn't work
        //try { 
/*         $schedule->call(function () {
            Log::info("cron job  kernel schedule method call ");
        })->everyFiveMinutes(); */
        
        // $schedule->command('inspire')
        //          ->hourly();

        //test doctor purpose
        /*$schedule->command('demo:cron')
                ->daily();

        //test patient/refund/vitals purpose
        $schedule->command('Users:cron')
                ->daily();

        //test hospital purpose
        $schedule->command('hospital:sync')
                ->daily();

        //test hospital branch purpose
        $schedule->command('hospitalBranch:cron')
                ->daily();

        //test visits branch purpose
        $schedule->command('visits:sync')
                ->daily();

        //test prescription purpose
        $schedule->command('prescription:sync')
                ->daily();

        //test treatment request purpose
        $schedule->command('tc:sync')
                ->daily();
        

         $schedule->command('admin_transaction:sync')
        ->everyMinute();
        */
        //test admin purpose (transaction + advancepaid)
       // $schedule->command('admin_transaction:sync')
        //        ->daily();
        

        //test admin purpose
        /* $schedule->command('admin:sync')
                ->daily();

        //sync diseases
        $schedule->command('disease')
                ->daily();

        //sync districts
        $schedule->command('district:sync')
                ->daily(); */
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
        //require base_path('routes/console.php');
    }
}
