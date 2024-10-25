@extends('layouts.app')

@section('title')
    Publicaciones
@endsection

@section('content')
    <div class="container sec-indexpost">
        <div class="row m-3">
            <div class="col-lg-8 col-md-10 col-sm-12 mx-auto mb-5">
                <div class="d-flex justify-content-between align-items-center mb-5 mt-sm-5 mt-3">
                    <a href="{{ route('profile.show', $post->user->slug) }}"
                        class="d-flex gap-3 text-decoration-none align-items-center text-black name-link">
                        @if ($post->user->profile_picture == null)
                            <img src="{{ asset('img/avatar.png') }}" class="rounded-circle"
                                style="height: 40px; width: 40px; object-fit: cover;">
                        @else
                            <img src="{{ asset('uploads/' . $post->user->profile_picture) }}"
                                class="rounded-circle" style="height: 40px; width: 40px; object-fit: cover;">
                        @endif
                        <div class="d-flex flex-column">
                            <p class="m-0">{{ $post->user->name }}
                                @if ($user->verified || $user->subscriptions->contains(function ($subscription) {
                                    return $subscription->stripe_status == 'active';
                                }))
                                    <span class="d-inline-block" data-toggle="popover"
                                        data-content="Usuario verificado por Bloogol" data-placement="top" data-trigger="hover">
                                        <i class="bi bi-patch-check-fill text-primary"></i>
                                    </span>
                                @endif
                            </p>
                            <span class="text-muted" style="font-size: 0.9rem;">
                                {{ $post->created_at->diffForHumans() }}
                            </span>
                        </div>
                    </a>

                    {{-- Opciones de Editar y Eliminar --}}
                    @if (auth()->check() && auth()->user()->id == $post->user->id)
                        <div class="d-none d-sm-flex gap-2 flex-wrap">
                            <a href="{{ route('post.edit', $post->slug) }}" class="btn btn-primary btn-sm">Editar</a>
                            <form action="{{ route('post.destroy', $post->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </div>

                        {{-- Menú de tres puntos en dispositivos pequeños --}}
                        <div class="dropdown d-sm-none">
                            <button class="btn btn-secondary btn-sm" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-three-dots"></i>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <li><a class="dropdown-item" href="{{ route('post.edit', $post->slug) }}">Editar</a></li>
                                <li>
                                    <form action="{{ route('post.destroy', $post->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dropdown-item">Eliminar</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @endif
                </div>

                {{-- Contenido del post --}}
                <div style="width: 100%; word-wrap: break-word;">
                    <h2 class="mb-4">{{ $post->title }}</h2>
                    <p class="mb-4">{!! $post->content !!}</p>
                </div>
                <img src="{{ asset('uploads/' . $post->image) }}" class="mt-4 w-100 img-fluid"
                    alt="">
                <hr class="mt-4">

                {{-- Sección de likes y compartir --}}
                <div class="d-flex align-items-center {{ auth()->check() ? 'justify-content-between' : 'justify-content-end' }}">
                    <div class="d-flex align-items-center gap-3">
                        @auth
                            <livewire:like-post :post="$post" />
                        @endauth
                    </div>

                    <div class="d-flex align-items-center gap-3">
                        <div class="share-content">
                            <button class="share-btn"><i class="bi bi-share fs-4" id="share"></i></button>
                            <div class="share-options mt-2">
                                <p>Copia el enlace de la publicación</p>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="input-cp"
                                        value="{{ url()->current() }}" readonly>
                                    <button class="btn btn-primary" id="btn-copy">
                                        <i class="bi bi-copy"></i>
                                    </button>
                                </div>
                                <p class="text-center mb-0 mt-3 fw-bold" id="msg-copy" style="display: none;">¡Enlace
                                    copiado!</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Sección de comentarios --}}
                <div class="mt-4">
                    <h3 class="fw-normal text-5">Comentarios</h3>
                    <hr>
                    @if (auth()->check())
                        <livewire:comment-post :post="$post" />
                    @endif

                    <livewire:comment-list-post :post="$post" />
                </div>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.reply-btn').forEach((btn) => {
            btn.addEventListener('click', function() {
                const form = this.closest('.border').querySelector('.reply-form');
                form.classList.remove('d-none');
            });
        });

        document.querySelectorAll('.cancel-btn').forEach((btn) => {
            btn.addEventListener('click', function() {
                const form = this.closest('.reply-form');
                document.getElementById('reply-content').value = '';
                form.classList.add('d-none');
            });
        });

        document.getElementById("btn-copy").addEventListener("click", function() {
            let copyText = document.getElementById("input-cp");
            copyText.select();
            document.execCommand("copy");
            document.getElementById("msg-copy").style.display = "block";
            setTimeout(function() {
                document.getElementById("msg-copy").style.display = "none";
            }, 2000);
        });
        document.addEventListener('DOMContentLoaded', function() {
            var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-toggle="popover"]'))
            var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
                return new bootstrap.Popover(popoverTriggerEl)
            })
        });
    </script>
@endsection
