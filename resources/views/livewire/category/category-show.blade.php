<div>
    <h4 class="mb-4 fw-bold">{{ $category ? $category->name : 'Uncategorized' }}</h4>

    {{-- カテゴリ説明（ある場合のみ） --}}
    @if ($category && $category->description)
        <p>{{ $category->description }}</p>
    @endif

    <ul class="nav nav-tabs mb-3 text-link-primary">
        <li class="nav-item">
            <a href="#" wire:click.prevent="setTab('posts')"
                class="nav-link {{ $activeTab === 'posts' ? 'active' : '' }}">
                <i class="fa-solid fa-image small mt-1"></i> Posts
            </a>
        </li>
        <li class="nav-item">
            <a href="#" wire:click.prevent="setTab('popular')"
                class="nav-link {{ $activeTab === 'popular' ? 'active' : '' }}">
                <i class="fa-solid fa-chart-line small mt-1"></i> Popular
            </a>
        </li>
        <li class="nav-item">
            <a href="#" wire:click.prevent="setTab('users')"
                class="nav-link {{ $activeTab === 'users' ? 'active' : '' }}">
                <i class="fa-solid fa-users small mt-1"></i> Users
            </a>
        </li>
        <li class="nav-item">
            <a href="#" wire:click.prevent="setTab('categories')"
                class="nav-link {{ $activeTab === 'categories' ? 'active' : '' }}">
                <i class="fa-solid fa-tag small mt-1"></i> All Categories
            </a>
        </li>
    </ul>

    @if ($activeTab === 'posts')
        {{-- POSTS タブ --}}
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
    @elseif($activeTab === 'popular')
        {{-- POPULAR タブ --}}
        <div class="row g-2">
            @forelse($popularPosts as $post)
                <div class="col-4 col-sm-3 col-md-2">
                    <a href="{{ route('post.show', $post->id) }}">
                        <img src="{{ $post->image }}" alt="Post {{ $post->id }}"
                            class="explore-post-img rounded">
                    </a>
                    {{-- 人気指標表示 --}}
                    <div class="small mt-1">
                        <i class="fa-solid fa-heart text-danger fs-6"></i> {{ $post->likes_count ?? 0 }}
                        <i class="fa-solid fa-comment ms-2"></i> {{ $post->comments_count ?? 0 }}
                    </div>
                </div>
            @empty
                <p>No popular posts found</p>
            @endforelse
        </div>
    @elseif($activeTab === 'users')
        {{-- USERS タブ --}}
        <div class="row g-3">
            @forelse($users as $user)
                <div class="col-12 d-flex justify-content-center">
                    <div class="card p-3 w-50 shadow-sm">
                        <div class="d-flex align-items-center">
                            {{-- ユーザーリンク＆アバター --}}
                            <a href="{{ route('profile.show', $user->id) }}">
                                @if ($user->avatar)
                                    <img src="{{ $user->avatar }}" class="avatar-md me-3 rounded-circle">
                                @else
                                    <i class="fa-solid fa-circle-user icon-md me-3"></i>
                                @endif
                            </a>

                            {{-- ユーザー情報 --}}
                            <div class="flex-grow-1 me-3">
                                <a href="{{ route('profile.show', $user->id) }}" class="fw-bold text-decoration-none">
                                    {{ $user->name }}
                                </a>
                                <p class="mb-0 xsmall">
                                    Posts: {{ $user->post_count ?? 0 }}
                                </p>
                            </div>

                            {{-- フォローボタン（自分以外のユーザーのみ表示） --}}
                            @auth
                                @if ($user->id !== auth()->id())
                                    <livewire:profile.follow-button :user="$user" :key="$user->id" />
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>
            @empty
                <p>No users found</p>
            @endforelse
        </div>
    @elseif($activeTab === 'categories')
        {{-- CATEGORIES タブ --}}
        <div class="d-flex flex-wrap gap-2">
            @foreach ($categories as $c)
                <a href="{{ route('categories.show', $c->id) }}"
                    class="badge custom-badge custom-badge-lg">
                    {{ $c->name }}
                </a>
            @endforeach

            {{-- Uncategorized も追加 --}}
            <a href="{{ route('categories.show', 'uncategorized') }}"
                class="badge custom-badge custom-badge-lg">
                Uncategorized
            </a>
        </div>

    @endif
</div>
