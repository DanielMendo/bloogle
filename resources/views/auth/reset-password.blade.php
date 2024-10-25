<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }} - Restablecer contraseña</title>
    <link rel="icon" href="{{ asset('img/favicon.png') }}" type="image/png">
    @vite(['resources/js/app.js', 'resources/css/app.css'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f7f7f7; /* Color de fondo de la página */
        }
    </style>
</head>
<body>
    <div class="container-fluid d-flex align-items-center justify-content-center" style="height: 100vh;">
        <div class="bg-white p-5 rounded shadow" style="width: 90%; max-width: 500px;">
            <h2 class="text-center text-secondary fs-4 mb-5">Restablecer Contraseña</h2>
            <!-- Reset Password Form -->
            <form action="{{ route('password.store') }}" method="POST">
                @csrf
                <input type="hidden" name="token" value="{{ $request->route('token') }}">
                
                <div class="mb-3">
                    <label for="email" class="form-label">Correo Electrónico</label>
                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" style="border: none; border-bottom: 2px solid #000000; border-radius: 0;" required autofocus>
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="mb-3 position-relative">
                    <label for="password" class="form-label">Nueva Contraseña</label>
                    <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" style="border: none; border-bottom: 2px solid #000000; border-radius: 0;" required>
                    <i class="bi bi-eye-slash position-absolute" id="togglePassword" style="top: 50%; right: 10px; transform: translateY(-50%); cursor: pointer;"></i>
                    @error('password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password-confirm" class="form-label">Confirmar Nueva Contraseña</label>
                    <input type="password" name="password_confirmation" id="password-confirm" class="form-control" style="border: none; border-bottom: 2px solid #000000; border-radius: 0;" required>
                </div>

                <button type="submit" class="btn btn-primary mt-5 w-100" style="border-radius: 0;">Restablecer Contraseña</button>
            </form>
        </div>
    </div>
    
    <script>
        const togglePassword = document.getElementById('togglePassword');
        const password = document.getElementById('password');

        togglePassword.addEventListener('click', (e) => {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            e.target.classList.toggle('bi-eye');
            e.target.classList.toggle('bi-eye-slash');
        });
    </script>
</body>
</html>
