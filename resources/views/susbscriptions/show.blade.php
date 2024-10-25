@extends('layouts.app')

@section('title')
Suscripciones
@endsection

@section('content')
<div class="container mt-5 mb-5 parrafo">
    <div class="col-12 col-md-9 mx-auto">
        @if ($subscription->type == 'premium')
        <div class="d-flex gap-2 justify-content-center align-items-center mb-4">
            <i class="bi bi-patch-check-fill text-primary fs-4"></i>
            <p class="fw-bold text-5 m-0"> Insignia de verificación</p>
        </div>
    @endif

    <div class="mt-5">
        <p class="fw-bold">Información</p>
        <p>La insignia de verificación es un símbolo de confianza que muestra a tus lectores que tu cuenta ha sido verificada. Al obtener esta insignia, tus palabras tendrán más peso y credibilidad en la comunidad. Mejora tu reputación y establece relaciones de confianza con tus seguidores.</p>
    </div>

    <hr>

    <div class="row mb-4">
        <div class="col-12 col-md-6">
            <span class="fw-bold">Fecha de inicio: </span>{{ \Carbon\Carbon::createFromTimestamp($subscription->asStripeSubscription()->created)->format('d M, Y') }}
        </div>
        <div class="col-12 col-md-6">
            @if ($subscription->ends_at)
                <span class="fw-bold">Fecha de fin: </span>{{ \Carbon\Carbon::parse($subscription->ends_at)->format('d M, Y') }}
            @endif
        </div>
    </div>
    
    <div class="mb-4">
        <p class="fw-bold">Próxima facturación</p>
        <div class="d-flex justify-content-between flex-wrap">
            @if ($subscription->ends_at)
                <span>Termina en: {{ \Carbon\Carbon::parse($subscription->ends_at)->format('d M, Y') }} </span>
            @else
                <span>Comienza en: {{ \Carbon\Carbon::createFromTimestamp($subscription->asStripeSubscription()->current_period_end)->format('d M, Y') }} </span>
            @endif
            <span>$19.99 MXN</span>
        </div>
    </div>

    <hr>

    <div style="margin-bottom: 5rem">
        <p class="fw-bold">Historial de Cobros</p>
    
        @php
            $invoices = $subscription->user->invoices()->filter(function ($invoice) use ($subscription) {
                return $invoice->subscription === $subscription->stripe_id;
            });
        @endphp
    
        @if ($invoices && count($invoices) > 0)
            <ul class="list-group">
                @foreach ($invoices as $invoice)
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                        <span class="mb-2 mb-md-0">Fecha: {{ \Carbon\Carbon::createFromTimestamp($invoice->date()->getTimestamp())->format('d M, Y') }}</span>
                        <a href="{{ $invoice->hosted_invoice_url }}" target="_blank" class="btn btn-sm btn-primary">Ver factura</a>
                    </li>
                @endforeach
            </ul>
        @else
            <p>No se han encontrado cobros para esta suscripción.</p>
        @endif
    </div>
    
    <hr>

    <div class="d-flex justify-content-end">
        @if (!$subscription->ends_at)
            <form action="{{ route('subscription.cancel', $subscription->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Cancelar suscripción</button>
            </form>
        @endif
    </div>
    </div>
</div>
@endsection
