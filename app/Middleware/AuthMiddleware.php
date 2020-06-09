<?php

namespace App\Middleware;

class AuthMiddleware
{
    public function handle($next)
    {
        // echo 'auth middleware';
        $next();
    }
}
