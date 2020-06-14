<?php
namespace wjcms\framework\route;

use Closure;
use ReflectionFunction;
use ReflectionMethod;
use Middleware;

trait Execute
{
    /**
     * 路由匹配
     */
    protected $route;

    public function exec()
    {
        $this->parseRoute();
        // dump($this->route);
        if (!$this->route) {
            die('404');
        }
        $action = $this->route['action'];
        $this->execMiddleware();
        if ($action instanceof Closure) {
            //如果是回调函数
            return $this->calClosure($action);
        } else {
            //如果是控制器
            return $this->callController($action);
        }
    }

    protected function execMiddleware()
    {
        // dd($this->route['middleware']);
        return Middleware::route($this->route['middleware']);
    }

    /**
     * 路由处理是控制器的形态
     */
    protected function callController($action)
    {
        $info = explode('@', $action);
        $controller = app('App\Controllers\\'.$info[0]);
        $reflection = new  ReflectionMethod($controller, $info[1]);
        $args = [];
        foreach ($reflection->getParameters() as $param) {
            $name = $param->name;
            if (isset($this->route['matches'][$name])) {
                if ($class = $param->getClass()) {
                    $className = $class->name;
                    // dd($this->route['matches'][$name]);
                    $args[] = new $className($this->route['matches'][$name]);
                } else {
                    $args[] = $this->route['matches'][$name];
                }
            } elseif ($class = $param->getClass()) {
                $args[] = app($class->name);
            }
        }
        // dd($args);
        return $reflection->invokeArgs($controller, $args);
    }

    /**
     * 路由处理是回调函数的形态
     */
    protected function calClosure($action)
    {
        $reflection = new ReflectionFunction($action);
        $args = [];
        foreach ($reflection->getParameters() as $param) {
            $name = $param->name;
            if (isset($this->route['matches'][$name])) {
                $args[]=$this->route['matches'][$name];
            } elseif ($class = $param->getClass()) {
                $args[] = app($class->name);
            }
        }
        return $reflection->invokeArgs($args);
    }

    protected function parseRoute()
    {
        $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        foreach ($this->routers as $route) {
            $reg ="#^/".trim($route['path'], '/')."$#i";
            $isMath = preg_match($reg, $url, $matches);
            if ($isMath && $this->checkMethod($route)) {
                $route['matches'] = array_filter($matches, function ($v, $k) {
                    return is_string($k);
                }, ARRAY_FILTER_USE_BOTH);
                $this->route = $route;
            }
        }
    }

    protected function checkMethod($route)
    {
        return $route['method'] == strtolower($_SERVER['REQUEST_METHOD']);
    }
}
