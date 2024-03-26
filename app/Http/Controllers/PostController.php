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
}
