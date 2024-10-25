<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }} - Regístrate</title>
    <link rel="icon" href="{{ asset('img/favicon.png') }}" type="image/png">
    @vite(['resources/js/app.js', 'resources/css/app.css'])
    <style>
        body {
            background-color: #f7f7f7; /* Fondo claro para toda la página */
        }
    </style>
</head>
<body>
    <div class="container-fluid parrafo" style="height: 100vh;">
        <div class="h-100 d-flex flex-column justify-content-center align-items-center p-4">
            <div class="p-5 bg-white shadow rounded" style="width: 100%; max-width: 450px;">
                <h2 class="text-center text-secondary text-4 mb-4">Crea una nueva cuenta</h2>
                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre completo</label>
                        <input type="text" name="name" id="name" class="form-control" style="border: none; border-bottom: 2px solid #000000; border-radius: 0;" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo</label>
                        <input type="email" name="email" id="email" class="form-control" style="border: none; border-bottom: 2px solid #000000; border-radius: 0;" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" style="border: none; border-bottom: 2px solid #000000; border-radius: 0;" required>
                        <i class="bi bi-eye-slash" id="togglePassword" style="cursor: pointer;"></i>
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary mt-4 w-100 d-sm-inline d-none" style="border-radius: 0;">Regístrate</button>
                    <button type="submit" class="btn btn-primary btn-sm mt-4 w-100 d-inline d-sm-none" style="border-radius: 0;">Regístrate</button>

                    <p class="text-end text-5 mt-4 fw-bold">
                        <a href="{{ route('login') }}" class="text-decoration-none">Iniciar Sesión</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
    <script>
        const togglePassword = document.getElementById('togglePassword');
        const password = document.getElementById('password');

        togglePassword.addEventListener('click', (e) => {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            e.target.classList.toggle('bi-eye');
        });
    </script>
</body>
</html>
