@extends('layouts.app')

@section('content')

<div class="container m-5 mx-auto">
    <div class="m-5">
        <div class="row">
            <div class="col-8 d-flex flex-column justify-content-center align-items-start">
                <div class="mx-auto" style="max-width: 75%">
                    <div style="width: 100%; word-wrap: break-word;">
                        <h2 class="mb-5 fs-2"> {{ $user->name }} </h2>
                        <p class="fs-5">
                            @if ($user->bio == null)
                                No hay información aún
                            @else
                                {!! $user->bio !!}
                            @endif
                        </p>
                    </div>
                    <div class="d-flex gap-4 justify-content-center mt-5">
                        <a href="{{ $user->facebook }}" target="_blank"><i class="bi bi-facebook fs-3 text-primary"></i></a>
                        <a href="{{ $user->twitter }}" target="_blank"><i class="bi bi-twitter-x fs-3 text-black"></i></a>
                        <a href="{{ $user->instagram }}" target="_blank"><i class="bi bi-instagram fs-3 text-danger"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-4">
                @if ($user->profile_picture == null)
                        <p class="text-center">No hay imagen de perfil</p>
                    @else
                    <img src="{{ Storage::disk('s3')->url('uploads/' . $user->profile_picture) }}" alt="" style="height: 400px">
                @endif
            </div>
        </div>

        @if (auth()->id() === $user->id)
        <div class="d-flex justify-content-center mt-5">
            <a href="{{ route('profile.edit', $user->id) }}" class="btn btn-primary">Editar</a>
        </div>
        @endif
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-10 mx-auto">
            <h3 class="fs-4 mb-5 mt-5">Últimas publicaciones</h3>
            @if ($user->posts->isEmpty())
                <p class="mb-5 text-center">No hay publicaciones</p>
                @else
                <div class="row">
                    @foreach ($posts as $post)
                    <div class="col-4 mb-5">
                        <a href="{{ route('post.show', ['user' => $post->user->id, 'post' => $post->id]) }}" class="text-decoration-none text-black">
                            <div class="card">
                                <img src="{{ Storage::disk('s3')->url('uploads/' . $post->image) }}" class="card-img-top" alt="Descripción de la imagen" style="height: 250px">
                                <div class="card-body" style="height: 230px">
                                    <p><span class="fw-bold">Autor: </span> {{ Str::limit($post->user->name, 60) }} </p>
                                    <h5 class="card-title" style="font-size: 1.1rem"> {{ Str::limit($post->title, 40) }} </h5>
                                    <p class="card-text">{!! Str::limit($post->content, 150) !!}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>

@endsection
