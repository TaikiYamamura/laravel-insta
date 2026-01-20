<div class="d-flex align-items-center">
    <button wire:click="toggleLike" class="btn btn-sm shadow-none p-0">
        @if($liked)
            <i class="fa-solid fa-heart text-danger"></i>
        @else
            <i class="fa-regular fa-heart"></i>
        @endif
    </button>
    <span class="ms-2">{{ $post->likes->count() }}</span>
</div>

   
