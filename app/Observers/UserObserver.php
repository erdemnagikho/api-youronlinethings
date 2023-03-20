<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Facades\Cache;

class UserObserver
{
    public function created(): void
    {
        Cache::forget(User::CACHE_USER_LIST_KEY);
    }
}
