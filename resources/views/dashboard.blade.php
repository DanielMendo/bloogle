@extends('layouts.app')

@section('title')
    Inicio
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
@endpush


@section('content')
    <section class="d-flex align-items-center text-center" id="hero">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <p class="text-uppercase text-white text-5 mb-0">Hola gente bienvenidos a</p>
                    <h2 class="text-uppercase text-white mt-0 mb-4 text-logo">B l o o g o l </h2>
                    <p class="text-uppercase text-white text-4">Explora, comparte y descubre temas interesantes</p>
                </div>
            </div>
        </div>
    </section>

    <section class="my-5">
        <div class="col-12 col-md-8 mx-auto">
            <h3 class="text-5 fw-normal text-center mb-5">Explora las publicaciones por las siguientes categorías:</h3>
            <div class="swiper">
                <div class="swiper-wrapper">
                    @foreach ($categories as $category)
                        <div class="swiper-slide d-flex justify-content-center">
                            <div class="card mb-4" style="width: 250px;">
                                <div class="card-body">
                                    <a href=" {{ route('category.show', $category->name) }} "
                                        class="text-decoration-none text-black">
                                        <h5 class="text-5 text-center mb-0 pb-5 pt-5"> {{ $category->name }} </h5>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
        </div>
    </section>


    <section class="my-5">
        <div class="col-12 col-md-7 mx-auto sec-dashboard">
            <div class="row">
                <h3 class="fs-5 fw-bold text-center mb-5">Últimas publicaciones</h3>
                <div class="col-12">
                    @forelse ($posts->reverse() as $post)
                        <div class="card mb-5">
                            <div class="card-body p-0">
                                <a href="{{ route('post.show', ['user' => $post->user->slug, 'post' => $post->slug]) }}"
                                    class="text-decoration-none text-black">
                                    <img src="{{ asset('uploads/' . $post->image) }}"
                                        alt="Descripción de la imagen" class="w-100">
                                    <div class="p-4">
                                        <div class="d-flex align-items-center gap-3">
                                            @if ($post->user->profile_picture == null)
                                                <img src="{{ asset('img/avatar.png') }}" class="rounded-circle normal-avatar"
                                                    style="object-fit: cover;">
                                            @else
                                                <img src="{{ asset('uploads/' . $post->user->profile_picture) }}"
                                                    class="rounded-circle normal-avatar"
                                                    style="object-fit: cover;">
                                            @endif
                                            <p class="mt-3">{{ $post->user->name }}</p>
                                        </div>
                                        <h4 class="mb-3">{{ $post->title }}</h4>
                                        <div class="d-none d-sm-inline-block">
                                            <p>{!! Str::limit($post->content, 300) !!}</p>
                                        </div>
                                        <div class="d-sm-none d-blok">
                                            <p>{!! Str::limit($post->content, 80) !!}</p>
                                        </div>
                                        <div class="mt-4">
                                            <div class="d-flex gap-4 align-items-center">
                                                @if (
                                                    $post->user->verified ||
                                                        $post->user->subscriptions->contains(fn($subscription) => $subscription->stripe_status == 'active'))
                                                    <i class="bi bi-star-fill text-warning"></i>
                                                @endif
                                                <span class="text-muted"
                                                    style="font-size: 0.9rem;">{{ $post->created_at->diffForHumans() }}</span>
                                                <div>
                                                    <i class="bi bi-heart-fill text-secondary"></i>
                                                    <span class="text-muted"
                                                        style="font-size: 0.9rem;">{{ $post->likes->count() }}</span>
                                                </div>
                                                <div>
                                                    <i class="bi bi-chat-right-text-fill text-secondary"></i>
                                                    <span class="text-muted"
                                                        style="font-size: 0.9rem;">{{ $post->comments->count() }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @empty
                        <p class="text-center mt-3">¡Vacío! Sigue a usuarios para ver sus publicaciones más recientes.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        const swiper = new Swiper('.swiper', {
            // Optional parameters
            loop: true,
            spaceBetween: 30,
            slidesPerView: 1,
            breakpoints: {
                1024: {
                    slidesPerView: 3
                }
            },

            // Navigation arrows
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    </script>
@endpush
