<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @stack('styles')
    <title>@yield('title')</title>
    @vite(['resources/js/app.js', 'resources/css/app.css'])
</head>
<body>
    <header class="p-4" style="background-color: #F2F2F2">
        <div class="container d-flex justify-content-between aling-items-center">
            <h1 class="fw-bold fs-3">B l o g o o l</h1>

            <nav class="d-flex gap-4 align-items-center ">
                <a href="#" class="text-secondary text-decoration-none link-hover">Inicio</a>
                <a href="#" class="text-secondary text-decoration-none link-hover">Recientes</a>
                <a href="#" class="text-secondary text-decoration-none link-hover">Sobre mí</a>
                <a href=" {{route('post.create')}} " class="text-secondary text-decoration-none link-hover">Crear</a>
            </nav>

            <div class="d-flex align-items-center">
                <a href="{{route('logout')}}" class="btn btn-secondary">Cerrar Sesión</a>
            </div>
        </div>
    </header>   
    
    @yield('content')

    <footer class="p-5" style="background-color: #F2F2F2">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h4 class="fs-5">Blogool</h4>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-decoration-none text-secondary link-hover">¿Quiénes somos?</a></li>
                        <li><a href="#" class="text-decoration-none text-secondary link-hover">¿Por qué Blogool?</a></li>
                        <li><a href="#" class="text-decoration-none text-secondary link-hover">Deja tu opinion</a></li>
                    </ul>
                </div>
                <div class="col">
                    <h4 class="fs-5">Descubre</h4>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-decoration-none text-secondary link-hover">Confianza y seguridad</a></li>
                        <li><a href="#" class="text-decoration-none text-secondary link-hover">Protección de tus datos</a></li>
                        <li><a href="#" class="text-decoration-none text-secondary link-hover">Trabaja con nosotros</a></li>
                    </ul>
                </div>
                <div class="col">
                    <h4 class="fs-5">Ayuda</h4>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-decoration-none text-secondary link-hover">Problemas con tu cuenta</a></li>
                        <li><a href="#" class="text-decoration-none text-secondary link-hover">Problemas con la comunidad</a></li>
                        <li><a href="#" class="text-decoration-none text-secondary link-hover">Contactanos</a></li>
                    </ul>
                
                </div>
                <div class="col">
                    <h4 class="fs-5">¡Siguenos!</h4>
                    <div>
                        <a href="#" class="text-decoration-none text-secondary link-hover"><i class="bi bi-instagram fs-4 me-2"></i></a>
                        <a href="#" class="text-decoration-none text-secondary link-hover"><i class="bi bi-facebook fs-4 me-2"></i></a>
                        <a href="#" class="text-decoration-none text-secondary link-hover"><i class="bi bi-twitter fs-4 me-2"></i></a>
                        <a href="#" class="text-decoration-none text-secondary link-hover"><i class="bi bi-pinterest fs-4 me-2"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    
    @stack('scripts')
</html>