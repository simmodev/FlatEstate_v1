@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="container">
            <form action="{{route('posts.search')}}" type="get">
            <div class="row mb-4">
                <div class="col-lg-8  mx-auto">
                    <div class="input-group">
                        <input value="{{$search}}" name="search" class="form-control border-secondary py-2 btn-lg" type="search" placeholder="search">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="submit">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class=" m-auto" style="width: 23%;">
                    <select name="deal" id="deal" class="form-control" onchange="this.form.submit()">
                        <option value="for sale" @if($deal=="for sale")selected @endif>For Sale</option>
                        <option value="for rent" @if($deal=="for rent")selected @endif>For Rent</option>
                    </select>
                </div>
                <div class=" m-auto" style="width: 23%;">
                    <select name="country" id="country" class="form-control" onchange="this.form.submit()">
                        <option value="" selected class="text-muted" style="background: #efefef">country</option>
                        @foreach($countries as $countryseed)
                            <option value="{{$countryseed->name}}" @if($country=="$countryseed->name") selected @endif>{{$countryseed->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class=" m-auto" style="width: 23%;">
                    <select name="type" id="type" class="form-control" onchange="this.form.submit()">
                        <option value="" selected class="text-muted" style="background: #efefef">Type</option>
                        <option value="apartment" @if($type=="apartment")selected @endif>Apartment</option>
                        <option value="House" @if($type=="House")selected @endif>House</option>
                        <option value="Villa" @if($type=="Villa")selected @endif>Villa</option>
                        <option value="Land" @if($type=="Land")selected @endif>Land</option>
                        <option value="Office" @if($type=="Office")selected @endif>Office</option>
                        <option value="Farm" @if($type=="Farm")selected @endif>Farm</option>
                    </select>
                </div>
                <div class=" m-auto" style="width: 23%;">
                    <select name="sortby" id="sortby" class="form-control" onchange="this.form.submit()">
                        <option value="newest" @if($sortby=='newest')selected @endif>Newest</option>
                        <option value="oldest" @if($sortby=='oldest')selected @endif>Oldest</option>
                    </select>
                </div>
            </div>
            </form>
            <hr>
        </div>
        <div class="card-group">
            @foreach($posts as $post)
                <a href="{{route('post.show',$post->id)}}" class="text-decoration-none text-dark">
                <div class="row">
                    <div class="col-4">
                        <div class="card m-3" style="width: 21rem;">
                            <img class="card-img-top" src="{{asset('postImage/'.$post->first_image_path)}}" style="width: 100%; height: 160px">
                            <div class="card-body">
                                <h4 class="text-primary ellipsis">{{number_format($post->price) }}$, {{$post->surface}}㎡</h4>
                                <h5 class="display-5 ellipsis">{{$post->title}}</h5>
                                <p class="ellipsis">{{$post->description}}</p>
                                <div class="row">
                                    <div class="col-7">
                                        <p class="ellipsis">{{$post->country}}, {{$post->city}}, {{$post->zipcode}}</p>
                                    </div>
                                    <div class="col-5">
                                        <div class="text-right"><i class="fas fa-table "></i> {{$post->created_at->format('Y-m-d')}}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </a>

            @endforeach
        </div>
        <div class="d-flex justify-content-center">
            {{ $posts->withQueryString()->links() }}
        </div>
    </div>




@endsection
