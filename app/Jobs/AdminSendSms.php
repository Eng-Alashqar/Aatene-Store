<?php

namespace App\Jobs;

use App\Models\Users\Seller;
use App\Traits\SendSms;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Vonage\Client;
use Vonage\Client\Credentials\Basic;

class AdminSendSms implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels , SendSms;

    /**
     * Create a new job instance.
     */
    public function __construct(public string $message)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $basic  = new Basic( getenv("SMS_KET"), getenv("SMS_SECRET"));
        $client = new Client($basic);

        $phones = Seller::pluck('phone_number')->toArray();

        foreach ($phones as $phone){

            $this->CreateSmsNotify("$phone" ,"$this->message" ,$client);

        }
    }
}
