<?php

use wjcms\framework\config\ConfigFacade;
use wjcms\framework\database\DatabaseProvider;
use wjcms\framework\img\ImgProvider;
use wjcms\framework\config\ConfigProvider;
use wjcms\framework\database\DatabaseFacade;
use wjcms\framework\middleware\MiddlewareFacade;
use wjcms\framework\middleware\MiddlewareProvider;
use wjcms\framework\route\RouteFacade;
use wjcms\framework\route\RouteProvider;

return [
    'name'=>'wjcms',
    'url'=>'https://www.wjcms.net',
    'providers'=>[
        ConfigProvider::class,
        ImgProvider::class,
        RouteProvider::class,
        MiddlewareProvider::class,
        DatabaseProvider::class
    ],
    'facades'=>[
        'Config'=>ConfigFacade::class,
        'Route'=>RouteFacade::class,
        'Middleware'=>MiddlewareFacade::class,
        'DB'=>DatabaseFacade::class
    ],
];
