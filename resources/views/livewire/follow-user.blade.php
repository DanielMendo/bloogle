<div>
    @if ($user->following(Auth::user()))
        <button class="btn btn-danger btn-sm" wire:click="destroy">Unfollow</button>
    @else
        <button class="btn btn-primary btn-sm" wire:click="store">Follow</button>
    @endif
</div>
