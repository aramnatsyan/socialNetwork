@extends('layouts.app')


@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6 login-section-wrapper">
                <div id="welcome-page-logo">
                    <img src="{{asset('logo/DISQO_Logo.png')}}" alt="logo">
                    <div class="d-flex justify-content-between">
                        <div><img src="{{asset('icons/back-arrow-icon.png')}}" alt="" width="20px">
                            <a class="log-reg" href="{{ route('login') }}">{{ __('Back To Login') }}</a></div>
                        <div>
                            <a class="log-reg" href="{{ route('register') }}">{{ __('Go To register') }}</a><img src="{{asset('icons/arrow-icon.png')}}" alt="" width="20px"></div>
                    </div>
                </div>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">{{ __('Reset Password') }}</div>

                                <div class="card-body">
                                    @if (session('status'))
                                        <div class="alert alert-success" role="alert">
                                            {{ session('status') }}
                                        </div>
                                    @endif

                                    <form method="POST" action="{{ route('password.email') }}">
                                        @csrf

                                        <div class="form-group row">
                                            <label for="email"
                                                   class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                            <div class="col-md-6">
                                                <input id="email" type="email"
                                                       class="form-control @error('email') is-invalid @enderror"
                                                       name="email" value="{{ old('email') }}" required
                                                       autocomplete="email" autofocus>

                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row mb-0">
                                            <div class="col-md-6 offset-md-4">
                                                <button type="submit" class="btn btn-primary login-button">
                                                    {{ __('Send Password Reset Link') }}
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 px-0 d-none d-sm-block">
                <img src="{{asset('welcome/images/password-clipart-88-images-in-collection-page-2-password-clipart-612_612.jpg')}}" alt="login image" class="login-img">
            </div>
        </div>
    </div>
@endsection
