<?php
namespace wjcms\framework\img;

/**
 * 图像处理类
 */
class Img
{

    public function __construct($name='123',Config $config)
    {
        // dd($config);
    }

    public $text = '123';

    public function captcha()
    {
    	echo '验证码方法';
    }
}
