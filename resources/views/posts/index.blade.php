@extends('layouts.app')

@section('title')
    Publicaciones recientes
@endsection

@section('content')

<section class="my-5 sec-indexpost">
    <div class="col-12 col-md-7 col-lg-7 mx-auto">
        <div class="row">
            <h3 class="text-5 fw-bold text-center mb-5">Últimos Posts</h3>
            <div class="col-12">
                @foreach ($posts->reverse() as $post)
                <div class="card mb-5">
                    <div class="card-body p-0">
                        <a href="{{ route('post.show', ['user' => $post->user->slug, 'post' => $post->slug]) }}" class="text-decoration-none text-black">
                            <img src="{{ asset('uploads/' . $post->image) }}" alt="Descripción de la imagen" class="w-100 img-fluid">
                            <div class="p-3 p-md-5"> <!-- Espaciado más ligero para pantallas pequeñas -->
                                <div class="d-flex align-items-center gap-3">
                                    @if ($post->user->profile_picture == null)
                                        <img src="{{ asset('img/avatar.png') }}" class="rounded-circle normal-avatar"
                                            style="object-fit: cover;">
                                    @else
                                        <img src="{{ asset('uploads/' . $post->user->profile_picture) }}" alt="" class="rounded-circle normal-avatar" style="object-fit: cover;">
                                    @endif
                                    <p class="mt-3"> {{$post->user->name}} </p>  
                                </div>
                                <h4 class="mb-3"> {{$post->title}} </h4>
                                <p> {!! Str::limit($post->content, 300) !!} </p>
                                <div class="mt-4">
                                    <div class="d-flex gap-4 align-items-center">
                                        @if ($post->user->verified or $post->user->subscriptions->contains(function ($subscription) {
                                            return $subscription->stripe_status == 'active';
                                        }))
                                            <i class="bi bi-star-fill text-warning"></i>
                                        @endif
                                        <span class="text-muted" style="font-size: 0.9rem;">{{ $post->created_at->diffForHumans() }}</span>
                                        <div>
                                            <i class="bi bi-heart-fill text-secondary"></i>
                                            <span class="text-muted" style="font-size: 0.9rem;"> {{$post->likes->count()}} </span>
                                        </div>
                                        <div>
                                            <i class="bi bi-chat-right-text-fill text-secondary"></i>
                                            <span class="text-muted" style="font-size: 0.9rem;"> {{$post->comments->count()}} </span>
                                        </div>
                                    </div>
                                </div>
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
