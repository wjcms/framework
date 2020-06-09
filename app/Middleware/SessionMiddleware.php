<?php

namespace App\Middleware;

class SessionMiddleware
{
    public function handle($next)
    {
        // echo 'session middleware';
        $next();
    }
}
