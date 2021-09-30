@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card bg-light text-center card-form mb-3">
            <div class="card-body">
                <form action="{{ route('post.edit', $post) }}" method="post" enctype="multipart/form-data" id="main-form">
                    @csrf
                    <h3 class="text-primary text-left border-bottom border-primary">Post Information:</h3>
                    <div class="row">
                        <div class="col-8">
                            <div class="form-group">
                                <input value="{{$post->title}}" type="text" class="form-control mb-3 @error('title') border-danger @enderror" placeholder="title" name="title">

                                @error('title')
                                <p class="text-danger text-left">{{$message}}</p>
                                @enderror

                                <textarea type="text" class="form-control  @error('description') border-danger @enderror" placeholder="description" name="description">{{$post->description}}</textarea>

                                @error('description')
                                <p class="text-danger text-left">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-4">
                            <input value="{{$post->phoneNumber}}" type="number" class="form-control @error('phoneNumber') border-danger @enderror" placeholder="You number" name="phoneNumber">
                            @error('phoneNumber')
                            <p class="text-danger text-left">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="col-12 mb-4">
                            <div class="card shadow-sm w-100">
                                <div class="card-header d-flex justify-content-between">
                                    <h4>Add more images</h4>
                                    <input type="file" name="image[]" id="image" multiple="multiple" class="d-none" onchange="image_select()">
                                    <button class="btn btn-sm btn-primary" type="button" onclick="document.getElementById('image').click()">Choose Images</button>
                                </div>
                                <div class="card-body d-flex flex-wrap justify-content-start" id="container">
                                    <!-- image preview -->
                                </div>
                            </div>
                            @error('image')
                            <p class="text-danger text-left">{{$message}}</p>
                            @enderror
                            @error('image.*')
                            <p class="text-danger text-left">{{$message}}</p>
                            @enderror
<!--                            <div class="form-group">
                                <input type="file" class="form-control-file" placeholder="image" name="image[]" multiple="multiple">
                                @error('image.*')
                                <p class="text-danger text-left">{{$message}}</p>
                                @enderror
                            </div>-->
                        </div>

                    </div>



                    {{--------------------------------------------------------------------------}}
                    <h3 class="text-primary text-left border-bottom border-primary">Location:</h3>
                    <div class="mapform" >
                        <div class="row">
                            <div class="col-md-4 mt-5">
                                <select name="country" id="country" class="form-control @error('country') border-danger @enderror">
                                    <option value="" class="text-muted" style="background: #efefef">Country</option>
                                    @foreach($countries as $country)
                                        <option value="{{$country->name}}" @if($post->country==$country->name) selected @endif>{{$country->name}}</option>
                                    @endforeach
                                </select>
                                @error('country')
                                <p class="text-danger text-left">{{$message}}</p>
                                @enderror
                                <input value="{{$post->city}}" type="text" class="form-control mt-2 @error('city') border-danger @enderror" name="city" id="city" placeholder="city">
                                @error('city')
                                <p class="text-danger text-left">{{$message}}</p>
                                @enderror
                                <input value="{{$post->zipcode}}" type="number" class="form-control mt-2 @error('city') border-danger @enderror" name="zipcode" id="zipcode" placeholder="zipcode">
                                @error('zipcode')
                                <p class="text-danger text-left">{{$message}}</p>
                                @enderror
                                <textarea type="text" class="form-control mt-2 @error('address') border-danger @enderror" name="address" id="address" placeholder="address">{{$post->address}}</textarea>
                                @error('address')
                                <p class="text-danger text-left">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="col-md-8">
                                <div class="form-inline">
                                    <input value="{{$post->lat}}" type="text" class="form-control" placeholder="lat" name="lat" id="lat" hidden>
                                    <input value="{{$post->lng}}" type="text" class="form-control " placeholder="lng" name="lng" id="lng" hidden>
                                </div>
                                @error('lat')
                                <p class="alert alert-danger text-left">please select the estate location</p>
                                @enderror
                                <div id="map" style="height:500px;" class="my-3 w-100 ">

                                </div>
                            </div>
                        </div>


                    </div>

                    {{--------------------------------------------------------------------------------------}}

                    <h3 class="text-primary text-left border-bottom border-primary">Estate information:</h3>

                    <div class="row my-4">
                        <div class="col-6 ">
                            <div class="form-inline mx-auto">
                                <strong>Surface:</strong>
                                @error('surface')
                                <p class="text-danger">*</p>
                                @enderror
                                <div class="input-group mr-5">
                                    <input value="{{$post->surface}}" type="text" class="form-control border-secondary ml-2 @error('surface') border-danger @enderror" placeholder="Surface" name="surface" id="surface" >
                                    <div class="input-group-append ">
                                        <button class="btn btn-outline-secondary text-dark" disabled >
                                            ㎡
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-inline">
                                <strong>Price:</strong>
                                @error('price')
                                <p class="text-danger">*{{$message}}</p>
                                @enderror
                                <div class="input-group">
                                    <input value="{{$post->price}}" type="text" class="form-control border-secondary ml-2 @error('price') border-danger @enderror" placeholder="Price" name="price" id="price">
                                    <div class="input-group-append ">
                                        <button class="btn btn-outline-secondary text-dark" disabled>
                                            <i class="far fa-dollar-sign"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row text-left border mb-3">
                        <div class="col-lg-3 border-right p-2">
                            <div class="custom-control-inline">
                                <h5 class="font-weight-bold mx-2">Deal:</h5>
                                @error('deal')
                                <p class="text-danger">Select the deal.</p>
                                @enderror
                            </div>
                            <br>
                            <label><input type="radio" name="deal" value="for sale" class="mx-1" @if($post->deal=='for sale') checked @endif>For sale</label><br>
                            <label><input type="radio" name="deal" value="for rent" class="mx-1" @if($post->deal=='for rent') checked @endif>For rent</label><br>
                        </div>
                        <div class="col-lg-5 border-right p-2">
                            <div class="custom-control-inline">
                                <h5 class="font-weight-bold mx-2">Estate Type:</h5>
                                @error('type')
                                <p class="text-danger">Select the estate type.</p>
                                @enderror
                            </div><br>

                            <div class="row">
                                <div class="col-6">
                                    <label><input type="radio" name="type" value="apartment" class="mx-1" @if($post->type=='apartment') checked @endif>apartment</label><br>
                                    <label><input type="radio" name="type" value="House" class="mx-1" @if($post->type=='House') checked @endif>House</label><br>
                                    <label><input type="radio" name="type" value="Villa" class="mx-1" @if($post->type=='Villa') checked @endif>Villa</label><br>

                                </div>
                                <div class="col-6">
                                    <label><input type="radio" name="type" value="Land" class="mx-1" @if($post->type=='Land') checked @endif>Land</label><br>
                                    <label><input type="radio" name="type" value="Office" class="mx-1" @if($post->type=='Office') checked @endif>Office</label><br>
                                    <label><input type="radio" name="type" value="Farm" class="mx-1" @if($post->type=='Farm') checked @endif>Farm</label><br>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-4  p-2">
                            <div class="custom-control-inline">
                                <h5 class="font-weight-bold mx-2">condition:</h5>
                                @error('condition')
                                <p class="text-danger">Select the condition.</p>
                                @enderror
                            </div><br>
                            <label><input type="radio" name="condition" value="New" class="mx-1" @if($post->condition=='New') checked @endif>New</label><br>
                            <label><input type="radio" name="condition" value="Good condition" class="mx-1" @if($post->condition=='Good condition') checked @endif>Good condition</label><br>
                            <label><input type="radio" name="condition" value="To renovate" class="mx-1" @if($post->condition=='To renovate') checked @endif>To renovate</label><br>
                        </div>
                    </div>
                </form>

                <div class="row my-4">
                    <div class="col-6">
                        <form action="{{route('edit.cancel', $post->id)}}" method="post">
                            @csrf
                            <input type="submit" value="Cancel" class="btn btn-danger btn-block">
                        </form>

                    </div>
                    <div class="col-6">
                        <button type="submit" id="edit" class="btn btn-primary btn-block" form="main-form">Edit</button>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <script>
        let map;
        function initMap() {
            map = new google.maps.Map(document.getElementById("map"), {
                center: { lat: {{$post->lat}}, lng: {{$post->lng}} },
                zoom: 14,
                scrollwheel: true,
            });

            const uluru = { lat: {{$post->lat}}, lng: {{$post->lng}} };
            let marker = new google.maps.Marker({
                position: uluru,
                map: map,
                draggable: true
            });

            google.maps.event.addListener(map,'click',
                function (event){
                    pos = event.latLng
                    marker.setPosition(pos)
                })

            google.maps.event.addListener(marker,'position_changed',
                function (){
                    let lat = marker.position.lat()
                    let lng = marker.position.lng()
                    $('#lat').val(lat)
                    $('#lng').val(lng)
                })

        }
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBqfzTDDmwl5x_qBclMGrseeZ301fbSWQ0&callback=initMap"
            type="text/javascript"></script>

    <script src="{{asset('js/image-preview.js') }}"></script

@endsection
