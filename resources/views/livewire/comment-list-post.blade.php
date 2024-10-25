<div>
    <div class="mt-4">
        @foreach ($comments as $comment)
            <div class="d-flex align-items-start mb-3">
                @if ($comment->user->profile_picture == null)
                    <img src="{{ asset('img/avatar.png') }}" class="rounded-circle me-3 normal-avatar"
                        style="object-fit: cover;">
                @else
                    <img src="{{ Storage::disk('s3')->url('uploads/' . $comment->user->profile_picture) }}" alt=""
                        class="rounded-circle me-3 normal-avatar" style="object-fit: cover;">
                @endif

                <div class="border p-3 bg-light shadow-sm rounded w-100">
                    <div class="mb-3">
                        <a href="{{ route('profile.show', $comment->user->slug) }}"
                            class="text-decoration-none text-black"><strong
                                class="d-block">{{ $comment->user->name }}</strong></a>
                        <span class="text-muted" style="font-size: 0.9rem;">
                            {{ $comment->created_at->diffForHumans() }}
                        </span>
                    </div>
                    <p class="mb-0" style="font-size: 0.9rem; line-height: 1.5;">
                        {{ $comment->content }}
                    </p>
                    @if (Auth::check() && Auth::id() === $comment->user_id)
                        <div class="d-flex justify-content-end">
                            <button wire:click="destroy({{ $comment->id }})"
                                class="btn text-danger btn-sm">Eliminar</button>
                        </div>
                    @endif

                    @if (auth()->check())
                        <p class="text-primary reply-btn mt-3" style="cursor: pointer; font-size:0.9rem">Responder</p>
                        <form class="reply-form d-none" wire:submit.prevent="store({{ $comment->id }})">
                            @csrf
                            <div class="mb-3">
                                <textarea class="form-control" name="content" wire:model="content" rows="3"
                                    placeholder="Escribe tu comentario aquí..." required id="reply-content"></textarea>
                            </div>
                            <div class="d-flex justify-content-end gap-2 mb-3">
                                <button type="button" class="btn btn-secondary btn-sm cancel-btn">Cancelar</button>
                                <button type="submit" class="btn btn-primary btn-sm">Comentar</button>
                            </div>
                        </form>
                    @endif

                    @foreach ($comment->replies as $response)
                        <div class="d-flex align-items-start mb-3">
                            <img src="{{ Storage::disk('s3')->url('uploads/' . $response->user->profile_picture) }}"
                                alt="" class="rounded-circle me-3"
                                style="height: 50px; width: 50px; object-fit: cover;">

                            <div class="border p-3 bg-light shadow-sm rounded w-100">

                                <div class="d-flex gap-3 align-items-center">
                                    <a href="{{ route('profile.show', $response->user->slug) }}"
                                        class="text-decoration-none text-black"><strong
                                            class="d-block mb-1">{{ $response->user->name }}</strong></a>
                                    <span class="text-muted" style="font-size: 0.9rem;">
                                        {{ $response->created_at->diffForHumans() }}
                                    </span>
                                </div>
                                <p class="mb-0" style="font-size: 0.9rem; line-height: 1.5;">
                                    {{ $response->content }}</p>
                                @if (Auth::check() && Auth::id() === $response->user_id)
                                    <div class="d-flex justify-content-end">
                                        <button wire:click="destroy({{ $response->id }})"
                                            class="btn text-danger btn-sm">Eliminar</button>
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
