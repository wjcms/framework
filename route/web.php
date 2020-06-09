<?php


// Route::get('/', function () {
//     return '首页';
// });

// Route::get('space', function () {
//     return '个人空间';
// });


// Route::get('article/{id}', function ($id, Config $config) {
//     // dd($config);
//     return "正在访问网站：".$config->get('app.name')."id为 {$id} 个人空间";
// })->where(['id'=>'\d+']);
Route::get('/', 'HomeController@index');
Route::get('user/{id}', 'UserController@show')->middleware(['Auth']);;

// Route::get('login', 'LoginController@login');
// Route::post('article', 'ArticleController@store')->middleware(['Auth']);

// Route::post('article/{cid}', function () {
//     return '发表文章';
// });
