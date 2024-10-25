@extends('layouts.app')

@section('title')
    Categorías
@endsection

@section('content')
<section>
    <div class="container sec-indexpost">
        <div class="row">
            <!-- Título y descripción de la categoría -->
            <div class="mb-5 col-lg-10 col-md-12 mx-auto mt-5">
                <h1 class="mb-5 text-1 fw-normal">{{ $category->name }}</h1>
                <p class="mb-5 text-5">{{ $category->description }}</p>
            </div>

            <!-- Posts relacionados a la categoría -->
            <div class="col-lg-8 col-md-10 col-12 mx-auto">
                <div class="row">
                    @if ($category->posts->isEmpty())
                        <p class="mb-5 text-center">No hay publicaciones</p>
                    @else
                        @foreach ($posts as $post)
                            <!-- Columna para cada post, usando clases responsivas -->
                            <div class="col-lg-6 col-md-6 col-sm-12 mb-5">
                                <a href="{{ route('post.show', ['user' => $post->user->slug, 'post' => $post->slug]) }}" class="text-decoration-none text-black">
                                    <div class="card">
                                        <!-- Imagen del post -->
                                        <img src="{{ Storage::disk('s3')->url('uploads/' . $post->image) }}" class="card-img-top" alt="Descripción de la imagen" style="height: 250px; object-fit: cover;">
                                        <!-- Contenido de la tarjeta del post -->
                                        <div class="card-body" style="height: 230px">
                                            <p><span class="fw-bold">Autor: </span>{{ Str::limit($post->user->name, 60) }}</p>
                                            <h5 class="card-title" style="font-size: 1.1rem">{{ Str::limit($post->title, 60) }}</h5>
                                            <p class="card-text">{!! Str::limit($post->content, 200) !!}</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
