<?php

namespace App\Console\Commands;

use App\Http\Services\SendNotificationService;
use App\Jobs\SendDailyEmail;
use App\Models\Task;
use App\Models\User;
use Illuminate\Console\Command;


class SendDailyEmailCommand extends Command
{

    protected $signature = 'email:send-daily';

    // وصف الأمر
    protected $description = 'Send daily email at 12 PM';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        SendDailyEmail::dispatch();
    }


}
