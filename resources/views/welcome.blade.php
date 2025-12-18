<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Liga Extraordinaria</title>
        <!-- Icono del sitio -->
        <link rel="icon" href="{{ asset('/img/assets/liga-x.png') }}" type="image/x-icon"/>

        <!-- Scripts -->
            <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <style>
            /* Agrega estilos CSS personalizados aquí */
            body {
                background-color: #f8f9fa; /* Cambia el color de fondo del cuerpo según tus preferencias */
            }

            .overlay{
                background-color: black;
                width: 100%;
                height: 100%;
            }

            .jumbotron {
                background: url('{{ asset('img/assets/dashboard_banner.jpg') }}') no-repeat center center;
                background-size: cover;
                color: white; /* Cambia el color del texto según tus necesidades */
                text-align: center;
                height: 24em;
            }

            .jumbotron > .overlay {
                background-color: rgba(0,0,0,0.5);
            }
        </style>
    </head>
    <body class="bg-dark-blue">
        
        <!-- Barra de navegación -->
        <nav class="navbar navbar-expand-lg navbar-dark blue-500 bg-gradient">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <img src="/img/assets/liga-x.png" alt="" width="30" height="30">
                    Liga Extraordinaria
                </a>
                <!--button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                    <li class="nav-item">
                            <a class="nav-link" href="/jugar">Jugar</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/reglamento">Reglamento</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="/login">Ingresar</a>
                        </li>
                    </ul>
                </div-->
            </div>
        </nav>

        <!-- Banner -->
        <div class="container-fluid mt-4">
            <div class="jumbotron">
                <div class="overlay pt-5">
                    <h1 class="display-4 pt-5">Bienvenido al mundo del fútbol</h1>
                    <p class="lead fs-6">
                        A tí que te encanta el fútbol y te consideras un gran conocedor, Tenemos una invitación especial para tí. <br/> 
                        Únete a nuestra liga extraordinaria y demuestra tus habilidades en el campo de juego virtual.  <br/>
                        ¡Es tu oportunidad de demostrar tu conocimiento y pasión por el fútbol!
                    </p>
                </div>
            </div>
        </div>

        <div class="container-fluid mt-4">
            <div class="row mt-4">
                <div class="col-12 col-md-4">
                    <figure class="figure d-none d-md-block">
                        <a href="/jugar">
                            <img src="/img/assets/banner_play.jpg"
                                 class="figure-img img-fluid"
                                 alt="...">
                        </a>
                        <figcaption class="figure-caption">
                            <div class="d-grid gap-2">
                                <a class="btn btn-success ml-2" href="/jugar" role="button">Jugar Ahora</a>
                            </div>
                        </figcaption>
                    </figure>
                    <figure class="figure d-block d-md-none">
                        <figcaption class="figure-caption">
                            <div class="d-grid gap-2">
                                <a class="btn btn-success ml-2" href="/jugar" role="button">Jugar Ahora</a>
                            </div>
                        </figcaption>
                    </figure>
                </div>
                <div class="col-12 col-md-4">
                    <figure class="figure d-none d-md-block">
                        @guest
                            <a href="/login">
                                <img src="/img/assets/banner_login.jpg"
                                    class="figure-img img-fluid"
                                    alt="...">
                            </a>
                        @endguest
                        @auth
                            <a href="/jugar">
                                <img src="/img/assets/banner_login.jpg"
                                    class="figure-img img-fluid"
                                    alt="...">
                            </a>
                        @endauth
                        <figcaption class="figure-caption">
                            @guest
                                <div class="d-grid gap-2">
                                    <a class="btn btn-warning ml-2" href="/login" role="button">Iniciar Sesión</a>
                                </div>
                            @endguest
                        </figcaption>
                    </figure>
                    <figure class="figure d-block d-md-none">
                        <figcaption class="figure-caption">
                            @guest
                                <div class="d-grid gap-2">
                                    <a class="btn btn-warning ml-2" href="/login" role="button">Iniciar Sesión</a>
                                </div>
                            @endguest
                        </figcaption>
                    </figure>
                </div>
                <div class="col-12 col-md-4">
                    <figure class="figure d-none d-md-block">
                        <a href="/reglamento">
                            <img src="/img/assets/banner_rules.jpg"
                                 class="figure-img img-fluid"
                                 alt="...">
                        </a>
                        <figcaption class="figure-caption">
                            <div class="d-grid gap-2">
                                <a class="btn btn-warning ml-2" href="/reglamento" role="button">Mecánica de Juego</a>
                            </div>
                        </figcaption>
                    </figure>
                    <figure class="figure d-block d-md-none">
                        <figcaption class="figure-caption">
                            <div class="d-grid gap-2">
                                <a class="btn btn-warning ml-2" href="/reglamento" role="button">Mecánica de Juego</a>
                            </div>
                        </figcaption>
                    </figure>
                </div>
            </div>
        </div>
    </body>
</html>
