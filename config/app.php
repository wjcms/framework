<?php
use wjcms\framework\database\DatabaseProvider;
use wjcms\framework\img\ImgProvider;
use wjcms\framework\config\ConfigProvider;

return [
	'name'=>'wjcms',
	'url'=>'https://www.wjcms.net',
	'providers'=>[
		DatabaseProvider::class
		,ConfigProvider::class
		,ImgProvider::class
	]
];