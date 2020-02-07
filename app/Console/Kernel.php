<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\AppKeyManage;
use App\UserAuthLimit;

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
            //每日刷新免費次數
            $AKM = AppKeyManage::all();
            foreach ($AKM as $akm) {
                $refresh_freq = $akm->free_request_times_pre_day;
                $refresh_app_id = $akm->id;
                UserAuthLimit::where('app_id', $refresh_app_id)
                    ->update(['free_remain_request_times_pre_day' => $refresh_freq]);
            }
        })->daily();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
