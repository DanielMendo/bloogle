@extends('layouts.app')

@section('content')
    <div class="container-sm mt-5">
        <h2 class="fs-4 mb-4 text-center">Configuración de cuenta</h2>

        <div class="row justify-content-center">

            <!-- Cambiar Correo -->
            <div class="col-md-8 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="fs-5 mb-3 mt-3">Cambiar Correo</h4>
                        
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
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary mt-3 mb-2">Cambiar correo</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Cambiar Contraseña -->
            <div class="col-md-8 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="fs-5 mb-3 mt-3">Cambiar Contraseña</h4>
                        
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
                                <input type="password" name="new_password" id="new_password" class="form-control @error('new_password') is-invalid @enderror" required style="height: 50px">
                                
                                <!-- Mostrar error de nueva contraseña -->
                                @error('new_password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="new_password_confirmation" class="form-label">Confirmar nueva contraseña</label>
                                <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control" required style="height: 50px">
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary mt-3 mb-2">Cambiar contraseña</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Eliminar Cuenta -->
            <div class="col-md-8 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="fs-5 mb-3 mt-3 text-danger">Eliminar Cuenta</h4>
                        
                        <p class="text-muted">Una vez que elimines tu cuenta, no podrás recuperarla.</p>
                        <form action="{{ route('settings.deleteAccount', ['user' => Auth::user()->id]) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar tu cuenta? Esta acción no se puede deshacer.');">
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
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-danger mt-3 mb-2">Eliminar Cuenta</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
