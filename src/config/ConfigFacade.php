<?php

namespace wjcms\framework\config;

use wjcms\framework\core\Facade;

class ConfigFacade extends Facade
{
    public static function getRootAccessor()
    {
        return 'Config';
    }
}
