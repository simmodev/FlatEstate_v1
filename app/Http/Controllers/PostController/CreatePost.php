<?php

namespace App\Http\Controllers\PostController;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class CreatePost extends Controller
{


    public function index(){
        $countries = DB::table('countries')->get();
        return view('posts.createPost', ['countries'=>$countries]);
    }

    public function store(Request $request){


        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required|max:5000',
            'image' => 'required',
            'image.*' => 'mimes:jpeg,jpg,png|max:5048',
            'phoneNumber' => 'required|numeric|min:10',
            'country' => 'required|max:255',
            'city' => 'required|max:255',
            'address' => 'required|max:255',
            'lat' => 'required|max:255',
            'lng' => 'required|max:255',
            'deal' => 'required|max:255',
            'type' => 'required|max:255',
            'condition' => 'required|max:255',
            'surface' => 'required|numeric|max:varchar(255)',
            'price' => 'required|numeric|max:varchar(255)',
        ]);



        $firstImage = time().'-'.$request->title.'-'.$request->image[0]->getClientOriginalName();

        $post=$request->user()->posts()->create([
            'title'=>$request->title,
            'description'=>$request->description,
            'first_image_path'=>$firstImage,
            'phoneNumber'=>$request->phoneNumber,
            'country'=>$request->country,
            'city'=>$request->city,
            'address'=>$request->address,
            'zipcode'=>$request->zipcode,
            'lat'=>$request->lat,
            'lng'=>$request->lng,
            'deal'=>$request->deal,
            'type'=>$request->type,
            'condition'=>$request->condition,
            'surface'=>$request->surface,
            'price'=>$request->price,
        ]);

        foreach($request->file('image') as $item){

            if($item==0){
                $item->move(public_path('postImage'), $firstImage);

                $image = Image::make(public_path('postImage/'.$firstImage))->fit(1200,800);
                $image->save();

                $post->images()->create([
                    'post_id'=>$request->user()->posts(),
                    'image_path'=>$firstImage,
                ]);
            }else{
                $name = time(). '-'.$request->title.'-'.$item->getClientOriginalName();

                $item->move(public_path('postImage'), $name);

                $image = Image::make(public_path('postImage/'.$name))->fit(1200,800);
                $image->save();

                $post->images()->create([
                    'post_id'=>$request->user()->posts(),
                    'image_path'=>$name,
                ]);
            }

        }
        return redirect(route('post.show', $post->id));


/*        Post::create([
            'title'=>$request->title,
            'description'=>$request->description,
            'imagePath'=>'gg',
        ]);*/

        /*foreach($request->file('image') as $item){
            $name = time(). '-'.$request->title.'-'.$item->getClientOriginalName();
            $item->move(public_path('postImage'), $name);
            $imgData[] = $name;
        }

        Post::create([
            'title'=>$request->title,
            'description'=>$request->description,
            'imagePath'=>json_encode($imgData),
        ]);*/

    }
}
