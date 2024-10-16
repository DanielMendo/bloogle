@extends('layouts.app')

@section('title')
    Publicaciones
@endsection

@section('content')

<div class="container-sm">
    <div class="row m-3">
        <div class="col-lg-8 col-md-10 col-sm-12 mx-auto mb-5">
            <div class="header d-flex justify-content-between align-items-center mb-5" style="margin-top: 5rem;">
                <a href="{{ route('profile.show', $post->user->slug) }}" class="d-flex gap-3 text-decoration-none align-items-center text-black name-link">
                    <img src="{{ Storage::disk('s3')->url('uploads/' . $post->user->profile_picture) }}" alt="" class="rounded-circle" style="height: 40px; width: 40px; object-fit: cover;">
                    <p class="m-0">{{ $post->user->name }}</p>
                    <span class="text-muted" style="font-size: 0.9rem;">
                        {{ $post->created_at->diffForHumans() }}
                    </span>
                </a>
                @if (auth()->check() && auth()->user()->id == $post->user->id)
                    <div class="d-flex gap-2 flex-wrap">
                        <a href="{{ route('post.edit', $post->slug) }}" class="btn btn-primary btn-sm">Editar</a>
                        <form action="{{ route('post.destroy', $post->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </div>
                @endif
            </div>
            <div style="width: 100%; word-wrap: break-word;">
                <h2 class="mb-4">{{ $post->title }}</h2>
                <p class="mb-4">{!! $post->content !!}</p>
            </div>
            <img src="{{ Storage::disk('s3')->url('uploads/' . $post->image) }}" class="mt-4 w-100 img-fluid" alt="">
            <hr class="mt-4">
            <div class="d-flex align-items-center {{auth()->check() ? "justify-content-between" : "justify-content-end"}}">
                
                <div class="d-flex align-items-center gap-3">
                    @auth
                        @if($post->checkLike(Auth::user()))
                            <form action=" {{route('like.destroy', $post->id)}} " method="POST">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="like-btn"><i class="bi bi-heart-fill fs-4 text-danger" id="like"></i></button>
                            </form>
                        @else
                            <form action=" {{route('like.store', $post->id)}} " method="POST">
                                @csrf
                                <button type="submit" class="like-btn"><i class="bi bi-heart fs-4" id="like"></i></button>
                            </form>
                        @endif
                            <p class="fs-5 mb-0"> {{$post->likes->count()}} Me gusta</p>
                    @endauth
                </div>
                
                <div class="d-flex align-items-center gap-3">
                    <div class="share-content">
                        <button class="share-btn"><i class="bi bi-share fs-4" id="share"></i></button>
                        <div class="share-options mt-2">
                            <p>Copia el enlace de la publicación</p>
                            <div class="input-group">
                                <input type="text" class="form-control" id="input-cp" value="{{ url()->current() }}" readonly>
                                <button class="btn btn-primary" id="btn-copy">
                                    <i class="bi bi-copy"></i>
                                </button>
                            </div>
                            <p class="text-center mb-0 mt-3 fw-bold" id="msg-copy" style="display: none;">¡Enlace copiado!</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <h3 class="fw-normal fs-5">Comentarios</h3>
                <hr>
                @if (auth()->check())
                    <form id="commentForm" method="POST" action="{{ route('comment.store', ['post' => $post->id]) }}">
                        @csrf
                        <div class="mb-3">
                            <textarea class="form-control" id="commentContent" name="content" rows="3" placeholder="Escribe tu comentario aquí..." required></textarea>
                        </div>
                        <div class="d-flex justify-content-end gap-2">
                            <button type="button" id="cancelButton" class="btn btn-secondary btn-sm">Cancelar</button>
                            <button type="submit" id="submitButton" class="btn btn-primary btn-sm">Comentar</button>
                        </div>
                    </form>
                @endif

                <div class="mt-4">
                    @foreach ($post->comments->whereNull('parent_id')->reverse() as $comment)
                        <div class="d-flex align-items-start mb-3">
                            @if ($comment->user->profile_picture == null)
                                <img src="{{ asset('img/avatar.png') }}" class="rounded-circle me-3" style="height: 50px; width: 50px; object-fit: cover;">
                            @else
                                <img src="{{ Storage::disk('s3')->url('uploads/' . $comment->user->profile_picture) }}" alt="" class="rounded-circle me-3" style="height: 50px; width: 50px; object-fit: cover;">
                            @endif
                            
                            <div class="border p-3 bg-light shadow-sm rounded w-100">
                                <div class="d-flex gap-3 align-items-center">
                                    <a href="{{ route('profile.show', $comment->user->slug) }}" class="text-decoration-none text-black"><strong class="d-block mb-1">{{ $comment->user->name }}</strong></a>
                                    <span class="text-muted" style="font-size: 0.9rem;">
                                        {{ $comment->created_at->diffForHumans() }}
                                    </span>
                                </div>
                                <p class="mb-0" style="font-size: 0.9rem; line-height: 1.5;">{{ $comment->content }}</p>
                                @if (Auth::check() && Auth::id() === $comment->user_id)
                                    <div class="d-flex justify-content-end">
                                        <form action="{{ route('comment.destroy', $comment->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn text-danger btn-sm">Eliminar</button>
                                        </form>
                                    </div>
                                @endif

                                @if (auth()->check())
                                <p class="text-primary reply-btn mt-2" style="cursor: pointer">Responder</p>
                                    <form method="POST" class="reply-form d-none" action="{{ route('comment.store', ['post' => $post->id]) }}">
                                        @csrf
                                        <div class="mb-3">
                                            <textarea class="form-control" name="content" rows="3" placeholder="Escribe tu comentario aquí..." required></textarea>
                                            <input type="hidden" value="{{ $comment->id }}" name="parent_id">
                                        </div>
                                        <div class="d-flex justify-content-end gap-2 mb-3">
                                            <button type="button" class="btn btn-secondary btn-sm cancel-btn">Cancelar</button>
                                            <button type="submit" class="btn btn-primary btn-sm">Comentar</button>
                                        </div>
                                    </form>
                                @endif
                                
                                @foreach ($post->comments->where('parent_id', $comment->id) as $response)
                                    <div class="d-flex align-items-start mb-3"> 
                                        <img src="{{ Storage::disk('s3')->url('uploads/' . $response->user->profile_picture) }}" alt="" class="rounded-circle me-3" style="height: 50px; width: 50px; object-fit: cover;">

                                        <div class="border p-3 bg-light shadow-sm rounded w-100">

                                            <div class="d-flex gap-3 align-items-center">
                                                <a href="{{ route('profile.show', $response->user->slug) }}" class="text-decoration-none text-black"><strong class="d-block mb-1">{{ $response->user->name }}</strong></a>
                                                <span class="text-muted" style="font-size: 0.9rem;">
                                                    {{ $response->created_at->diffForHumans() }}
                                                </span>
                                            </div>
                                            <p class="mb-0" style="font-size: 0.9rem; line-height: 1.5;">{{ $response->content }}</p>
                                            @if (Auth::check() && Auth::id() === $response->user_id)
                                                <div class="d-flex justify-content-end">
                                                    <form action="{{ route('comment.destroy', $response->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn text-danger btn-sm">Eliminar</button>
                                                    </form>
                                                </div>
                                            @endif

                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    @endforeach
                </div>
                
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
</script>

@endsection
