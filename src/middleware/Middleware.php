<?php

namespace wjcms\framework\middleware;

class Middleware
{
    use Dispatcher;
    public function global()
    {
        $this->exec(config('middleware.middleware'));
    }

    public function route(array $middleware)
    {
        // dd(config('middleware.routemiddleware'));
        $middleware = array_filter(config('middleware.routemiddleware'), function ($value, $name) use ($middleware) {
            return in_array($name, $middleware);
        }, ARRAY_FILTER_USE_BOTH);
        // dd($middleware);
        return $this->exec($middleware);
    }
}
