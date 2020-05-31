<?php

namespace wjcms\framework\database;

use wjcms\framework\core\Provider;
use wjcms\framework\core\App;

class DatabaseProvider extends Provider{

    //是否延迟注册
    protected $defer = false;

    //启动方法
    public function boot()
    {
    	//数据库连接
    	//
    	echo 'database boot<br>';
    }

    //注册服务
    public function regsiter(App $app)
    {
        // $app->bind('Database',function($app){
        // 	return new Database();
        // });
        // echo 'database regsiter <br>';
    }
	
}