<?php

namespace wjcms\framework\database;

use wjcms\framework\core\Provider;
use wjcms\framework\core\App;

class DatabaseProvider extends Provider
{

    //是否延迟注册
    protected $defer = true;

    //启动方法
    public function boot()
    {
    }

    //注册服务
    public function regsiter(App $app)
    {
        $app->bind('Database', Database::class, true);
    }
}
