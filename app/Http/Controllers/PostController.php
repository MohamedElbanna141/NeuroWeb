<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index(){
        $posts = Post::all();

        return view('pages.posts.index', compact('posts'));
    }

    public function GetPost($id){
        $post = Post::where('id', $id)->get();

        return view('pages.posts.post', compact('post'));
    }

    public function DeletePost(POst $post){
        $posts = Post::where('id',$id)->delete();
        $post->delete();
    }
}

