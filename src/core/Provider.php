<?php
namespace wjcms\framework\core;


abstract class Provider{
    //是否延迟注册
    protected $defer = true;

    abstract public function regsiter(App $app);

    protected $app;

    public function __construct(App $app)
    {
    	$this->app = $app;
    }

}