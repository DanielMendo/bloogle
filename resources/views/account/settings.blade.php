@extends('layouts.app')

@section('title')
    Configuración
@endsection

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
@endpush

@section('content')
    <div class="container-sm mt-5 parrafo">
        <h2 class="text-4 mb-4 text-center">Configuración de cuenta</h2>

        <div class="row justify-content-center">

            <!-- Cambiar Correo -->
            <div class="col-md-8 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="text-5 mb-3 mt-3">Cambiar Correo</h4>
                        
                        <!-- Mensaje de éxito -->
                        @if(session('email_success'))
                            <div class="alert alert-success">
                                {{ session('email_success') }}
                            </div>
                        @endif
                        
                        <form action="{{ route('settings.emailUpdate', ['user' => Auth::user()->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="current_email" class="form-label text-secondary">Correo actual</label>
                                <input type="email" name="current_email" id="current_email" class="form-control" value="{{ Auth::user()->email }}" disabled style="height: 50px">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label text-secondary">Nuevo correo</label>
                                <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" required style="height: 50px">
                                
                                <!-- Mostrar error de email -->
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="d-sm-flex d-none justify-content-end">
                                <button type="submit" class="btn btn-primary mt-3 mb-2">Cambiar correo</button>
                            </div>
                            <div class="d-flex d-sm-none justify-content-end">
                                <button type="submit" class="btn btn-primary btn-sm mt-3 mb-2">Cambiar correo</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Cambiar Contraseña -->
            <div class="col-md-8 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="text-5 mb-3 mt-3">Cambiar Contraseña</h4>
                        
                        <!-- Mensaje de éxito -->
                        @if(session('password_success'))
                            <div class="alert alert-success">
                                {{ session('password_success') }}
                            </div>
                        @endif
                        
                        <form action="{{ route('settings.updatePassword', ['user' => Auth::user()->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="current_password" class="form-label">Contraseña actual</label>
                                <input type="password" name="current_password" id="current_password" class="form-control @error('current_password') is-invalid @enderror" required style="height: 50px">
                                
                                <!-- Mostrar error de contraseña actual -->
                                @error('current_password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="new_password" class="form-label">Nueva contraseña</label>
                                <input type="password" name="new_password" id="password" class="form-control @error('new_password') is-invalid @enderror" required style="height: 50px">
                                <i class="bi bi-eye-slash" id="togglePassword"></i>

                                
                                <!-- Mostrar error de nueva contraseña -->
                                @error('new_password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="new_password_confirmation" class="form-label">Confirmar nueva contraseña</label>
                                <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control" required style="height: 50px">
                            </div>
                            <div class="d-sm-flex d-none justify-content-end">
                                <button type="submit" class="btn btn-primary mt-3 mb-2">Cambiar contraseña</button>
                            </div>
                            <div class="d-flex d-sm-none justify-content-end">
                                <button type="submit" class="btn btn-primary btn-sm mt-3 mb-2">Cambiar contraseña</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Eliminar Cuenta -->
            <div class="col-md-8 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="text-5 mb-3 mt-3 text-danger">Eliminar Cuenta</h4>
                        
                        <p class="text-muted">Una vez que elimines tu cuenta, no podrás recuperarla.</p>
                        <!-- Botón para abrir el modal -->
                        <div class="d-sm-flex d-none justify-content-end mt-4">
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
                                Eliminar Cuenta
                            </button>
                        </div>
                        <div class="d-flex d-sm-none justify-content-end mt-4">
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
                                Eliminar Cuenta
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal de confirmación para eliminar cuenta -->
            <div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-labelledby="deleteAccountModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteAccountModalLabel">Confirmar eliminación de cuenta</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p class="text-muted">Por favor, ingresa tu contraseña para confirmar la eliminación de tu cuenta. Esta acción no se puede deshacer.</p>
                            <form action="{{ route('settings.deleteAccount', ['user' => Auth::user()->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label">Confirmar contraseña</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" required style="height: 50px">
                                    
                                    <!-- Mostrar error de confirmación de contraseña -->
                                    @error('password_confirmation')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-danger">Eliminar Cuenta</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');
        
        if (togglePassword && password) {
            togglePassword.addEventListener('click', function (e) {
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);
                e.target.classList.toggle('bi-eye');
            });
        }
    });
</script>
@endpush
