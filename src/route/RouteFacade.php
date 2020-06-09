<?php

namespace wjcms\framework\route;

use wjcms\framework\core\Facade;

class RouteFacade extends Facade
{
    public static function getRootAccessor()
    {
        return 'Route';
    }
}
