<?php

namespace App\Controllers;

use DB;

class HomeController
{
    public function index()
    {
        // $article = DB::table('article')->insert([
        //     'title'=>'laravel',
        //     'description'=>'这是laravel描述'
        // ]);
        // $articles = DB::table('article')->get();
        // dump($articles);
        $article = DB::table('article')->where([
                ['id','=',7]
            ])->update([
                'title'=>'laravel7.7777',
                'description'=>'这是laravel描述'
            ]);
        // dump($article);
        // DB::table('article')->where([
        //     ['id','=',5]
        // ])->delete();
    }
}
