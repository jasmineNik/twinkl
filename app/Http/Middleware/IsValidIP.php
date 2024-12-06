<?php

namespace App\Http\Middleware;

use App\Models\IPBlockList;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsValidIP
{
    /**
     * Handle an incoming request.
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $ips = $request->getClientIps();
        if (!$this->isValidIP($ips) || !$this->notInBlockList($ips)) {
            abort(Response::HTTP_FORBIDDEN);
        }
        return $next($request);
    }

    /**
     * @param $ips
     * @return bool
     */
    protected function isValidIP($ips): bool
    {
        $filtered = array_filter($ips, function ($ip) {
            return !filter_var($ip, FILTER_VALIDATE_IP);
        });
        return !empty($filtered);
    }

    protected function notInBlockList($ips): bool
    {
        $ip_list = IPBlockList::select('address')
            ->wherein('address', $ips)
            ->get();
        if (count($ip_list) > 0) return false;
        return true;
    }
}
