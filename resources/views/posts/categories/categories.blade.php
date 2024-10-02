@extends('layouts.app')

@section('content')
<section>
    <div class="container">
        <div class="row">
            <div class="mb-5 col-10 mx-auto" style="margin-top:5rem;">
                <h1 class="mb-5 fw-normal"> {{$category->name}} </h1>
                <p class="mb-5 fs-5"> {{$category->description}} </p>
            </div>
            <div class="col-8 mx-auto">
                <div class="row">
                    @if ($category->posts->isEmpty())
                        <p class="mb-5 text-center">No hay publicaciones</p>
                        @else
                            @foreach ($posts as $post)
                            <div class="col-6 mb-5">
                                <a href="{{ route('post.show', ['user' => $post->user->id, 'post' => $post->id]) }}" class="text-decoration-none text-black">
                                    <div class="card">
                                        <img src="{{ asset('uploads/' . $post->image) }}" class="card-img-top" alt="Descripción de la imagen" style="height: 250px">
                                        <div class="card-body" style="height: 230px">
                                            <p class=""><span class="fw-bold">Autor: </span> {{Str::limit($post->user->name, 60)}} </p>
                                            <h5 class="card-title" style="font-size: 1.1rem"> {{Str::limit($post->title, 60)}} </h5>
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