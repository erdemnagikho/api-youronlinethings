<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Http\Responses\ApiErrorResponse;
use App\Http\Responses\ApiSuccessResponse;

class UserListController extends Controller
{
    /**
     * @param Request $request
     * @return ApiErrorResponse|ApiSuccessResponse|mixed
     */
    public function __invoke(Request $request): mixed
    {
        if (Cache::get(User::CACHE_USER_LIST_KEY)) {
            return Cache::get(User::CACHE_USER_LIST_KEY);
        }

        try {
            $users = User::all();

            $response = new ApiSuccessResponse(
                $users,
                ['message' => 'User list retrieved successfully'],
                200
            );

            Cache::put(User::CACHE_USER_LIST_KEY, $response, 3600);

            return $response;
        } catch (\Throwable $e) {
            return new ApiErrorResponse($e, 'Failed to retrieving user list');
        }
    }
}
