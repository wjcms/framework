<?php

namespace wjcms\framework\route;

trait Compile
{
    public function format()
    {
        foreach ($this->routers as &$route) {
            $this->parseWhere($route);

            //没有设置条件的处理
            $this->parseNonWhere($route);
        }
        // dump($this->routers);
    }

    protected function parseNonWhere(&$route)
    {
        $reg = '/\{(?<name>\w+)\}/';
        $route['path'] = preg_replace_callback($reg, function ($matches) {
            return "(?<{$matches['name']}>\w+)";
        }, $route['path']);
    }

    protected function parseWhere(&$route)
    {
        foreach ($route['where'] as  $k => $v) {
            $reg = '/(\{'.$k.'\})/';
            $route['path'] = preg_replace_callback($reg, function ($matches) use ($k,$v) {
                return "(?<{$k}>{$v})";
            }, $route['path']);
        }
        // dump($route);
    }
}
