<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index(){
        // $allPosts = Post::all();

        // if ($allPosts->count()>0) {
        //     foreach ($allPosts as $item){
        //         echo $item->title;
        //     }
        // }

        // $post = Post::find(1);

        // $post = new Post;
        // $post->title = 'Bài viết 3';
        // $post->content = 'Nội dung 3';
        // $post->status = 1;
        // $post->save();

        // Sử dụng queryBuilder

        // $activePosts = DB::table('posts')->where('status', 1)->get();

        // $activePosts = Post::where('status', 1)->orderBy('id', 'DESC')->get();

        // if ($activePosts->count()>0) {
        //     foreach ($activePosts as $item){
        //         echo $item->title;
        //     }
        // }

        // $allPosts = Post::all();
        // $activePosts = $allPosts->reject(function($post){
        //     return $post->status==0;
        // });

        // dd($activePosts);

        Post::chunk(2, function ($posts){
            foreach ($posts as $post){
                echo $post->title. "<br>";
            }
                echo 'Kết thúc chunk';
        });

        $allPosts = Post::where('status', 1)->cursor();

        foreach ($allPosts as $item){
            echo $item->title;
        }
    }
    public function add(){
        $dataInsert = [
            'title' => 'Báo danh 4',
            'content' => 'Nội dung 4',
            'status' => 1
        ];

        // $post = Post::create($dataInsert);

        // echo 'Id vừa insert: '.$post->id;

        // $insertStatus = Post::insert($dataInsert);
        // dd($insertStatus);

        // $post = Post::firstOrCreate([
        //     'id' => 11
        // ], $dataInsert);

        $check = true;
            
        $post = new Post;

        $post->title ='Bài viết mới';

        $post->content ='Nội dung mới';

        if ($check) {
            $post->status = 1;
        }

        $post->save();

        echo 'Id vừa insert: '.$post->id;
        dd($post);
    }
}
