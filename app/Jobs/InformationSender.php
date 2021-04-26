<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

// import http client
use GuzzleHttp\Client;

//models for querys
use App\Models\FailedJob;
use App\Models\User;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use App\Notifications\FailedJobs;

class InformationSender implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 3;


    /**
     * The number of seconds to wait before retrying the job.
     *
     * @var int
     */
    public $retryAfter = 2;

    /**
     * The number of seconds to wait before retrying the job.
     *
     * @var int
     */
    public $backoff = 2;

    public function handle()
    {
        // create and configure Client
        $client = new Client([
            'base_uri' => env('BASE_URL_FAKE')
        ]);
        
        // usign client
        return $client->request('POST', env('BASE_URL_ENDPOINT'));
        
    }


}
