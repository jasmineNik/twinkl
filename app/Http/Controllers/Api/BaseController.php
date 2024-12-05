<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    /**
     * @param array $data
     * @param string $message
     * @param int $code
     * @return JsonResponse
     */
    protected function success(string $message = 'success', array $data = [], int $code = 200): JsonResponse
    {
       return $this->response(true,$message, $code,  $data);
    }

    /**
     * @param string $message
     * @param int $code
     * @return JsonResponse
     */
    protected function error(string $message = 'error', int $code = 404): JsonResponse
    {
        return $this->response(false, $message, $code);
    }

    /**
     * @param bool $success
     * @param string $message
     * @param int $code
     * @param array $data
     * @return JsonResponse
     */
    private function response(bool $success, string $message, int $code, array $data = []): JsonResponse
    {
        return response()->json(compact('success', 'data', 'message'), $code);
    }
}
