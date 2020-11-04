@extends('layouts.auth_layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-5 mx-auto" style="margin:auto;">
        <a href="{{route('login')}}" style="text-decoration:none; color:black;">
          <h1 class="mx-auto text-uppercase" id="welcome_title">fantasy</h1>
          <h5 class=" mx-auto mt-2 ">Bet and Build Your Team</h5>
        </a>
      </div>
        <div class="col-md-7">
            <div class="card shadow-lg w-100">
                <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }}, <a href="{{ route('verification.resend') }}">{{ __('click here to request another') }}</a>.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
