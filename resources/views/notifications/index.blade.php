@extends('layouts.app')

@push('styles')
    <style>
        .main-container {
            min-height: calc(100vh - 15rem);
        }
    </style>
@endpush

@section('content')
    <div class="container my-5 main-container">
        <h2 class="mb-4 text-center fs-4">Notificaciones</h2>

        <!-- Panel de notificaciones -->
        <div class="card">
            <div class="card-header p-4">
                Últimas Notificaciones
            </div>
            <ul class="list-group list-group-flush">
                @forelse ($notifications as $notification)
                    @if ($notification->type === 'App\Notifications\NewFollower')
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div class="p-3">
                                <i class="bi bi-person-plus-fill text-success"></i>
                                <strong> <a class="text-decoration-none text-black" href="{{route('profile.show', $notification->data['follower_slug'])}}">{{$notification->data['follower_name']}}</a> </strong> te ha comenzado a seguir.
                            </div>
                            <span class="badge bg-primary rounded-pill"> {{$notification->created_at->diffForHumans()}} </span>
                        </li>  
                    @elseif ($notification->type === 'App\Notifications\PostLiked')
                        @if ($notification->data['liker_slug'] !== Auth::user()->slug)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div class="p-3">
                                    <i class="bi bi-hand-thumbs-up-fill text-warning"></i>
                                    A <strong><a class="text-decoration-none text-black" href="{{ route('profile.show', $notification->data['liker_slug']) }}">{{ $notification->data['liker_name'] }}</a></strong> le ha gustado tu post <strong><a class="text-decoration-none text-black" href="{{ route('post.show', ['user' => Auth::user()->slug, 'post' => $notification->data['post_slug']]) }}">{{ $notification->data['post_title'] }}</a></strong>
                                </div>
                                <span class="badge bg-primary rounded-pill">{{$notification->created_at->diffForHumans()}}</span>
                            </li>
                        @endif
                    @elseif ($notification->type === 'App\Notifications\NewComment')
                        @if ($notification->data['commenter_slug'] !== Auth::user()->slug)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div class="p-3">
                                    <i class="bi bi-chat-dots-fill text-info"></i>
                                    <strong><a href="{{route('profile.show', $notification->data['commenter_slug'])}}" class="text-decoration-none text-black"> {{$notification->data['commenter_name']}} </a></strong> comentó en tu post <strong><a href="{{ route('post.show', ['user' => Auth::user()->slug, 'post' => $notification->data['post_slug']]) }}" class="text-decoration-none text-black"   > {{$notification->data['post_title']}} </a></strong>.
                                </div>
                                <span class="badge bg-primary rounded-pill"> {{$notification->created_at->diffForHumans()}} </span>
                            </li>
                        @endif   
                    @endif
                @empty
                    <p class="m-5 p-5 text-center">No hay notificaciones nuevas</p>
                @endforelse     
            </ul>
        </div>
    </div>
@endsection
