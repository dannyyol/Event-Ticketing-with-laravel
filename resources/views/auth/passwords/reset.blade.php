@extends('layouts.authentication')

@section('content')
<div class="container">
        
        <div class="d-flex justify-content-center h-100">
            <div class="card">
                <div class="card-header">
                    <h3 align="center" style="position:relative;top:-70px;"><i class="fa fa-lock fa-4x"></i></h3>
                  <h2 align="center" class="text-center" style="color:#fff;margin-top:-30px">Reset Password</h2>
                  {{-- <p  align="center" class="text-white">You can reset your password here.</p> --}}
                </div>
                <div class="card-body">
                   @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                            
                        </div>
                    @endif

                    <form class="form-horizontal"
                          role="form"
                          method="POST"
                          action="{{ url('password/reset') }}">
                        <input type="hidden"
                               name="_token"
                               value="{{ csrf_token() }}">
                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
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

                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="password"
                                       class="form-control"
                                       name="password_confirmation" placeholder="Enter password confirmation">
                            {{-- <input type="password" class="form-control" placeholder="password"> --}}
                        </div>

                        <div class="form-group">
                            <input type="submit" value="Reset" class="btn float-right login_btn">
                        </div>

                        
                    </form>
                </div>
                
            </div>
        </div>
    </div>


@endsection

