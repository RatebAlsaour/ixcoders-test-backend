<?php

namespace App\Jobs;

use App\Http\Services\SendNotificationService;
use App\Mail\SendMail;
use App\Models\Task;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendDailyEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
    }
    /**
     * Execute the job.
     */


    public function handle(): void
    {

        //SendDailyEmail::dispatch();
        $users = User::role('employee')->get();


        foreach ($users as $user) {

            $tasks = Task::where('user_id', $user->id)->get();

            SendNotificationService::toEmail($tasks, $user);

        }

    }
}
