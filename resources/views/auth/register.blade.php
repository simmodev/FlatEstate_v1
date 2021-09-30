@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mx-auto">
                <div class="card bg-light text-center card-form">
                    <div class="card-body">
                        <h3>Sign Up Today !</h3>
                        <p>Please fill out this form to register.</p>
                        <form action="{{ route('register') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <input value="{{old('username')}}" type="text" class="form-control form-control-lg @error('username') border-danger @enderror" placeholder="Last Name" name="username">

                                @error('username')
                                <p class="text-danger text-left">{{$message}}</p>
                                @enderror
                            </div>
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
                            <div class="form-group">
                                <input type="password" class="form-control form-control-lg" placeholder="Confirm Password" name="password_confirmation">
                            </div>
                            <input type="submit" value="Submit" class="btn btn-primary btn-block">
                        </form>
                    </div>
                    <a href="{{route('login')}}" class="text-center mb-2" style="font-size: 16px">Already have an account ?</a>
                </div>
            </div>
        </div>
    </div>
@endsection
