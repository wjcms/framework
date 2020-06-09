<?php

namespace wjcms\framework\route;

/**
 *Route
 */
class Route
{
    use Setting,Compile,Execute;

    public function start()
    {
        //读取配置
        $this->compile();
        //解析路由正则
        $this->format();
        //路由匹配
        $content = $this->exec();
        echo $content;
    }
}
