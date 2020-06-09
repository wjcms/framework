<?php

namespace wjcms\framework\database;

use wjcms\framework\core\Facade;

class DatabaseFacade extends Facade
{
    public static function getRootAccessor()
    {
        return 'Database';
    }
}
