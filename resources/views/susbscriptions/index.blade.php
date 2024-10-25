@extends('layouts.app')

@section('title')
    Suscripciones
@endsection

@section('content')
    <div class="container mt-5 mb-5 sec-indexpost">
        <h1 class="text-center text-3 mb-4">Suscripciones</h1>
        <p class="text-center">Revisa el estado de tus suscripciones actuales, edítalas y cancélalas en cualquier momento.</p>
        
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        
        <div class="row gap-2 mt-5">
            <div class="col-12 col-md-8 mx-auto">
                @forelse (Auth::user()->subscriptions as $sub)
                @if ($sub->stripe_status == 'active')
                    <div class="col-12 col-md-7">
                        <div class="card h-100">
                            <a href="{{ route('subscription.show', ['subscriptionId' => $sub->id]) }}"
                                class="text-decoration-none text-black">
                                <div class="card-body">
                                    @if ($sub->type == 'premium')
                                        <div class="d-flex gap-2 align-items-center mb-4">
                                            <i class="bi bi-patch-check-fill text-primary fs-4"></i>
                                            <p class="fw-bold text-5 m-0">Insignia de verificación</p>
                                        </div>
                                    @endif
                                    @if ($sub->stripe_status == 'active' && $sub->ends_at == null)
                                        <p><i class="bi bi-circle-fill text-success"></i> Activo</p>
                                    @elseif ($sub->ends_at)
                                        <p><i class="bi bi-circle-fill text-danger"></i> Cancelado con acceso hasta:
                                            {{ \Carbon\Carbon::parse($sub->ends_at)->format('d M, Y') }} </p>
                                    @endif
                                    <p>Insignia de verificación azul junto al perfil así como contenido creado marcado como destacado.</p>
                                </div>
                            </a>
                        </div>
                    </div>
                @endif
            @empty
                <h2 class="text-center fs-4">No hay suscripciones en este momento</h2>
            @endforelse
            </div>
        </div>
    </div>
@endsection
