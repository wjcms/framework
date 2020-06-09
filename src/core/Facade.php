<?php

namespace wjcms\framework\core;

use Exception;

class Facade
{
    public static function getRootFacade()
    {
        //static:: 先从子类找 再从父类找
        return self::getInstance(static::getRootAccessor());
    }

    protected static function getRootAccessor()
    {
        throw new Exception('外观类必须定义 getRootAccessor方法');
    }

    /**
     * 找到服务名字
     */
    protected static function getInstance($name)
    {
        return app($name);
    }

    

    public static function __callStatic($name, $arguments)
    {
        $instance = self::getRootFacade();
        // dd($instance);
        return call_user_func_array([$instance,$name], $arguments);
    }
}
