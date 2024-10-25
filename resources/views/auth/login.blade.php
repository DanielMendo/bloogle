<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }} - Inicia Sesión</title>
    <link rel="icon" href="{{ asset('img/favicon.png') }}" type="image/png">
    @vite(['resources/js/app.js', 'resources/css/app.css'])
</head>

<body>
    <div class="container-fluid" style="height: 100vh;">
        <div class="row h-100 d-flex align-items-center">
            <div class="col-md-6 col-12 p-5 h-100 d-none d-sm-flex align-items-center">
                <div class="p-5">
                    <h2 class="mb-5" style="font-size: 50px;">Bloogol</h2>
                    <p style="font-size: 30px;">
                        Comparte tus pensamientos, descubre nuevas ideas y conecta con personas afines.
                    </p>
                </div>
            </div>
            <div class="col-md-6 p-5 col-12 h-100 d-none d-sm-flex align-items-center justify-content-center"
                style="background-color: #F7F7F7;">
                <div class="p-5 bg-white shadow p-3 bg-body rounded" style="width: 70%">
                    <h2 class="text-center text-secondary fs-5 mb-5">Empezemos</h2>
                    @if (session('message'))
                        <p class="text-danger text-center fw-bold mb-5 "> {{ session('message') }}</p>
                    @endif
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo</label>
                            <input type="email" name="email" id="email" class="form-control"
                                style="border: none; border-bottom: 2px solid #000000; border-radius: 0;" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" name="password" id="password" class="form-control"
                                style="border: none; border-bottom: 2px solid #000000; border-radius: 0;" required>
                            <i class="bi bi-eye-slash" id="togglePassword"></i>
                        </div>

                        <button type="submit" class="btn btn-primary mt-5 w-100" style="border-radius: 0">Iniciar
                            Sesión</button>
                    </form>
                    <div class="d-flex justify-content-between">
                        <p class="text-end mt-5 fw-bold" style="font-size: 0.9rem">
                            <a href="{{ route('password.request') }}" class="text-decoration-none">Olvidaste tu
                                contraseña?</a>
                        </p>
                        <p class="text-end mt-5 fw-bold" style="font-size: 1rem">
                            <a href=" {{ route('register') }} " class="text-decoration-none">Registrate</a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="d-sm-none d-flex justify-content-center parrafo">
                <div class="container-fluid" style="height: 100vh;">
                    <div class="row h-100 d-flex align-items-center">
                        <div class="col-md-6 col-12 d-flex align-items-center justify-content-center">
                            <div class="p-5 bg-white shadow p-3 rounded" style="width: 100%; max-width: 400px;">
                                <h2 class="text-center text-secondary text-5 mb-4">Bloogol</h2>
                                @if (session('message'))
                                    <p class="text-danger text-center fw-bold mb-4"> {{ session('message') }}</p>
                                @endif
                                <form action="{{ route('login') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Correo</label>
                                        <input type="email" name="email" id="email" class="form-control"
                                            style="border: none; border-bottom: 2px solid #000000; border-radius: 0;"
                                            required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Contraseña</label>
                                        <input type="password" name="password" id="password" class="form-control"
                                            style="border: none; border-bottom: 2px solid #000000; border-radius: 0;"
                                            required>
                                        <i class="bi bi-eye-slash" id="togglePassword" style="cursor: pointer;"></i>
                                    </div>

                                    <button type="submit" class="btn btn-primary parrafo mt-4 w-100"
                                        style="border-radius: 0;">Iniciar Sesión</button>
                                </form>
                                <div class="d-flex justify-content-between flex-nowrap w-100 mt-4">
                                    <p class="text-end fw-bold" style="font-size: 0.8rem">
                                        <a href="{{ route('password.request') }}" class="text-decoration-none">Olvidaste
                                            tu contraseña?</a>
                                    </p>
                                    <p class="text-end fw-bold" style="font-size: 0.8rem">
                                        <a href="{{ route('register') }}" class="text-decoration-none">Regístrate</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

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
        })
    </script>
</body>

</html>
