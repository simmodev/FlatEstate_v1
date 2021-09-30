<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>FlatEstate</title>
    <link rel="icon" href="{{asset('img/fav.png')}}" type="image/png" sizes="50x40">


    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" >

    <!-- Fonts -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: sans-serif;
        }
    </style>

    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body>



<nav class="navbar navbar-expand-lg fixed-top bg-primary">
    <div class="container">

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <i class="text-white fas fa-bars fa-2x"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item py-1">
                    <a href="{{route('home')}}" class="nav-link ">Home</a>
                </li>
                <li class="nav-item py-1">
                    <a href="{{route('posts.sale')}}" class="nav-link">Buy</a>
                </li>
                <li class="nav-item py-1">
                    <a href="{{route('posts.rent')}}" class="nav-link">Rent</a>
                </li>
                <li class="nav-item py-1">
                    <a href="{{route('post.create')}}" class="nav-link">Sell</a>
                </li>

            </ul>

            <div class="mx-auto">
                <a href="#" class="navbar-brand text-white">Navbar</a>
            </div>

            <form class="form-inline my-2 my-lg-0">
                <ul class="navbar-nav ml-md-auto">
                    @auth
                        <li class="nav-item py-1 ">
                            <a href="" class="nav-link"> {{auth()->user()->username}}  </a>
                        </li>
                        <li class="nav-item py-1">
                            <form action="{{route('logout')}}" method="post">
                                @csrf
                                <button type="submit" class="remove-button-css nav-link" style="outline: none;border: 0px; background: transparent; ">Logout</button>
                            </form>
                        </li>
                    @endauth
                    @guest
                        <li class="nav-item py-1">
                            <a href="{{route('register')}}" class="nav-link">Register</a>
                        </li>
                        <li class="nav-item py-1">
                            <a href="{{route('login')}}" class="nav-link">Login</a>
                        </li>
                    @endguest
                </ul>
            </form>
        </div>
    </div>
</nav>


@yield('content')



<script src="{{asset('js/main.js') }}"></script>


<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>
