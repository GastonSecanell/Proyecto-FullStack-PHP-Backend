<?php

namespace App\Http\Middleware;

use App\Http\Controllers\LoginController;
use Closure;
use Illuminate\Support\Facades\Auth;

class ClearUserTokensOnUnauthorized
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        if ($response->status() === 401) {
            $login = new LoginController();
            $login->logout();

        }

        return $response;
    }
}
