@extends('layouts.app')

@section('title')
    Publicaciones recientes
@endsection

@section( 'content' )

<section class="m-5">
    <div class="col-9 mx-auto">
        <div class="row">
            <h3 class="fs-5 fw-bold text-center">Últimos Posts</h3>
            <div class="col-12">
                @foreach ($posts->reverse() as $post)
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
                @endforeach
            </div>
        </div>
    </div>
</section>


@endsection