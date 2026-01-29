<div>
    <h4 class="mb-4">Search Results for "<span class="fw-bold">{{ $query }}</span>"</h4>

    <ul class="nav nav-tabs mb-3 text-link-primary">
        <li class="nav-item">
            <a class="nav-link active" data-bs-toggle="tab" href="#posts">
                Posts ({{ count($posts ?? []) }})
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#users">
                Users ({{ count($users ?? []) }})
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#categories">
                Categories ({{ count($categories ?? []) }})
            </a>
        </li>
    </ul>

    <div class="tab-content">
        {{-- POSTS--}}
        <div id="posts" class="tab-pane fade show active">
            <div class="row g-2">
                @forelse($posts as $post)
                    <div class="col-4 col-sm-3 col-md-2">
                        <a href="{{ route('post.show', $post->id) }}">
                            <img src="{{ $post->image }}" alt="Post {{ $post->id }}" class="explore-post-img rounded">
                        </a>
                    </div>
                @empty
                    <p>No posts found</p>
                @endforelse
            </div>
        </div>

        {{-- USERS--}}
        <div id="users" class="tab-pane fade">
            <div class="row g-3">
                @forelse($users as $user)
                    <div class="col-12 d-flex justify-content-center">
                        <div class="card p-3 box_color shadow-sm w-50" style="max-width: 600px;">
                            <div class="d-flex align-items-center">
                                <a href="{{ route('profile.show', $user->id) }}">
                                    @if ($user->avatar)
                                        <img src="{{ $user->avatar }}" class="avatar-md me-3 rounded-circle">
                                    @else
                                        <i class="fa-solid fa-circle-user icon-md me-3"></i>
                                    @endif
                                </a>
                                <div class="flex-grow-1 me-3">
                                    <a href="{{ route('profile.show', $user->id) }}" class="fw-bold text-decoration-none">{{ $user->name }}</a>
                                    <p class="mb-0 xsmall text-muted">{{ $user->email }}</p>
                                </div>
                                <div class="ms-auto">
                                    @auth
                                        @if ($user->id !== Auth::id())
                                            <livewire:profile.follow-button :user="$user" :key="$user->id" />
                                        @endif
                                    @endauth
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <p>No users found</p>
                @endforelse
            </div>
        </div>

        {{-- CATEGORIES--}}
        <div id="categories" class="tab-pane fade">
            <div class="d-flex flex-wrap gap-2">
                @forelse($categories as $category)
                    <a href="{{ route('categories.show', ['category' => $category->id]) }}">
                        <span class="badge custom-badge custom-badge-lg">{{ $category->name }}</span>
                    </a>
                @empty
                    <p>No categories found</p>
                @endforelse
            </div>
        </div>

    </div>
</div>
