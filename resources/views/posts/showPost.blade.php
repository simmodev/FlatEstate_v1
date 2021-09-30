@extends('layouts.app')

@section('content')
<div id="estate-page">
    <div class="container">
        <div class="container">
            <form action="{{route('posts.search')}}" type="get">
                <div class="row mb-4">
                    <div class="col-lg-8  mx-auto">
                        <div class="input-group">
                            <input name="search" class="form-control border-secondary py-2 btn-lg" type="search" placeholder="search">
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
                        <select name="deal" id="deal" class="form-control">
                            <option value="for sale">For Sale</option>
                            <option value="for rent">For Rent</option>
                        </select>
                    </div>
                    <div class=" m-auto" style="width: 23%;">
                        <select name="country" id="country" class="form-control">
                            <option value="" selected class="text-muted" style="background: #efefef">country</option>
                            @foreach($countries as $countryseed)
                                <option value="{{$countryseed->name}}">{{$countryseed->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class=" m-auto" style="width: 23%">
                        <select name="type" id="type" class="form-control">
                            <option value="" selected class="text-muted" style="background: #efefef">Type</option>
                            <option value="apartment">Apartment</option>
                            <option value="House">House</option>
                            <option value="Villa">Villa</option>
                            <option value="Land">Land</option>
                            <option value="Office">Office</option>
                            <option value="Farm">Farm</option>
                        </select>
                    </div>
                    <div class=" m-auto" style="width: 23%;">
                        <select name="sortby" id="sortby" class="form-control">
                            <option value="newest">Newest</option>
                            <option value="oldest">Oldest</option>
                        </select>
                    </div>
                    <div class=" m-auto" style="width: 5%;">
                        <button class="btn btn-outline-secondary" type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <hr>
        <div class="row">
            <div class="col-lg-8 mx-auto">
                @if(auth()->user() && auth()->user()->id == $post->user_id)
                    <form class="float-right" action="{{route('post.delete', $post)}}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger rounded "><i class="far fa-trash-alt"></i></button>
                    </form>
                    <form class="float-right" action="{{route('post.index.edit', $post->id)}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-outline-secondary rounded mx-1"><i class="far fa-edit"></i></button>
                    </form>
                @endif

                <h2 >{{$post->title}}</h2>

                <div class="">
                    <h2 class="text-primary mb-3 d-inline-block">{{number_format($post->price)}}$</h2>
                    <button class="btn btn-primary btn-sm float-right d-inline-block" disabled><i class="fas fa-home"></i> {{$post->type}} {{$post->deal}}</button>
                </div>
                <hr>
                <div class="border border-secondary rounded d-inline p-1 ml-3">{{number_format($post->surface)}} ㎡</div>
                <div class="d-inline float-right mr-3">
                    <p class="d-inline ellipsis"><strong>{{$post->country}}, {{$post->city}}, {{$post->zipcode}}</strong></p>
                </div>
                <div class = "card-wrapper mt-3 mx-auto" >
                    <div class = "card">
                        <div class = "product-imgs">
                            <div class = "img-display">
                                <div class = "img-showcase">
                                    @foreach($images as $image)
                                        <img src = "{{asset('postImage/'.$image->image_path)}}" alt = "shoe image">
                                    @endforeach
                                </div>
                            </div>
                            @php
                                $i =0;
                            @endphp
                            <div class = "img-select">
                                @foreach($images as $image)
                                    @php
                                        $i += 1
                                    @endphp
                                    <div class = "img-item" >
                                        <a href = "#" data-id = "{{$i}}">
                                            <img style="max-height: 100px; max-width: 150px" src = "{{asset('postImage/'.$image->image_path)}}" alt = "shoe image">
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="data float-right my-2"><i class="fas fa-table "></i> {{date('d-m-Y', strtotime($post->created_at))}}</div>

                <div class="description">
                    <h5 class="mt-3">Description:</h5>
                    <table class="table">
                        <tbody>
                        <tr>
                            <td>Price</td>
                            <th scope="row">{{number_format($post->price)}}$</th>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <th scope="row">{{$post->city}}, {{$post->zipcode}}, {{$post->address}}</th>
                        </tr>
                        <tr>
                            <td>Deal</td>
                            <th scope="row">{{$post->deal}}</th>
                        </tr>
                        <tr>
                            <td>Estate Type</td>
                            <th scope="row">{{$post->type}}</th>
                        </tr>
                        <tr>
                            <td>Condition</td>
                            <th scope="row">{{$post->condition}}</th>
                        </tr>
                        <tr>
                            <td>Agent phone number</td>
                            <th scope="row">{{$post->phoneNumber}}</th>
                        </tr>
                        </tbody>
                    </table>
                    <h5 class="mt-3">Agent description:</h5>
                    <hr>
                    <p class="my-2">{{$post->description}}</p>
                    <hr>
                </div>
                <h5 class="mt-5">Map Location:</h5>
                <div id="map" style="height:500px;" class="my-3 w-100 ">
                </div>
            </div>
            <div class="col-lg-4 d-none d-lg-block mx-auto rounded position-relative" id="sidebar">
                @foreach($otherPosts as $otherPost)
                    <div class="my-4">
                        <a href="{{route('post.show',$otherPost->id)}}" class="text-decoration-none text-dark">
                            <div class="card" style="width: 100%;">
                                <img class="card-img-top" src="{{asset('postImage/'.$otherPost->first_image_path)}}" alt="Card image cap" style="width: 100%; height: 150px">
                                <div class="card-body">
                                    <h5 class="card-title ellipsis">{{$otherPost->title}}</h5>
                                    <h4 class="card-title ellipsis text-primary">{{number_format($otherPost->price)}}$, {{$otherPost->surface}}㎡</h4>
                                    <p class="card-text ellipsis2">{{$otherPost->description}}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>




    </div>
    <script>
        let map;
        function initMap() {
            map = new google.maps.Map(document.getElementById("map"), {
                center: {lat: {{$post->lat}}, lng: {{$post->lng}}},
                zoom: 11,
                scrollwheel: true,
            });

            const uluru = {lat: {{$post->lat}}, lng: {{$post->lng}}};
            let marker = new google.maps.Marker({
                position: uluru,
                map: map,
                draggable: false
            });
        }
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBqfzTDDmwl5x_qBclMGrseeZ301fbSWQ0&callback=initMap"
            type="text/javascript"></script>
</div>
@endsection
