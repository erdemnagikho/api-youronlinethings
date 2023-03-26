<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class TestNotifier extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test-notifier';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notifies on new user';


    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        echo 'start listening for message' . PHP_EOL;
        Redis::subscribe('create:user', function ($user) {
            echo 'message received!' . PHP_EOL;
            $user = json_decode($user);
            echo 'New user: '. $user->name . PHP_EOL;
        });
    }
}
