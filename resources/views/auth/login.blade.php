<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blogool</title>
    <link rel="icon" href="{{ asset('img/favicon.png') }}" type="image/png">
    @vite(['resources/js/app.js', 'resources/css/app.css'])
</head>
<body>
    <div class="container-fluid" style="height: 100vh;">
        <div class="row h-100">
            <div class="col-md-6 p-5 pt-1" style="font-family: 'Times New Roman';">
                <div class="p-5">
                    <h2 class="mt-5 mb-5" style="font-size: 55px;">Bienvenido a Blogool</h2>
                    <p style="font-size: 36px;">
                        Comparte tus pensamientos, descubre nuevas ideas y conecta con personas afines. Crea tu cuenta o inicia sesión para acceder a nuestras categorías y empezar a escribir tus propios posts. ¡Elige lo que más te apasiona y deja volar tu creatividad!
                    </p>
                </div>
            </div>
            <div class="col-md-6 d-flex flex-column justify-content-center align-items-center p-4" style="background-color: #f7f7f7;">
                <div class="p-5 bg-white" style="width: 65%">
                    <h2 class="text-center text-secondary fs-5 mb-5">Empezemos</h2>
                    @if (session('message'))
                        <p class="text-danger text-center fw-bold mb-5 "> {{ session('message') }}</p>
                    @endif
                    <form action="{{route('login')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo</label>
                            <input type="email" name="email" id="email" class="form-control" style="border: none; border-bottom: 2px solid #000000; border-radius: 0;" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" name="password" id="password" class="form-control" style="border: none; border-bottom: 2px solid #000000; border-radius: 0;" required>
                        </div>
                        <button type="submit" class="btn btn-primary mt-5 w-100" style="border-radius: 0">Iniciar Sesión</button>

                        <p class="text-end mt-5 fw-bold" style="font-size: 1.1rem">
                            <a href=" {{route('register')}} " class="text-decoration-none">Registrate</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>