<?php

namespace App\Http\Controllers\PostController;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    public function delete($id){
        $images = DB::table('post_images')->where('post_id','=',$id)->get();
        $imagesArr = [];
        foreach ($images as $image){
            array_push($imagesArr, public_path('postImage/').$image->image_path);
        }
        File::delete($imagesArr);

        DB::table('post_images')->where('post_id', '=', $id)->delete();

        DB::table('posts')->where('id', '=', $id)->delete();
        $countries = DB::table('countries')->get();
        $deal = 'for sale';
        $posts = Post::where('deal', '=', 'for sale')->orderBy('created_at', 'desc')->paginate(9);

        return view('posts.postDashboard',['countries'=>$countries,'posts'=>$posts,'search'=>'', 'sortby'=>'newest', 'country'=>'','city'=>'','type'=>'', 'deal'=>$deal]);
    }

    public function editIndex(Post $post){
        $countries = DB::table('countries')->get();
        $post = Post::where('id', '=', $post->id)->first();
        $postImages = DB::table('post_images')->where('post_id', '=', $post->id)->get();

        return view('posts/editPost',['post'=>$post, 'postImages'=>$postImages, 'countries'=>$countries]);
    }

    public function cancel($id){
        return redirect(route('post.show', $id));
    }

    public function edit(Request $request, Post $post){
        $request->validate([
            'title'=>'required|max:255',
            'description'=>'required|max:5000',
            'image.*'=>'mimes:jpeg,jpg,png|max:5048',
            'phoneNumber'=>'required|numeric|min:10',
            'country'=>'required|max:255',
            'city'=>'required|max:255',
            'zipcode'=>'required|numeric|max:varchar(255)',
            'address'=>'required|max:255',
            'lat'=>'required|max:255',
            'lng'=>'required|max:255',
            'deal'=>'required|max:255',
            'type'=>'required|max:255',
            'condition'=>'required|max:255',
            'surface' => 'required|numeric|max:varchar(255)',
            'price' => 'required|numeric|max:varchar(255)',
        ]);
        if($request->image){
            $firstImage = time(). '-'.$request->title.'-'.$request->image[0]->getClientOriginalName();
            $post = Post::find($post->id);
        }

        $post->title = $request->title;
        $post->description = $request->description;
        $post->phoneNumber = $request->phoneNumber;
        $post->country = $request->country;
        $post->city = $request->city;
        $post->zipcode = $request->zipcode;
        $post->address = $request->address;
        $post->lat = $request->lat;
        $post->lng = $request->lng;
        $post->deal = $request->deal;
        $post->type = $request->type;
        $post->condition = $request->condition;
        $post->surface = $request->surface;
        $post->price = $request->price;

        $post->save();

        if($request->image){
            foreach($request->file('image') as $item){
                $name = time(). '-'.$request->title.'-'.$item->getClientOriginalName();

                $item->move(public_path('postImage'), $name);

                $image = Image::make(public_path('postImage/'.$name))->fit(1200,800);
                $image->save();

                if($item==0){
                    $post->images()->create([
                        'post_id'=>$request->user()->posts(),
                        'image_path'=>$firstImage,
                    ]);
                }else{
                    $post->images()->create([
                        'post_id'=>$request->user()->posts(),
                        'image_path'=>$name,
                    ]);
                }
            }
        }
        return redirect(route('post.show', ['id'=>$post->id]));

    }


}
