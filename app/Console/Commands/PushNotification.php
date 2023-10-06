<?php

namespace App\Console\Commands;

use App\Jobs\AdminSendSms;
use App\Mail\TemplateMail;
use App\Models\PushingNotification;
use App\Models\SellerPushingNotification;
use App\Services\NotificationsService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Vonage\Client;
use Vonage\Client\Credentials\Basic;
use Vonage\SMS\Message\SMS;

class PushNotification extends Command
{


     public function __construct(public NotificationsService $notificationsService)
     {
         parent::__construct();
     }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:push-notification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $tasks = PushingNotification::where('launch_at' ,'<=' , now() )->get();
        $tasks2 = SellerPushingNotification::where('launch_at' ,'<=' , now() )->get();

        $this->apply($tasks);
        $this->apply($tasks2);

    }
    function apply($tasks): void
    {

        foreach ($tasks as $task){
            $connections  =  explode(',' , $task->connection) ;
            if ($task->type === "email"){
                foreach ($connections as $connection){
                    Mail::to($connection)->send(new TemplateMail(['title'=>$task->title , 'content'=>$task->content]));
                    usleep(50000);
                }
            }elseif ($task->type === "sms"){

                $basic  = new Basic( getenv("SMS_KET"), getenv("SMS_SECRET"));
                $client = new Client($basic);

                foreach ($connections as $number){

                    $response = $client->sms()->send(
                        new SMS("$number", getenv('SMS_BRAND'), $task->content)
                    );
                    usleep(50000);
                }

            }elseif ($task->type === "app"){

                $this->notificationsService->pushingNotify($connections , $task->title , $task->content);
            }

            $task->delete();
        }
    }
}
