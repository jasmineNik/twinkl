<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "name" => "required|string",
            'email'=>'required|string|email|unique:users',
            'password'=>['required','string','confirmed',
                Password::min(8)
                    ->mixedCase()
                    ->numbers()
                    ->symbols()],
            'last_name'=>'required|string',
            'type_id'=>'required|integer|exists:types,id',
            'subscription_id'=>'required|integer|exists:subscriptions,id',
        ];
    }
}