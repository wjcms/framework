<?php

namespace wjcms\framework\middleware;

use wjcms\framework\core\Facade;

class MiddlewareFacade extends Facade
{
    public static function getRootAccessor()
    {
        return 'Middleware';
    }
}
