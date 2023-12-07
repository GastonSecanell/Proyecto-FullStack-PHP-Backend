<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\RequestResponseLog;

class LogResponse
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        RequestResponseLog::create([
            'type' => 'response',
            'content' => json_encode($response->original),
            'ip_address' => $request->ip(),
        ]);

        return $response;
    }
}