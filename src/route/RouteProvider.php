<?php

namespace wjcms\framework\route;

use wjcms\framework\core\Provider;
use wjcms\framework\core\App;

class RouteProvider extends Provider
{

    //是否延迟注册
    protected $defer = false;

    //启动方法
    public function boot()
    {
        //
    }

    //注册服务
    public function regsiter(App $app)
    {
        $app->bind('Route', Route::class, true);
    }
}
