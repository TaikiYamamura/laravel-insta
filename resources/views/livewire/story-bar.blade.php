<div class="d-flex overflow-auto py-3">
    @foreach ($stories as $userStories)
        @php $story = $userStories->first(); @endphp
        <div class="text-center mx-2">
            <img src="{{ $story->user->avatar ?? asset('default.png') }}"
                 class="rounded-circle story-avatar"
                 wire:click="$dispatch('open-story', {{ $story->user_id }})">
            <small>{{ $story->user->name }}</small>
        </div>
    @endforeach
</div>

