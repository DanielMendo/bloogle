@extends('layouts.app')

@section('title')
    Inicio
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
@endpush


@section('content')
<section class="d-flex align-items-center text-center" id="hero">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <p class="text-uppercase text-white fs-5 mb-0">Hola gente bienvenidos a</p>
                <h2 class="text-uppercase text-white mt-0 mb-4" style="font-size: 5.2rem">B l o o g o l </h2>
                <p class="text-uppercase text-white fs-4">Explora, comparte y descubre temas interesantes</p>
            </div>
        </div>
    </div>
</section>

<section style="margin: 8rem;">
    <div class="col-8 mx-auto">
        <h3 class="fs-5 fw-normal text-center mb-5">Explora las publicaciones por las siguientes categorías:</h3>
        <div class="swiper">
            <div class="swiper-wrapper">
                @foreach ($categories as $category)
                    <div class="swiper-slide" style="display: flex; justify-content: center;">
                        <div class="card mb-4" style="width: 300px;">
                            <div class="card-body">
                                <a href=" {{ route('category.show', $category->name) }} " class="text-decoration-none text-black">
                                    <h5 class="text-center mb-0 pb-5 pt-5"> {{$category->name}} </h5>
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


<section class="m-5">
    <div class="col-9 mx-auto">
        <div class="row">
            <h3 class="fs-5 fw-bold text-center">Últimas publicaciones</h3>
            <div class="col-12">
                @forelse ($posts->reverse()->take(5) as $post)
                    <div class="card m-5">
                        <div class="card-body p-0">
                            <a href="{{ route('post.show', ['user' => $post->user->slug, 'post' => $post->slug]) }}" class="text-decoration-none text-black">
                                <img src="{{ Storage::disk('s3')->url('uploads/' . $post->image) }}" alt="Descripción de la imagen" class="w-100">
                                <div style="padding: 3rem!important;">
                                    <div class="d-flex align-items-center gap-3">
                                        <p class="mt-3"><span class="fw-bold">Autor: </span> {{$post->user->name}} </p>
                                        <span class="text-muted" style="font-size: 0.9rem;">{{ $post->created_at->diffForHumans() }}</span>
                                    </div>
                                    <h4 class="mb-3"> {{$post->title}} </h4>
                                    <p> {!! Str::limit($post->content, 300) !!} </p>
                                </div>
                            </a>
                        </div>
                    </div>
                    @empty
                        <p class="text-center mt-5">Vacio! Comienza a seguir a tus editores favoritos para ver sus publicaciones</p>
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
            slidesPerView: 3,

            // Navigation arrows
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    </script>
@endpush