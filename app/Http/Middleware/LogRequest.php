<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\RequestResponseLog;

class LogRequest
{
    public function handle(Request $request, Closure $next)
    {
        RequestResponseLog::create([
            'type' => 'request',
            'content' => json_encode($request->all()),
            'ip_address' => $request->ip(),
        ]);

        return $next($request);
    }
}

