<?php

namespace App\Controllers;

use App\Models\Article;
use DB;

class HomeController
{
    public function index()
    {
        
        
        // $model = new Article;
        // $article = $model->get(2, 9);
        $article = Article::find(1);
        $article['title'] = 'wjcms';
        dump($article['title']);
        $article->save();

        // $r = DB::table('article')->find(9);
        // dump($r);
        
        // $article = DB::table('article')->insert([
        //     'title'=>'laravel',
        //     'description'=>'这是laravel描述'
        // ]);
        // $articles = DB::table('article')->get();
        // dump($articles);
        // $article = DB::table('article')->where([
        //         ['id','=',7]
        //     ])->update([
        //         'title'=>'laravel7.7777',
        //         'description'=>'这是laravel描述'
        //     ]);
        // dump($article);
        // DB::table('article')->where([
        //     ['id','=',5]
        // ])->delete();
    }
}
