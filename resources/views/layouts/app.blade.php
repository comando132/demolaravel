<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{{ isset($titulo_pagina) ? $titulo_pagina : config('app.name', 'LaraAPI') }}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Lara API, demo con laravel">
    @include('layouts/css')
</head>
<body cz-shortcut-listen="true">
        <!-- Begin page content -->
        <header>
            <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                        <li class="nav-item active">
                            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Link</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled" href="#">Disabled</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <main role="main" class="container">
            @if (session('success'))
                <div class="alert alert-success">
                    {!! session('success') !!}
                </div>
            @endif
            @if (session('failure'))
                <div class="alert alert-danger">
                    {!! session('failure') !!}
                </div>
            @endif
            @if (session('status'))
                <div class="alert alert-info">
                    {!! session('status') !!}
                </div>
            @endif
            @yield('content')
        </main>
        <footer class="footer">
            <div class="container">
              <span class="text-muted">&copy; Hecho en México. Esta página puede ser reproducida con fines no lucrativos, siempre y cuando se cite la fuente completa y su dirección electrónica.</span>
            </div>
          </footer>
    @include('layouts/scripts')
</body>
</html>
