<?php

namespace wjcms\framework\img;
use wjcms\framework\core\Provider;
use wjcms\framework\core\App;

class ImgProvider extends Provider{

    //是否延迟注册
    protected $defer = true;

    //启动方法
    public function boot()
    {
    	//数据库连接
    	//
    	echo 'img boot';
    }

    //注册服务
    public function regsiter(App $app)
    {
        
        
        $app->bind('Img',Img::class);
        //单例处理
        // $this->app->instance('Img',new Img());
        // $app->bind('Img',function(){
        // 	return new Img();
        // });
        // echo 'img';
    }
	
}