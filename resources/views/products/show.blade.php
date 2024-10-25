@extends('layouts.app')

@section('content')
    <div class="container container-sm sec-indexpost">
        <div class="row">
            <div class="col-12 col-md-10 col-lg-8 mx-auto">

                <div class="d-flex gap-2 justify-content-center align-items-center my-4">
                    <i class="bi bi-patch-check-fill text-primary fs-4"></i>
                    <h1 class="text-center text-4 fw-bold mb-0">Insignia de Verificación</h1>
                </div>

                <div class="mb-5">
                    <p class="mb-5">La insignia de verificación es un símbolo de confianza que muestra a tus lectores que
                        tu cuenta
                        ha sido verificada. Al obtener esta insignia, tus palabras tendrán más peso y credibilidad en la
                        comunidad.
                        Mejora tu reputación y establece relaciones de confianza con tus seguidores.</p>

                    <img src="{{ asset('img/verify.png') }}" class="img-fluid" alt="Insignia de verificación">
                </div>

                <div class="mt-5">
                    <h4 class="text-4">Planes y precios de Bloogol Verified</h4>
                    <p>Estamos ampliando todos los planes y beneficios a nivel mundial.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="container p-5">
            <div class="row">
                <div class="d-flex justify-content-center">
                    <div class="col-lg-4 col-md-6 col-sm-8 mb-4">
                        <div class="card card2 h-100">
                            <div class="card-body">
                                <h5 class="card-title">Estandar</h5>
                                <small class='text-muted'>Insignia de verificación</small>
                                <br><br>
                                <span class="h2">$19.99</span> MXN /Mes
                                <br><br>
                                <div class="d-grid my-3">
                                    <a href="{{ route('checkout', ['plan' => 'price_1QCvVHG1O9i56kZkmvoiuAgM']) }}"
                                        class="btn btn-outline-dark btn-block">Suscríbete</a>
                                </div>
                                <ul class="list-unstyled">
                                    <li class="parrafo">Obtén una insignia de verificación</li>
                                    <li class="parrafo">Genera credibilidad y confianza</li>
                                    <li class="parrafo">Contribuye con Bloogol</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
