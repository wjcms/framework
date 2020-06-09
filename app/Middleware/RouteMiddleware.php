<?php

namespace App\Middleware;

class RouteMiddleware
{
    public function handle($next)
    {
        app('Route')->start();
        $next();
    }
}
