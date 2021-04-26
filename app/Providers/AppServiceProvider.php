<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Queue\Events\JobFailed;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Notification;


use App\Notifications\JobFailedEmail;
//models for querys
use App\Models\FailedJob;
use App\Models\User;

use Illuminate\Support\Facades\Log;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        Queue::failing(function (JobFailed $event) {
            // $event->connectionName
            // $event->job
            // $event->exception
            $user = User::first();
            $fails = FailedJob::all();
            /**
             * a little validations for emails sendding, 
             * it will start sending emails every 100 errors (specify on .env file)
             */
 
            if ( ($fails->count() % env('MAX_FAILS') ) == 0) {
                Notification::send($user, new JobFailedEmail($event,$fails));
            }
        });
    }
}
