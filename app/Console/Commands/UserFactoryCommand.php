<?php

namespace App\Console\Commands;

use App\Jobs\UserFactoryJob;
use Illuminate\Console\Command;

class UserFactoryCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user-factory-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        UserFactoryJob::dispatch();
    }
}
