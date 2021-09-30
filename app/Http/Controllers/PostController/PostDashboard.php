<?php

namespace App\Http\Controllers\PostController;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostDashboard extends Controller
{

    public function saleIndex(){
        $countries = DB::table('countries')->get();
        $posts = Post::where('deal', '=', 'for sale')->orderBy('created_at', 'desc')->paginate(9);
        $deal = 'for sale';
        return view('posts.postDashboard',['countries'=>$countries,'posts'=>$posts,'search'=>'', 'sortby'=>'newest', 'country'=>'','city'=>'','type'=>'', 'deal'=>$deal]);
    }

    public function rentIndex(){
        $countries = DB::table('countries')->get();
        $posts = Post::where('deal', '=', 'for rent')->orderBy('created_at', 'desc')->paginate(9);
        $deal = 'for rent';
        return view('posts.postDashboard',['countries'=>$countries,'posts'=>$posts,'search'=>'', 'sortby'=>'newest', 'country'=>'','city'=>'','type'=>'', 'deal'=>$deal]);
    }

    public function filter(Request $request){
        $countries = DB::table('countries')->get();
        $query = Post::query();
        if ($request->search){
            $filtredPosts = $query->where('title','LIKE', '%'.$request->search.'%')
                                    ->orWhere('description','LIKE', '%'.$request->search.'%')
                                    ->orWhere('country','LIKE', '%'.$request->search.'%')
                                    ->orWhere('city','LIKE', '%'.$request->search.'%')
                                    ->orWhere('zipcode','LIKE', '%'.$request->search.'%')
                                    ->orWhere('address','LIKE', '%'.$request->search.'%');
        }
        if ($request->deal){
            $query->where('deal','=',$request->deal);
        }
        //up up
        if ($request->country){
            $query->where('country','=',$request->country);
        }
        if($request->city){
            $query->where('city','=',$request->city);
        }
        if($request->type){
            $query->where('type','=',$request->type);
        }
        if($request->sortby){
            if ($request->sortby=='newest'){
                $filtredPosts = $query->orderBy('created_at', 'desc')->paginate(9);
                $sortby = 'newest';
            }elseif ($request->sortby=='oldest'){
                $filtredPosts = $query->orderBy('created_at', 'asc')->paginate(9);
                $sortby = 'oldest';
            }
        }

        return view('posts.postDashboard',['countries'=>$countries,'posts'=>$filtredPosts, 'search'=>$request->search, 'sortby'=>$sortby, 'country'=>$request->country,'city'=>$request->city,'type'=>$request->type, 'deal'=>$request->deal]);
    }

    public function homeFilter(Request $request){
        $query = Post::query();
        if ($request->search){
            $filtredPosts = $query->where('title','LIKE', '%'.$request->search.'%')
                ->orWhere('description','LIKE', '%'.$request->search.'%')
                ->orWhere('country','LIKE', '%'.$request->search.'%')
                ->orWhere('city','LIKE', '%'.$request->search.'%')
                ->orWhere('zipcode','LIKE', '%'.$request->search.'%')
                ->orWhere('address','LIKE', '%'.$request->search.'%');
        }
        $filtredPosts = $query->orderBy('created_at', 'desc')->paginate(9);
        $countries = DB::table('countries')->get();
        return view('posts.postDashboard',['countries'=>$countries,'posts'=>$filtredPosts,'search'=>'', 'sortby'=>'newest', 'country'=>'','city'=>'','type'=>'', 'deal'=>'']);
    }



}
