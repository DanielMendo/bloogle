@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row m-3">
        <div class="col-8 mx-auto mb-5">
            <div class="header d-flex justify-content-between align-items-center mb-5" style="margin-top: 5rem;">
                <a href="{{ route('profile.show', $post->user->id) }}" class="d-flex gap-3 text-decoration-none align-items-center text-black name-link">
                    <i class="bi bi-person-circle fs-4"></i>
                    <p class="m-0">{{ $post->user->name }}</p>
                    <span class="text-muted" style="font-size: 0.9rem;">
                        {{ $post->created_at->diffForHumans() }}
                    </span>
                </a>
                @if (auth()->check() && auth()->user()->id == $post->user->id)
                    <div class="d-flex gap-3">
                        <a href="{{ route('post.edit', $post->id) }}" class="btn btn-primary btn-sm mt-2">Editar</a>
                        <form action="{{ route('post.destroy', $post->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm mt-2">Eliminar</button>
                        </form>
                    </div>
                @endif
            </div>
            <div style="width: 100%; word-wrap: break-word;">
                <h2 class="mb-5">{{ $post->title }}</h2>
                <p class="mb-5">{!! $post->content !!}</p>
            </div>
            <img src="{{ Storage::disk('s3')->url('uploads/' . $post->image) }}" class="mt-5 w-100" alt="">
            <hr class="mt-5">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center gap-3">
                    <i class="bi bi-heart fs-4" id="like"></i>
                    <p class="fs-5 mb-0">0</p>
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
            <div class="mt-5">
                <h3 class="fw-normal fs-5">Comentarios</h3>
                <hr>
                @if (auth()->check())
                    <form id="commentForm" method="POST" action="{{ route('comment.store', ['post' => $post->id]) }}">
                        @csrf
                        <div class="mb-3">
                            <textarea class="form-control" id="commentContent" name="content" rows="3" placeholder="Escribe tu comentario aquí..." required></textarea>
                        </div>
                        <div class="d-flex justify-content-end gap-3">
                            <button type="button" id="cancelButton" class="btn btn-secondary btn-sm mt-2">Cancelar</button>
                            <button type="submit" id="submitButton" class="btn btn-primary btn-sm mt-2">Comentar</button>
                        </div>
                    </form>
                @endif

                <div class="mt-4">
                    @foreach ($post->comments as $comment)
                        <div class="d-flex align-items-start mb-3">
                            <img src="{{ Storage::disk('s3')->url('uploads/' . $comment->user->profile_picture) }}" alt="" class="rounded-circle me-3" style="height: 50px; width: 50px; object-fit: cover;">
                            
                            <div class="border p-3 bg-light shadow-sm rounded w-100">
                                <div class="d-flex gap-3 align-items-center">
                                    <a href="{{ route('profile.show', $post->user->id) }}" class="text-decoration-none text-black"><strong class="d-block mb-1">{{ $comment->user->name }}</strong></a>
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
                                            <button type="submit" class="btn text-danger btn-sm mt-2">Eliminar</button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
                
            </div>
        </div>
    </div>
</div>

<script>
    const input_cp = document.getElementById('input-cp');
    const btn_cp = document.getElementById('btn-copy')
    const btn_cancel = document.getElementById('cancelButton')
    const btn_submit = document.getElementById('submitButton')
    const comment_content = document.getElementById('commentContent')
    
    btn_cp.addEventListener('click', function() {
    input_cp.select();
    document.execCommand('copy');

    const msg_copy = document.getElementById('msg-copy')
        msg_copy.style.display = 'block';
    })

    btn_cancel.addEventListener('click', function() {
        comment_content.value = '';
    })
</script>

@endsection
