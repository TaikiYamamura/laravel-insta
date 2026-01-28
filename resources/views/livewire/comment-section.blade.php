<div class="mt-3">
    {{-- コメント一覧 --}}
    @if ($comments->isNotEmpty())
        <hr>
        <ul class="list-group">
            @foreach ($comments->take(3) as $comment)
                <li class="list-group-item border-0 p-0 mb-2">
                    <a href="{{ route('profile.show', $comment->user->id) }}" class="text-decoration-none fw-bold">{{ $comment->user->name }}</a>
                    &nbsp;
                    <p class="d-inline fw-light">{{ $comment->body }}</p>

                    {{-- <span class="text-uppercase text-muted xsmall">{{ $comment->created_at->format('M d, Y') }}</span> --}}
                    <span class="text-uppercase xsmall">{{ $comment->created_at->diffForHumans() }}</span>


                    @if (Auth::id() === $comment->user_id)
                        &middot;
                        <button type="button" wire:click="deleteComment({{ $comment->id }})" class="border-0 bg-transparent text-danger p-0 xsmall">Delete</button>
                    @endif
                </li>
            @endforeach

            @if ($comments->count() > 3)
                <li class="list-group-item border-0 px-0 pt-0">
                    <a href="{{ route('post.show', $post->id) }}" class="text-decoration-none small">View all {{ $comments->count() }} comments</a>
                </li>
            @endif
        </ul>
    @endif

    {{-- コメント入力 --}}
    <form wire:submit.prevent="addComment">
        <div class="input-group">
            <textarea wire:model.defer="newComment" rows="1" class="form-control form-control-sm" placeholder="Add a comment..."></textarea>
            <button type="submit" class="btn btn-sm">Post</button>
        </div>
        @error('newComment') 
            <div class="text-danger small">{{ $message }}</div>
        @enderror
    </form>
</div>
