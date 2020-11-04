@extends('layouts.auth_layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-5 mx-auto" style="margin:auto;">
        <a href="{{route('login')}}" style="text-decoration:none; color:black;">
          <h1 class="mx-auto text-uppercase" id="welcome_title">fantasy</h1>
          <span class=" mx-auto mt-2 ">Bet and Build Your Team</span>
        </a>
      </div>
        <div class="col-md-7">
            <div class="card shadow-lg w-100">
                <div class="card-body mt-3">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <div class="col-md-12">
                                <input id="email" placeholder="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <input id="password" placeholder="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                 <button type="submit" class="btn btn-primary form-control">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12 text-center">
                                @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                                @endif
                                <a href="{{route('register')}}">Don't have account ? Sign up here</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
