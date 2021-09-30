<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        $posts = Post::orderBy('created_at', 'desc')->paginate(50);
        return view('admin.dashboard',['posts'=>$posts]);
    }

    public function delete(Post $post){
        $post->delete();
        return back();
    }
}
