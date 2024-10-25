<div>
    <div class="d-flex gap-3 align-items-center">
        <button wire:click="like" class="like-btn"><i class="bi bi-heart-fill fs-4 {{$isLiked ? 'text-danger' : 'bi-heart'}}" id="like"></i></button>
        <p class="text-5 mb-0"> {{ $likes }} Me gusta</p>
    </div>
</div>
