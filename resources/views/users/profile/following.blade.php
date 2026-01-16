@extends('layouts.app')

@section('title','Show Followings')

@section('content')
    @include('users.profile.header')

    <div class="row">
        <div class="col-4 mx-auto mt-5">

            @if ($user->following->count() == 0)
                <h1 class="h3 text-secondary fw-bold text-center">No Following</h1>
            @else
                <h1 class="h3 text-secondary fw-bold text-center">Followings</h1>

                @foreach ($followings as $following)
                    <div class="row align-items-center mb-2">
                        <div class="col-auto">
                            <a href="{{ route('profile.show', $following->following->id) }}">
                                @if ($following->following->avatar)
                                    <img src="{{ $following->following->avatar }}"
                                        alt="{{ $following->following->name }}"
                                        class="rounded-circle avatar-sm">
                                @else
                                    <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>
                                @endif
                            </a>
                        </div>

                        <div class="col ps-0">
                            <a href="{{ route('profile.show', $following->following->id) }}"
                            class="text-decoration-none text-dark fw-bolder">
                                {{ $following->following->name }}
                            </a>
                        </div>

                        @if (Auth::id() !== $following->following->id)
                            <div class="col-auto">
                                @if ($following->following->isFollowed())
                                    <form action="{{ route('follow.destroy', $following->following->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="border-0 bg-transparent p-0 text-secondary">
                                            Following
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('follow.store', $following->following->id) }}" method="post">
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
