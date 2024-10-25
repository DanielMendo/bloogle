<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @stack('styles')
    <style>
        .dropdown-toggle::after {
            display: none !important;
        }
    </style>
    <title>{{ config('app.name') }} - @yield('title')</title>
    <link rel="icon" href="{{ asset('img/favicon.png') }}" type="image/png">
    @vite(['resources/js/app.js', 'resources/css/app.css'])
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    @livewireStyles('styles')
</head>

<body>
    <header class="p-md-4 p-3" style="background-color: #F2F2F2">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex gap-3 justify-content-center align-items-center">
                    <a class="dropdown-toggle d-sm-none d-flex text-black fs-5" href="#" role="button"
                        id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-list"></i>
                    </a>
                    <ul class="list-unstyled mb-0 mt-2 dropdown-menu dropdown-menu-end p-2">
                        <li><a class="dropdown-item pb-2" href="{{ route('home') }}">Inicio</a></li>
                        <li><a class="dropdown-item py-2" href="{{ route('posts.index') }}">Recientes</a></li>
                        <li><a class="dropdown-item pt-2" href="{{ route('post.create') }}">Crear</a></li>
                    </ul>
                    <a href="{{ route('home') }}" class="text-decoration-none text-black ">
                        <h1 class="text-4 m-0" id="logo">B l o o g o l</h1>
                    </a>
                </div>
                @if (auth()->check())
                    <div class="d-flex align-items-center gap-4 d-sm-none position-relative">
                        <a href="{{ route('notifications') }}" class="position-relative">
                            <i class="bi bi-bell text-black"></i>
                            @if (!Auth::user()->unreadNotifications->count() == 0)
                                <span
                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    {{ Auth::user()->unreadNotifications->reject(function ($notification) {
                                            return (isset($notification->data['liker_slug']) && $notification->data['liker_slug'] === Auth::user()->slug) ||
                                                (isset($notification->data['follower_slug']) &&
                                                    $notification->data['follower_slug'] === Auth::user()->slug) ||
                                                (isset($notification->data['commenter_slug']) &&
                                                    $notification->data['commenter_slug'] === Auth::user()->slug);
                                        })->count() }}
                                    <span class="visually-hidden">notificaciones no leídas</span>
                                </span>
                            @endif
                        </a>
                        <a class="dropdown-toggle text-black" href="#" role="button" id="userDropdown"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            @if (Auth::user()->profile_picture == null)
                                <img src="{{ asset('img/avatar.png') }}"
                                    alt="{{ Auth::user()->name }}" class="rounded-circle position-relative"
                                    width="35" height="35">

                            @else
                                <img src="{{ Storage::disk('s3')->url('uploads/' . Auth::user()->profile_picture) }}"
                                    alt="{{ Auth::user()->name }}" class="rounded-circle position-relative"
                                    width="35" height="35">
                            @endif
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end mt-2 p-2" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item pb-2" href="{{ route('notifications') }}">Notificaciones</a>
                            </li>
                            <li><a class="dropdown-item py-2" href="{{ route('settings.view') }}">Configuración</a>
                            </li>
                            <li><a class="dropdown-item py-2"
                                    href="{{ route('subscription.index') }}">Suscripciones</a>
                            </li>
                            <li><a class="dropdown-item py-2"
                                    href="{{ route('profile.show', auth()->user()->slug) }}">Perfil</a></li>
                            <li><a class="dropdown-item pt-2" href="{{ route('logout') }}">Cerrar Sesión</a></li>
                        </ul>
                    </div>
                    <!-- Menú de navegación para dispositivos grandes -->
                    <nav class="d-none d-sm-flex gap-4 align-items-center">
                        <a href="{{ route('home') }}" class="text-secondary text-decoration-none link-hover">Inicio</a>
                        <a href="{{ route('posts.index') }}"
                            class="text-secondary text-decoration-none link-hover">Recientes</a>
                        <a href="{{ route('profile.show', auth()->user()->slug) }}"
                            class="text-secondary text-decoration-none link-hover">Sobre mí</a>
                        <a href="{{ route('post.create') }}"
                            class="text-secondary text-decoration-none link-hover">Crear</a>
                    </nav>
                @endif

                <div class="d-none d-sm-flex align-items-center gap-4">
                    @if (auth()->check())
                        <a href="{{ route('notifications') }}" class="position-relative">
                            <i class="bi bi-bell text-black"></i>
                            <span
                                class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                {{ Auth::user()->unreadNotifications->reject(function ($notification) {
                                        return (isset($notification->data['liker_slug']) && $notification->data['liker_slug'] === Auth::user()->slug) ||
                                            (isset($notification->data['follower_slug']) &&
                                                $notification->data['follower_slug'] === Auth::user()->slug) ||
                                            (isset($notification->data['commenter_slug']) &&
                                                $notification->data['commenter_slug'] === Auth::user()->slug);
                                    })->count() }}
                                <span class="visually-hidden">notificaciones no leídas</span>
                            </span>
                        </a>
                        <div class="dropdown">
                            <a class="dropdown-toggle text-decoration-none text-black" href="javascript:void(0)"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu mt-2 w-100">
                                <li><a class="dropdown-item" href="{{ route('settings.view') }}"><i
                                            class="bi bi-gear"></i>
                                        Configuración</a></li>
                                <li><a class="dropdown-item" href="{{ route('subscription.index') }}"><i
                                            class="bi bi-card-checklist"></i> Suscripciones</a></li>
                                <li><a class="dropdown-item"
                                        href="{{ route('profile.show', auth()->user()->slug) }}"><i
                                            class="bi bi-person-circle"></i> Perfil</a></li>
                                @if (
                                    !Auth::user()->verified and
                                        !Auth::user()->subscriptions->contains(function ($subscription) {
                                            return $subscription->stripe_status == 'active';
                                        }))
                                    <li><a class="dropdown-item" href="{{ route('product.show') }}"><i
                                                class="bi bi-patch-check-fill"></i> Verificar</a></li>
                                @endif
                                <li><a class="dropdown-item" href="{{ route('logout') }}"><i
                                            class="bi bi-box-arrow-right"></i> Cerrar Sesión</a></li>
                            </ul>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="text-secondary text-decoration-none link-hover">Inicia
                            Sesión</a>
                        <a href=" {{ route('register') }} "
                            class="text-secondary text-decoration-none link-hover">Registrate</a>
                    @endif
                </div>
            </div>
        </div>
    </header>

    @yield('content')

    <footer class="p-md-5 p-4" style="background-color: #F2F2F2">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-3">
                    <h4 class="text-5">Bloogol</h4>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-decoration-none text-secondary link-hover">¿Quiénes
                                somos?</a>
                        </li>
                        <li><a href="#" class="text-decoration-none text-secondary link-hover">¿Por qué
                                Bloogol?</a></li>
                        <li><a href="#" class="text-decoration-none text-secondary link-hover">Deja tu
                                opinion</a>
                        </li>
                    </ul>
                </div>
                <div class="col-12 col-md-3">
                    <h4 class="text-5">Descubre</h4>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-decoration-none text-secondary link-hover">Confianza y
                                seguridad</a></li>
                        <li><a href="#" class="text-decoration-none text-secondary link-hover">Protección de tus
                                datos</a></li>
                        <li><a href="#" class="text-decoration-none text-secondary link-hover">Trabaja con
                                nosotros</a></li>
                    </ul>
                </div>
                <div class="col-12 col-md-3">
                    <h4 class="text-5">Ayuda</h4>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-decoration-none text-secondary link-hover">Problemas con tu
                                cuenta</a></li>
                        <li><a href="#" class="text-decoration-none text-secondary link-hover">Problemas con la
                                comunidad</a></li>
                        <li><a href="#" class="text-decoration-none text-secondary link-hover">Contáctanos</a>
                        </li>
                    </ul>
                </div>
                <div class="col-12 col-md-3">
                    <h4 class="text-5">¡Síguenos!</h4>
                    <div>
                        <a href="#" class="text-decoration-none text-secondary link-hover"><i
                                class="bi bi-instagram fs-4 me-2"></i></a>
                        <a href="#" class="text-decoration-none text-secondary link-hover"><i
                                class="bi bi-facebook fs-4 me-2"></i></a>
                        <a href="#" class="text-decoration-none text-secondary link-hover"><i
                                class="bi bi-twitter fs-4 me-2"></i></a>
                        <a href="#" class="text-decoration-none text-secondary link-hover"><i
                                class="bi bi-pinterest fs-4 me-2"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    @stack('scripts')
    @livewireScripts('scripts')
</body>

</html>
