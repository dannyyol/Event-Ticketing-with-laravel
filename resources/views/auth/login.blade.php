@extends('layouts.authentication')

@section('content')

    <div class="container">
        
        <div class="d-flex justify-content-center h-100">
            <div class="card">
                <div class="card-header">
                    <h3>Sign In</h3>
                    <div class="d-flex justify-content-end social_icon">
                        <span>
                            <a href="{{url('/redirect')}}">
                                <i class="fab fa-facebook-square"></i>
                            </a>
                        </span>
                        <span>
                            <a href="{{url('/google/redirect')}}">
                                <i class="fab fa-google-plus-square"></i>
                            </a>
                        </span>
                        {{-- <span><i class="fab fa-twitter-square"></i></span> --}}
                    </div>
                </div>
                <div class="card-body">
                    @if (count($errors) > 0)
                        <div class="alert">
                            <p><strong>Whoops!</strong> There were problems with input: </p>       
                                @foreach ($errors->all() as $error)
                                    <p style="list-style:none;">{{ $error }}</p>
                                @endforeach
                        </div>
                    @endif
                    <form class="form-horizontal"
                          role="form"
                          method="POST"
                          action="{{ url('login') }}">
                        <input type="hidden"
                               name="_token"
                               value="{{ csrf_token() }}">
                               
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            {{-- <input type="text" class="form-control" placeholder="username"> --}}

                            <input type="email"
                                       class="form-control"
                                       name="email"
                                       value="{{ old('email') }}" placeholder="Enter email">
                            
                        </div>
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="password"
                                       class="form-control"
                                       name="password" placeholder="Enter password">
                            {{-- <input type="password" class="form-control" placeholder="password"> --}}
                        </div>

                        <div class="row align-items-center remember">
                                <input type="checkbox"
                                name="remember"> Remember me
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Login" class="btn float-right login_btn">
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-center links">
                        Don't have an account?<a href="{{route('auth.register')}}">Sign Up</a>
                    </div>
                    <div class="d-flex justify-content-center">
                        <a href="{{ route('auth.password.reset') }}">Forgot your password?</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection