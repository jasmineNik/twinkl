<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */
    'failed' => 'These credentials do not match our records.',
    'password' => 'The provided password is incorrect.',
    'throttle' => 'Too many login attempts. Please try again in :seconds seconds.',
    'login' => [
        'error' => 'Invalid Credentials',
        'success' => 'User login successfully.',
        ],
    'logout' => [
        'success' => 'User logout successfully.',
    ],
    'register' => [
        'success' => 'User created successfully.',
        'error' => 'Error creating user.',
        'mail' => [
            'subject' => 'User registration',
            'body' => 'Hello :name.
                        Welcome to :app_name!
                        Your account has been successfully created.
                        You can now login as our :type. Your :subscribe subscription plan has been activated.',
            'thanks' => 'Thank you for signing up to our application.',
        ]
    ],

];
