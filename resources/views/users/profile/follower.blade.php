@extends('layouts.app')

@section('title','Show Followers')

@section('content')
    @include('users.profile.header')

    <div class="row">
        <div class="col-4 mx-auto mt-5">

            @if ($user->followers->count() == 0)
                <h1 class="h3 fw-bold text-center">No Followers</h1>
            @else
                <h1 class="h3 fw-bold text-center">Followers</h1>

                @foreach ($followers as $follower)
                    <div class="row align-items-center mb-2">
                        <div class="col-auto">
                            <a href="{{ route('profile.show', $follower->follower->id) }}">
                                @if ($follower->follower->avatar)
                                    <img src="{{ $follower->follower->avatar }}"
                                        alt="{{ $follower->follower->name }}"
                                        class="rounded-circle avatar-sm">
                                @else
                                    <i class="fa-solid fa-circle-user icon-sm"></i>
                                @endif
                            </a>
                        </div>

                        <div class="col ps-0">
                            <a href="{{ route('profile.show', $follower->follower->id) }}"
                            class="text-decoration-none text-dark fw-bolder">
                                {{ $follower->follower->name }}
                            </a>
                        </div>

                        @if (Auth::id() !== $follower->follower->id)
                            <div class="col-auto">
                                @if ($follower->follower->isFollowed())
                                    <form action="{{ route('follow.destroy', $follower->follower->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="border-0 bg-transparent p-0">
                                            Following
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('follow.store', $follower->follower->id) }}" method="post">
                                        @csrf
                                        <button type="submit" class="border-0 bg-transparent p-0 text-primary">
                                            Follow
                                        </button>
                                    </form>
                                @endif
                            </div>
                        @endif

                    </div>
                @endforeach
            @endif


            

        </div>
    </div>
@endsection
