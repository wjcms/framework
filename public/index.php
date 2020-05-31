<?php

use wjcms\framework\core\App;


require '../vendor/autoload.php';

App::start();
// $img=$app->make('Img',true);
dump(config('app.name'));
// $ img->captcha();

// $config=$app->make('Config')->set('database.mysql.host1','192.168.1.2');
// dump($config);
// dump($app->make('Config')->get('database.mysql.host1'));
//验证单例多例
// $img = $app->make('Img',true);
// $img->text = '这是改动';

// $img2 = $app->make('Img');
// dump($img2->text);