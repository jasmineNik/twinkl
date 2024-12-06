<?php

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Helpers\LocalizationHelper;
use App\Http\Middleware\IsValidIP;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->append(IsValidIP::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (Exception $e, $request) {
            if ($request->is('api/*')) {
                LocalizationHelper::setLocale($request);
                $headers = $request->headers->all();
                $success = false;
                $message = '';
                $status = 400;
                $data = [];
                if (!$request->wantsJson()) {
                    $message = __('messages.server_error') . $e->getMessage();
                    $status = 500;
                    $data = ['headers' => $headers];
                }

                if ($e instanceof NotFoundHttpException || $e instanceof ModelNotFoundException) {
                    $message = __('messages.not_found');
                    $status = 404;
                }
                if ($e instanceof MethodNotAllowedHttpException) {
                    $message = $e->getMessage();
                    $status = 405;
                }
                if ($e instanceof AuthorizationException) {
                    $message = $e->getMessage();
                    $status = 403;
                }

                if ($e instanceof ValidationException) {
                    $message = __('bad_request');
                    $data = $e->validator->errors();
                }

                return response()->json(compact('success', 'message', 'data'), $status);
            }
        });
    })->create();
