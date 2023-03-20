<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Console\Command;

class CheckRememberToken extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-remember-token';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command checks remember_token columns of user table, if it is null, it sets the column "now()"';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $users = User::query()
            ->whereNull('remember_token')
            ->get();
        if ($users->count() > 0) {
            foreach ($users as $user) {
                $user->update([
                    'remember_token' => Carbon::now(),
                ]);
            }
        }
    }
}
