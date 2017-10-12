<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Eat Nearby') }}</title>

    <!-- Styles -->
    {{--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.6.0/css/bulma.css"/>--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.5.3/css/bulma.min.css" integrity="sha256-spCEAaZMKebC3rE/ZTt8jITn65b0Zan45WXblWjyDyQ=" crossorigin="anonymous" />

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
        <div class="container" id="app">
            <nav class="nav has-shadow">
                <div class="container">
                    <div class="nav-left">
                        <a class="nav-item" href="{{url('/')}}">
                                {{ config('app.name', 'Eat Nearby') }}
                        </a>
                    </div>
                    <div class="nav-center">
                        <h1 class="nav-item">Find nearby places and eat what you want !</h1>
                    </div>

                    <span class="nav-toggle">
                      <span></span>
                      <span></span>
                      <span></span>
                    </span>
                    <div class="nav-right nav-menu">
                       {{-- <a class="nav-item is-tab is-active">
                            Paris
                        </a>
                        <a class="nav-item is-tab is-active">
                            New York
                        </a>
                        <a class="nav-item is-tab">
                            Help
                        </a>--}}
                        <span class="nav-item">
                            <div class="field is-grouped">
                                @guest
                                <p class="control">
                                  <a class="button " href="{{ route('login') }}">Login</a>
                                <a class="button" href="{{ route('register') }}">Register</a>
                              </p>
                                @else
                                    <div class="dropdown is-active">
                                      <div class="dropdown-trigger">
                                        <button class="button" aria-haspopup="true" aria-controls="dropdown-menu">
                                          <span>{{ Auth::user()->name }}</span> <span class="caret"></span>
                                          <span class="icon is-small">
                                            <i class="fa fa-angle-down" aria-hidden="true"></i>
                                          </span>
                                        </button>
                                      </div>
                                      <div class="dropdown-menu" id="dropdown-menu" role="menu">
                                        <div class="dropdown-content">
                                         <a href="{{ route('logout') }}" class="dropdown-item"
                                                 onclick="event.preventDefault();
                                                                 document.getElementById('logout-form').submit();">
                                                        Logout
                                                    </a>
                                             <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                        {{ csrf_field() }}
                                                    </form>
                                          <a class="dropdown-item">
                                            Other dropdown item
                                          </a>
                                          <a href="#" class="dropdown-item is-active">
                                            Active dropdown item
                                          </a>
                                          <a href="#" class="dropdown-item">
                                            Other dropdown item
                                          </a>
                                          <hr class="dropdown-divider">
                                          <a href="#" class="dropdown-item">
                                            With a divider
                                          </a>
                                        </div>
                                      </div>
                                    </div>
                                    @endguest
                                </div>
                            </span>
                    </div>
                </div>
            </nav>
    </div>


    <img src="{{asset('giphy-downsized.gif')}}" alt="loader" id="loader" >
    @yield('content')

  {{--  <div class="hero-foot">
        <div class="container">
            <div class="tabs is-centered">
                <ul>
                    <li><a>And this at the bottom</a></li>
                </ul>
            </div>
        </div>
    </div>--}}
{{--<script async type="text/javascript" src="../js/bulma.js"></script>--}}

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
