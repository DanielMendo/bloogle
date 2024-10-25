@extends('layouts.app')

@section('title')
    {{ $user->name }}
@endsection

@section('content')

    <div class="container m-5 mx-auto sec-indexpost">
        <div class="m-5">
            <div class="row">
                <div class="col-lg-8 col-md-12 d-flex flex-column justify-content-center align-items-start">
                    <div class="mx-auto">
                        <div style="width: 100%; word-wrap: break-word;">
                            @if (session('success'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <div class="d-flex gap-3 justify-content-between align-items-center mb-3">

                                <div>
                                    <div class="d-sm-none d-block">
                                        @if ($user->profile_picture == null)
                                            <img src="{{ asset('img/avatar.png') }}" class="img-fluid">
                                        @else
                                            <img src="{{ asset('uploads/' . $user->profile_picture) }}"
                                                alt="" class="img-fluid ">
                                        @endif
                                    </div>
                                    
                                    <div class="d-flex d-sm-none w-100 flex-nowrap parrafo justify-content-between mt-4">
                                        <p>Publicaciones: <strong>{{ $user->posts->count() ? $user->posts->count() : 0 }}</strong></p>
                                        <p>Seguidos: <strong> {{ $user->followings->count() }} </strong></p>
                                        <livewire:followers-counter :user="$user" />
                                    </div>
                                </div>
                                <h2 class="text-3 d-sm-flex d-none"> {{ $user->name }}
                                    @if (
                                        $user->verified or
                                            $user->subscriptions->contains(function ($subscription) {
                                                return $subscription->stripe_status == 'active';
                                            }))
                                        <span class="d-inline-block" data-toggle="popover"
                                            data-content="Usuario verificado por Bloogol" data-placement="top"
                                            data-trigger="hover">
                                            <i class="bi bi-patch-check-fill text-primary"></i>
                                        </span>
                                    @endif
                                </h2>
                                
                                <div class="d-sm-flex d-none">
                                    @auth
                                        @if ($user->id !== auth()->user()->id)
                                            <livewire:follow-user :user="$user" />
                                        @endif
                                    @endauth
                                </div>
                            </div>
                            <div class="mb-5 d-sm-flex d-none justify-content-between w-100 gap-4 flex-wrap">
                                <p>Publicaciones: <strong>{{ $user->posts->count() ? $user->posts->count() : 0 }}</strong>
                                </p>
                                <p>Seguidos: <strong> {{ $user->followings->count() }} </strong></p>
                                <livewire:followers-counter :user="$user" />
                            </div>
                            <p class="fs-5">
                                
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h2 class="text-3 d-flex d-sm-none m-0"> {{ $user->name }}
                                    @if (
                                        $user->verified or
                                            $user->subscriptions->contains(function ($subscription) {
                                                return $subscription->stripe_status == 'active';
                                            }))
                                        <span class="d-inline-block" data-toggle="popover"
                                            data-content="Usuario verificado por Bloogol" data-placement="top"
                                            data-trigger="hover">
                                            <i class="bi bi-patch-check-fill text-primary"></i>
                                        </span>
                                    @endif
                                    
                                </h2>
                                <div class="d-inline-block d-sm-none">
                                    @auth
                                        @if ($user->id !== auth()->user()->id)
                                            <livewire:follow-user :user="$user" />
                                        @endif
                                    @endauth
                                </div>
                            </div>
                            
                            @if ($user->bio == null)
                                No hay información aún
                            @else
                                {!! $user->bio !!}
                            @endif
                            </p>
                        </div>
                        <div class="d-flex gap-4 justify-content-center mt-5">
                            <a href="{{ $user->facebook }}" class="{{ $user->facebook ? 'unset' : 'd-none' }}"
                                target="_blank"><i class="bi bi-facebook fs-3 text-primary"></i></a>
                            <a href="{{ $user->twitter }}" class="{{ $user->twitter ? 'unset' : 'd-none' }}"
                                target="_blank"><i class="bi bi-twitter-x fs-3 text-black"></i></a>
                            <a href="{{ $user->instagram }}" class="{{ $user->instagram ? 'unset' : 'd-none' }}"
                                target="_blank"><i class="bi bi-instagram fs-3 text-danger"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 d-none d-sm-flex">
                    @if ($user->profile_picture == null)
                        <img src="{{ asset('img/avatar.png') }}" class="img-fluid">
                    @else
                        <img src="{{ asset('uploads/' . $user->profile_picture) }}" alt=""
                            class="img-fluid ">
                    @endif
                </div>
            </div>

            @if (auth()->id() === $user->id)
                <div class="d-flex justify-content-center mt-5">
                    <a href="{{ route('profile.edit', $user->slug) }}" class="btn btn-primary">Editar</a>
                </div>
            @endif

        </div>
    </div>

    <div class="sec-indexpost">
        <div class="col-12 col-md-8 mx-auto">
            <h3 class="text-4 mb-5 mt-5">Últimas publicaciones</h3>
        @if ($user->posts->isEmpty())
            <p class="mb-5 text-center">No hay publicaciones</p>
        @else
            <div class="row">
                @foreach ($posts->reverse() as $post)
                    <div class="col-lg-6 col-md-12 mb-5">
                        <a href="{{ route('post.show', ['user' => $post->user->slug, 'post' => $post->slug]) }}"
                            class="text-decoration-none text-black">
                            <div class="card">
                                <img src="{{ asset('uploads/' . $post->image) }}" class="card-img-top"
                                    alt="Descripción de la imagen" style="height: 200px">
                                <div class="p-2">
                                    <div class="card-body" style="height: 140px;">
                                        <div class="d-flex align-items-center gap-3 mb-3">
                                            @if ($post->user->profile_picture == null)
                                                <img src="{{ asset('img/avatar.png') }}" class="rounded-circle"
                                                    style="height: 25px; width: 25px; object-fit: cover;">
                                            @else
                                                <img src="{{ asset('uploads/' . $post->user->profile_picture) }}"
                                                    alt="" class="rounded-circle"
                                                    style="height: 25px; width: 25px; object-fit: cover;">
                                            @endif
                                            <p style="font-size: 0.8rem" class="m-0">
                                                {{ Str::limit($post->user->name, 50) }} </p>
                                        </div>
                                        <h5 class="card-title" style="font-size: 1.2rem">
                                            {{ Str::limit($post->title, 40) }}</h5>
                                        <div style="font-size: 0.9rem">
                                            <p>{!! Str::limit(Purifier::clean($post->content), 80) !!}</p>
                                        </div>
                                    </div>
                                    <div class="card-footer mt-4 bg-white" style="border: none">
                                        <div class="d-flex gap-4 align-items-center">
                                            @if (
                                                $post->user->verified or
                                                    $post->user->subscriptions->contains(function ($subscription) {
                                                        return $subscription->stripe_status == 'active';
                                                    }))
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
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @endif
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-toggle="popover"]'))
            var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
                return new bootstrap.Popover(popoverTriggerEl)
            })
        });
    </script>
@endpush
