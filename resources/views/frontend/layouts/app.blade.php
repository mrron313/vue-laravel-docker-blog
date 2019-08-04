<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Tech Blog') }}</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Favicon -->
        <link rel="shortcut icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon-32x32.png') }}">

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/blog.css') }}" rel="stylesheet">
    </head>
    <body>
        <div id="app">
            {{-- <nav class="navbar navbar-expand-md navbar-light navbar-laravel"> --}}
            <nav class="mb-1 navbar navbar-expand-md navbar-light secondary-color lighten-1 navbar-laravel">

                <div class="container">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img src="images/logo.png" alt="logo">
                        {{ config('app.name', 'Tech Blog') }}
                    </a>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">

                        <!-- Left Side Of Navbar -->	
                        <ul class="navbar-nav mr-auto">	
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('frontend.post') }}">Blog</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="">About</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="">Contact</a>
                            </li>
                        </ul>
                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto nav-flex-icons">
                            <!-- Authentication Links -->
                            @guest
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item avatar dropdown">
                                    {{-- <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                    </a> --}}

                                    <a class="nav-link" id="navbarDropdown" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <img src="https://mdbootstrap.com/img/Photos/Avatars/avatar-2.jpg" class="rounded-circle z-depth-0"
                                        alt="avatar image">
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                        @if(auth()->user()->role == 1)
                                            <a class="dropdown-item" href="{{ route('backend.dashboard') }}" >
                                                {{ __('Dashboard') }}
                                            </a>
                                        @endif 
                                        
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>   

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>

            <main>
                <div id="token"></div>
                <div id="msg"></div>
                <div id="notis"></div>
                <div id="err"></div>
                
                @yield('content')
            </main>

            <!-- Footer -->
            <footer class="py-5 bg-dark">
            <div class="container">
                <p class="m-0 text-center text-white">Copyright &copy; Tech Blog by Arif Ul Islam Ron 2019</p>
            </div>
            <!-- /.container -->
            </footer>
            
        </div>

        <script src="https://www.gstatic.com/firebasejs/6.3.4/firebase.js"></script>
        <script>

            MsgElem = document.getElementById("msg");
            TokenElem = document.getElementById("token");
            NotisElem = document.getElementById("notis");
            ErrElem = document.getElementById("err");

            var config = {
                apiKey: "AIzaSyBBCIU0GGrYeXGqVVc3o9tRcHwttL9zQKE",
                authDomain: "ron-test-8259b.firebaseapp.com",
                databaseURL: "https://ron-test-8259b.firebaseio.com",
                projectId: "ron-test-8259b",
                storageBucket: "ron-test-8259b.appspot.com",
                messagingSenderId: "780107221889",
                appId: "1:780107221889:web:006dd8ec664dcd65"
            };

            firebase.initializeApp(config);
            const messaging = firebase.messaging();
            
            messaging
                .requestPermission()
                .then(function () {
                    MsgElem.innerHTML = "Notification permission granted." 
                    console.log("Notification permission granted.");
                    
                    // get the token in the form of promise
                    return messaging.getToken()
                })
                .then(function(token) {
                    TokenElem.innerHTML = "token is : " + token
                })
                .catch(function (err) {
                    ErrElem.innerHTML =  ErrElem.innerHTML + "; " + err
                    console.log("Unable to get permission to notify.", err);
                });
           
            messaging.onMessage(function(payload) {
                console.log("Message received. ", payload);
                NotisElem.innerHTML = NotisElem.innerHTML + JSON.stringify(payload) 
            });

        </script>

    </body>
</html>
