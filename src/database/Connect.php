<?php
namespace wjcms\framework\database;

use PDO;
use PDOException;

trait Connect
{
    public static function connect()
    {
        static $link =null;
        if (!is_null($link)) {
            return $link;
        }
        $config = config('database');
        try {
            $dsn = sprintf('mysql:host=%s;dbname=%s;charset=%s', $config['host'], $config['database'], $config['charset']);
            $link = new PDO($dsn, $config['username'], $config['password']);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
        return $link;
    }
}
