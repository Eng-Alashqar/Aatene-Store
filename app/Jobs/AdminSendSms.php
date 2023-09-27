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
use Vonage\SMS\Message\SMS;

class AdminSendSms implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels , SendSms;

    /**
     * Create a new job instance.
     */
    public function __construct(public array $numbers , public string $content)
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

        foreach ($this->numbers as $number){

            $this->CreateSmsNotify("$number" ,"$this->content" ,$client);
            usleep(50000);


        }
    }

    public function CreateSmsNotify( $phone , $message , $client)
    {


        $response = $client->sms()->send(
            new SMS("$phone", getenv('SMS_BRAND'), $message)
        );

//        $message = $response->current();

    }

}
