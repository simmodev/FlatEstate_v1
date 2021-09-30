<?php

namespace App\Http\Controllers\PostController;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShowPost extends Controller
{
    public function index($id){
        $countries = DB::table('countries')->get();

        if(Post::all()->count()>2){
            $otherPosts = Post::all()->random(3);
        }else{
            $otherPosts = Post::all()->random(1);
        }
        $post = Post::where('id','=',$id)->first();
        $images = DB::table('post_images')->where('post_id','=',$id)->get();

        return view('posts.showPost',['countries'=>$countries, 'post'=>$post, 'images'=>$images, 'otherPosts'=>$otherPosts]);
    }
}
