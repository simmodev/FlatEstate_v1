@extends('layouts.app')

@section('content')
    <div id="home-section" class="">
        <div class="align-items-center">
            <div class="container">
                <div class="home-content">
                    <h1 class="text-white display-3 text-center mb-5" id="home-title">When you’re ready for a change, we’re ready to help.</h1>
                    <form action="{{route('home.search')}}" type="get">
                        <div class="row mb-4">
                            <div class="col-lg-8  mx-auto">
                                <div class="input-group">
                                    <input name="search" class="form-control border-secondary py-4 btn-lg" type="search" placeholder="Enter an address, neighborhood, city, or ZIP code...">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary bg-white" type="submit">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="explore-section" class="my-5">
        <div class="">
            <div class="container text-center mx-auto" id="explore-title">
                <h2 class="mx-5 mb-5" >Whether you’re buying, selling or renting, we can help you move forward.</h2>
            </div>

            <div class="row mx-4">
                <div class="col-lg-4 mb-2">
                    <div class="card" style="width: 100%;">
                        <img class="card-img-top" src="{{asset('img/buy.svg')}}" alt="Card image cap" style="height: 200px">
                        <div class="card-body">
                            <h3 class="text-center mb-3">Buy a Home</h3>
                            <p class="card-text text-center">Find your place with an immersive photo experience and the most listings, including things you won’t find anywhere else.</p>
                            <div class="text-center mt-4">
                                <form action="{{route('posts.sale')}}" method="get">
                                    <button class="btn btn-outline-primary btn-lg">Search Home</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-2">
                    <div class="card" style="width: 100%;">
                        <img class="card-img-top" src="{{asset('img/sell.svg')}}" alt="Card image cap" style="height: 200px">
                        <div class="card-body">
                            <h3 class="text-center mb-3">Sell a Home</h3>
                            <p class="card-text text-center">Whether you get a cash offer through FlatEstate® or choose to sell traditionally, we can help you navigate a successful sale.</p>
                            <div class="text-center mt-4">
                                <form action="{{route('post.create')}}" method="get">
                                    <button class="btn btn-outline-primary btn-lg">Find your options</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-2">
                    <div class="card" style="width: 100%;">
                        <img class="card-img-top" src="{{asset('img/rent.svg')}}" alt="Card image cap" style="height: 200px">
                        <div class="card-body">
                            <h3 class="text-center mb-3">Rent a Home</h3>
                            <p class="card-text text-center">We’re creating a seamless online experience – from shopping on the largest rental network, to applying, to paying rent.</p>
                            <div class="text-center mt-4">
                                <form action="{{route('posts.rent')}}" method="get">
                                    <button class="btn btn-outline-primary btn-lg">Find rentals</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="main-footer">
        <p class="text-center"><strong>Copiright © By Simodev.</strong> </p>
    </div>
    <div id="footer">

    </div>

@endsection
