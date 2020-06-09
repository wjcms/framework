<?php
use wjcms\framework\core\App;

function dd($content)
{
    echo "<pre>";
    var_dump($content);
    die("</pre>");
}

function dump($content)
{
    echo "<pre>";
    print_r($content);
    echo "</pre>";
}

function app($name=null, $force=false)
{
    $app=App::app();
    return is_null($name) ? $app : $app->make($name, $force);
}

function config($name, $value='[@GET]')
{
    if ($value == '[@GET]') {
        //获取
        return app()->make('Config')->get($name);
    } else {
        //设置
        return app()->make('Config')->set($name, $value);
    }
}
