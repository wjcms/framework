<?php

namespace wjcms\framework\config;

use wjcms\framework\core\Provider;
use wjcms\framework\core\App;

class ConfigProvider extends Provider{

    //是否延迟注册
    protected $defer = false;

    //启动方法
    public function boot()
    {
    	//加载配置
    	$this->app->make('Config')->load();
    }

    //注册服务
    public function regsiter(App $app)
    {
        $app->bind('Config',Config::class,true);
    }
	
}