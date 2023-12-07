<?php

namespace App\Http\Middleware;

use App\Models\CustomToken;
use Closure;
use Illuminate\Http\Request;

class CustomTokenMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $authorizationHeader = $request->header('Authorization');

        if (!$authorizationHeader || !preg_match('/Bearer\s+(.+)/', $authorizationHeader, $matches)) {
            return response()->json(['message' => 'Unauthorized. Invalid AUTHORIZATION HEADER.'], 401);
        }

        $token = $matches[1];

        if ($this->isValidToken($token)) {
            return $next($request);
        }

        return response()->json(['message' => 'Unauthorized. Invalid or EXPIRED TOKEN.'], 401);
    }

    private function isValidToken($token)
    {
        $customToken = CustomToken::where('token', $token)->first();

        if ($customToken && !$this->isTokenExpired($customToken->login_time)) {
            return true;
        }

        return false;
    }

    private function isTokenExpired($loginTime)
    {   
       
        $expirationTime = env('PERSONAL_ACCESS_TOKEN_LIFETIME');
        
        return now()->diffInSeconds($loginTime) > $expirationTime;
    }
}

