<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserStoreRequest;
use App\Http\Responses\ApiErrorResponse;
use App\Http\Responses\ApiSuccessResponse;

class UserStoreController extends Controller
{
    /**
     * @param UserStoreRequest $request
     * @return ApiSuccessResponse|ApiErrorResponse
     */
    public function __invoke(UserStoreRequest $request): ApiSuccessResponse|ApiErrorResponse
    {
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $response = [
                'name' => $user->name,
                'email' => $user->email,
            ];
        } catch (\Throwable $e) {
            return new ApiErrorResponse($e, 'Failed to create user');
        }

        return new ApiSuccessResponse(
            $response,
            ['message' => 'User created successfully'],
            201
        );
    }
}
