@extends('layouts.app')

@section('title', 'Users')

@section('content')
<div class="container">
    <h3 class="mb-3">Users</h3>
    <div class="row">
        @foreach($users as $user)
        @if (auth()->user()->isFollowing($user))
            <div class="col-4 mb-3">
                <div class="card p-2 text-center">
                    @if($user->avatar)
                        <img src="{{ $user->avatar }}" class="rounded-circle mb-2 mx-auto" style="width:50px;height:50px;">
                    @else
                        <i class="fa-solid fa-circle-user fa-2x mb-2"></i>
                    @endif
                    <div>{{ $user->name }}</div>

                    @if($user->id !== auth()->id())
                        <a href="{{ route('dm.show', $user->id) }}" class="btn btn-sm btn-primary mt-2">DM</a>
                    @endif
                </div>
            </div>
        @endif
        @endforeach
    </div>
</div>
@endsection
