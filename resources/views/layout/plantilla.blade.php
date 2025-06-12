<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Aplicación de recurso humano para el registro de empleados">
    <meta name="keywords" content="empleados, registro, aplicación">
    <meta name="author" content="Antony Fernando">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>@yield('title')</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
              <a class="navbar-brand" href="/">
                <img src="{{ asset('image/logo.png')}}"
                    class="d-inline-block logo" alt="logo">
                 <p class="d-inline-block font-weight-bold">SOFTWARE</p>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto ">
                    <li class="nav-item active">
                        <a class="nav-link" href="/">Home </span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('empleado.index')}}">Empleados </a>
                    </li>
                </ul>

            </div>
        </nav>
        <hr>
    </header>
    <main>
        @yield('content')
    </main>
    <footer class="text-center mt-4">
        <hr>
    <p>Desarrollado por <a href="https://github.com/af11090">Antony Fernando</a></p>
        <p>&copy; {{ date('Y') }} RH Software</p>
    </footer>
    <script src="{{ asset('js/app.js') }}"></script>

    @stack('scripts')

</body>

</html>
