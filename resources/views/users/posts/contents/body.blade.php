{{-- clickable image --}}
<div class="container p-0">
    <a href="{{ route('post.show', $post->id) }}">
        <img src="{{ $post->image }}" alt="post id {{ $post->id }}" class="w-100">
    </a>
</div>
<div class="card-body">
    <div class="row align-items-center">
        <div class="col-auto">
        <livewire:like-button :post="$post" :key="$post->id" />
        {{-- @livewire('like-button', ['post' => $post], key($post->id)) --}}
    </div>

        <div class="col text-end">
            @if ($post->categoryPost->isEmpty())
                <div class="badge bg-dark">
                    Uncategorized
                </div>
            @else
                @foreach ($post->categoryPost as $category_post)
                    <div class="badge bg-secondary bg-opacity-50">
                        {{ $category_post->category->name }}
                    </div>
                @endforeach
            @endif
        </div>
    </div>

    <a href="{{ route('profile.show', $post->user->id) }}" class="text-decoration-none text-dark fw-bold">{{ $post->user->name }}</a>
    &nbsp;
    <p class="d-inline fw-light">{{ $post->description }}</p>

    <p class="text-uppercase text-muted xsmall">{{ $post->created_at->diffForHumans() }}</p>

    {{-- include comments here --}}
    {{-- @include('users.posts.contents.comments') --}}

    {{-- include comments here --}}
    <livewire:comment-section :post="$post" :key="$post->id" />


</div>