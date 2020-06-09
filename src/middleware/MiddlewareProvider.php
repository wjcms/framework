<?php

namespace wjcms\framework\middleware;

use wjcms\framework\core\Provider;
use wjcms\framework\core\App;

class MiddlewareProvider extends Provider
{

    //是否延迟注册
    protected $defer = false;

    //启动方法
    public function boot()
    {
        //执行全局中间件
        app('Middleware')->global();
    }

    //注册服务
    public function regsiter(App $app)
    {
        $app->bind('Middleware', Middleware::class, true);
    }
}
