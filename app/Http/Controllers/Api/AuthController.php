<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateUserRequest;
use App\Http\Requests\Api\UserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends BaseController
{
    public function register(CreateUserRequest $request): JsonResponse
    {
        $data = $request->validated();
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        $token = $user->createToken('auth_token')->plainTextToken;
        return $this->success( 'User created successfully.', ['access_token' => $token],);
    }

    public function login(UserRequest $request): JsonResponse
    {
        $data = $request->validated();
        $user = User::where('email',$data['email'])->first();
        if(!$user || !Hash::check($data['password'],$user->password)){
            return $this->error('Invalid Credentials', 401);
        }
        $token = $user->createToken($user->name.'-AuthToken')->plainTextToken;
        return $this->success( 'User login successfully.', ['access_token' => $token] );
    }

    public function logout(Request $request): JsonResponse
    {
        auth()->user()->tokens()->delete();
        return $this->success('User logged out successfully.');
    }
}
