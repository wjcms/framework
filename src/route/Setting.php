<?php

namespace wjcms\framework\route;

trait Setting
{
    protected $routers = [];
    public function compile()
    {
        include BASE_PATH.'/route/web.php';
    }

    public function __call($name, $arguments)
    {
        $this->routers[] = [
            'method' => $name,
            'path' => $arguments[0],
            'action'=>$arguments[1],
            'where'=>[],
            'middleware'=>[]
        ];
        return $this;
    }

    public function where($params)
    {
        $this->setProperty('where', $params);
        return $this;
    }

    public function middleware(array $middleware)
    {
        $this->setProperty('middleware', $middleware);
        return $this;
    }


    protected function setProperty($name, $params)
    {
        $index = count($this->routers)-1;
        $this->routers[$index][$name] = $params;
    }
}
