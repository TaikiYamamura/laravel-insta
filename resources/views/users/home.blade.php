@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="row gx-5">
        <div class="col-8">
            @forelse ($home_posts as $post)
                <div class="card mb-4">
                    {{-- title --}}
                    @include('users.posts.contents.title')
                    {{-- body --}}
                    @include('users.posts.contents.body')
                </div>
            @empty
                {{-- If the site doesn't have any post --}}
                <div class="text-center">
                    <h2>Share Photos</h2>
                    <p>When you share photos, they'll appear on yor profile.</p>
                    <a href="{{ route('post.create') }}" class="text-decoration-none">Share yor first photo</a>
                </div>
            @endforelse
        </div>
        <div class="col-4">
            {{-- profile overview --}}
            <div class="row align-items-center mb-5 shadow-sm rounded-3 py-3 box_color">
                <div class="col-auto">
                    <a href="{{ route('profile.show', Auth::user()->id) }}">
                        @if (Auth::user()->avatar)
                            <img src="{{ Auth::user()->avatar }}" alt="{{ Auth::user()->name }}" class="rounded-circle avatar-md">
                        @else
                            <i class="fa-solid fa-circle-user icon-md"></i>
                        @endif
                    </a>
                </div>
                <div class="col ps-0">
                    <a href="{{ route('profile.show', Auth::user()->id) }}" class="text-decoration-none fw-bold">{{ Auth::user()->name }}</a>
                    <p class="mb-0">{{ Auth::user()->email }}</p>
                </div>
            </div>


            {{-- Suggestions --}}

            @if ($suggested_users)
                <div class="row shadow-sm rounded-3 py-3 px-2 box_color">
                    <div class="col-auto my-2">
                        <p class="fw-bold">Suggestions For You</p>
                    </div>
                    <div class="col text-end my-2">
                        <a href="#" class="fw-bold text-decoration-none pe-5">See all</a>
                    </div>

                    @foreach ($suggested_users as $user)
                        <div class="row align-items-center mb-3">
                            <div class="col-auto">
                                <a href="{{ route('profile.show', $user->id) }}">
                                    @if ($user->avatar)
                                        <img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="rounded-circle avatar-sm">
                                    @else
                                        <i class="fa-solid fa-circle-user icon-sm"></i>
                                    @endif
                                </a>
                            </div>
                            <div class="col ps-0 ">
                                <a href="{{ route('profile.show', $user->id) }}" class="text-decoration-none fw-bold">{{ $user->name }}</a>
                            </div>
                            <div class="col-auto">
                                <form action="{{ route('follow.store', $user->id) }}" method="post">
                                    @csrf
                                    <button class="border-0 btn-sm follow-btn" type="submit">
                                        <i class="fa-regular fa-plus"></i> Follow
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection
