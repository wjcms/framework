<?php

use App\Middleware\AuthMiddleware;
use App\Middleware\RouteMiddleware;
use App\Middleware\SessionMiddleware;

return [
    //全局中间件
    'middleware'=>[
        SessionMiddleware::class,
        RouteMiddleware::class
    ],
    'routemiddleware'=>[
        'Auth'=> AuthMiddleware::class
    ]
];
