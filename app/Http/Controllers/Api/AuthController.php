<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\StoreUserRequest;
use App\Http\Requests\Api\UserRequest;
use App\Models\User;
use App\Notifications\UserRegister;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;

class AuthController extends BaseController
{
    /**
     * @param StoreUserRequest $request
     * @return JsonResponse
     */
    public function register(StoreUserRequest $request): JsonResponse
    {
        // here I used type_id and subscription_id because I don't want to use strings.
        $data = $request->validated();
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'type_id' => $data['type_id'],
            'subscription_id' => $data['subscription_id']
        ]);
        // generating an access token for the user
        // it's optional for register it depends on our features
        $token = $user->createToken('auth_token')->plainTextToken;

        // Sending an email to registered user
        Notification::send($user, new UserRegister($user));

        return $this->success(__('auth.register.success'), ['access_token' => $token]);
    }

    /**
     * @param UserRequest $request
     * @return JsonResponse
     */
    public function login(UserRequest $request): JsonResponse
    {
        $data = $request->validated();
        $user = User::where('email', $data['email'])->first();
        if (!$user || !Hash::check($data['password'], $user->password)) {
            return $this->error(__('auth.login.error'), 401);
        }
        $token = $user->createToken($user->name . '-AuthToken')->plainTextToken;
        return $this->success(__('auth.login.success'), ['access_token' => $token]);
    }
}
