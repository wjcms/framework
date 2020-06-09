<?php
namespace wjcms\framework\middleware;

trait Dispatcher
{
    public function exec(array $middleware)
    {
        $dispatcher = array_reduce(array_reverse($middleware), $this->getSlice(), function () {
        });
        $dispatcher();
    }

    protected function getSlice()
    {
        return function ($next, $middleware) {
            return function () use ($next,$middleware) {
                call_user_func_array([new $middleware,'handle'], [$next]);
            };
        };
    }
}
