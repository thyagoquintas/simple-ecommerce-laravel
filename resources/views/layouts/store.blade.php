<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js" defer></script>
    <script src="https://kit.fontawesome.com/8455a3d02b.js" crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    @yield('css')
    
    @yield('javascript')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarCategoria" role="button" data-toggle="dropdown">Categorias</a>
                            <div class="dropdown-menu" aria-labelledby="navbarCategoria">
                                @foreach(\App\Category::all() as $category)
                                <a class="dropdown-item" href="{{ route('serach-category', $category->id) }}">{{$category->name}}</a>
                                @endforeach
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarCategoria" role="button" data-toggle="dropdown">Tags</a>
                            <div class="dropdown-menu" aria-labelledby="navbarCategoria">
                                @foreach(\App\Tag::all() as $tag)
                                <a class="dropdown-item" href="{{ route('serach-tag', $tag->id) }}">{{$tag->name}}</a>
                                @endforeach
                            </div>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
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
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a href="{{ route('users.edit-profile') }}" class="dropdown-item">Meu Perfil</a>
                                    @if(Auth::user()->isAdmin())
                                        <a href="{{ route('home') }}" class="dropdown-item">Admin System</a>
                                    @endif       
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item">{{ __('Logout') }}</button>
                                    </form>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('cart')}}" class="nav-link">
                                    <i class="fas fa-shopping-cart"></i>
                                    {{ Auth::user()->cart->products()->count() }}
                                </a>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4 container">
            @if(session()->has('success'))
                <div class="alert alert-success">{{ session()->get('success') }}</div>
            @endif
            @if(session()->has('error'))
                <div class="alert alert-danger">{{ session()->get('error') }}</div>
            @endif
            @yield('content')
        </main>
        <footer class="container p-5 bg-primary text-white">
            <div class="row">
                <div class="col-sm-4 mb-5">
                    <h2 class="h4">Localização:</h2>
                    <address>Rua Lorem, ipsum dolor, 386<br>
                    Lorem, ipsum - Lorem, LR<br>
                    CEP: 00000-000<br>
                    Telefone: (11) 8888-8888
                    </address>
                </div>
                <div class="col-sm-4">
                    <h2 class="h4">Horario de Funcionamento para loja fisica</h2>
                    <ul class="list-unstyled">
                        <li>Segunda - Sexta: 9:00 - 20:00</li>
                        <li>Sábado - 9:00 - 16:00</li>
                    </ul>
                </div>
                <div class="col-sm-4">
                    <iframe class="mapa" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.openstreetmap.org/export/embed.html?bbox=-46.72169119119645%2C-23.51543653740416%2C-46.71986728906632%2C-23.51398298937327&amp;layer=mapnik"></iframe>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
