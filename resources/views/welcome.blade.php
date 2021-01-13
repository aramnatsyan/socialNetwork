<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>DISCO SocialNetwork</title>

        <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

        <!-- Styles -->
        <link rel="stylesheet" href="{{asset('welcome/css/welcome.css')}}">

    </head>
    <body class="antialiased">
{{--    @if (Route::has('login'))--}}
{{--        <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">--}}
{{--            @auth--}}
{{--                <a href="{{ url('/home') }}" class="text-sm text-gray-700 underline">Home</a>--}}
{{--            @else--}}
{{--                <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Login</a>--}}

{{--                @if (Route::has('register'))--}}
{{--                    <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>--}}
{{--                @endif--}}
{{--            @endauth--}}
{{--        </div>--}}
{{--    @endif--}}
        <main>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6 login-section-wrapper">
                        <div id="welcome-page-logo">
                            <img src="{{asset('logo/DISQO_Logo.png')}}" alt="logo">
                        </div>
                        <div class="login-wrapper my-auto" style="margin: 0 auto">
                            <h1 class="login-title">Log in</h1>
                            <form action="#!">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" id="email" class="form-control" placeholder="email@example.com">
                                </div>
                                <div class="form-group mb-4">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" id="password" class="form-control" placeholder="enter your passsword">
                                </div>
                                <input name="login" id="login" class="btn btn-block login-btn" type="button" value="Login">
                            </form>
                            <p class="login-wrapper-footer-text">Don't have an account? <a id="register-a-element" href="#!" class="text-reset">Register here</a></p>
                        </div>
                    </div>
                    <div class="col-sm-6 px-0 d-none d-sm-block">
                        <img src="{{asset('welcome/images/5bb20170bb2268.54083261.jpg')}}" alt="login image" class="login-img">
                    </div>
                </div>
            </div>
        </main>
    </body>
</html>
