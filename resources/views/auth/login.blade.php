@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mx-auto ">
                <div class="card bg-light text-center card-form">
                    <div class="card-body">
                        <h3 class="mb-4">Login to your account !</h3>
                        @if(session('status'))
                            <div class="alert alert-danger">
                                {{session('status')}}
                            </div>

                        @endif
                        <form action="{{ route('login') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <input value="{{old('email')}}" type="email" class="form-control form-control-lg @error('email') border-danger @enderror" placeholder="Email" name="email">

                                @error('email')
                                <p class="text-danger text-left">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control form-control-lg @error('password') border-danger @enderror" placeholder="Password" name="password">

                                @error('password')
                                <p class="text-danger text-left">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="form-group mb-4">
                                <div class="form-check">
                                    <input type="checkbox" name="remember" id="remember" class="form-check-input position-static mr-1">
                                    <label for="remember" class="form-check-label "style="font-size: 16px">Remember me</label>
                                </div>
                            </div>

                            <input type="submit" value="Login" class="btn btn-primary btn-block">
                        </form>
                    </div>
                    <a href="{{route('register')}}" class="text-center mb-2" style="font-size: 16px">You don't have an account?</a>
                </div>
            </div>
        </div>
    </div>
@endsection
