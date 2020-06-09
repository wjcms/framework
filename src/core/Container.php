<?php
namespace wjcms\framework\core;

use Exception;
use Closure;
use ReflectionClass;

abstract class Container
{
    protected $building = [];

    //单例服务对象
    protected $instances = [];

    public function bind($name, $closure, $force = false)
    {
        //compact('closure')相当于['closure'=>$closure]
        $this->building[$name] = compact('closure', 'force');
        // dump($this->building);
    }

    //单例服务对象
    public function instance($name, $instance)
    {
        $this->instances[$name] = $instance;
    }

    protected function make($name, $force)
    {
        if (isset($this->instances[$name])) {
            return $this->instances[$name];
        }
        $closure = $this->getClosure($name);
        $instance = $this->build($closure);

        //此服务是否为单例
        if (isset($this->building[$name]) && $this->building[$name]['force']===true || $force) {
            $this->instances[$name] = $instance;
        }
        return $instance;
    }

    protected function build($closure)
    {
        //实现的构建是回调函数时候执行函数创建对象并返回
        if ($closure instanceof Closure) {
            return $closure($this);
        }
        //实现的构建是类的时候
        $reflection =new ReflectionClass($closure);
        //判断是否有构造函数
        $constructor = $reflection->getConstructor();
        //没有构造函数直接返回
        if (is_null($constructor)) {
            return new $closure;
        }
        //有构造函数获取参数，对参数分析
        $parameters = $constructor->getParameters();
        $parameters = $this->parseParams($parameters);
        // dump($parameters);
        return $reflection->newInstanceArgs($parameters);
    }

    //解析构造函数参数方法
    protected function parseParams($params)
    {
        $parameters = [];
        foreach ($params as $param) {
            //判断参数是否为类
            $class = $param->getClass();
            if (is_null($class)) {
                //基本类型
                $parameters[] = $this->parseNomParam($param);
            } else {
                //类
                $parameters[]=$this->build($class->name);
            }
        }
        return $parameters;
    }

    //获取基本类型参数方法
    protected function parseNomParam($param)
    {
        if ($param->isDefaultValueAvailable()) {
            return $param->getDefaultValue();
        }
        throw new Exception('默认值缺少参数');
    }

    protected function getClosure($name)
    {
        // dd($name);
        return isset($this->building[$name]) ? $this->building[$name]['closure'] : $name;
    }
}
