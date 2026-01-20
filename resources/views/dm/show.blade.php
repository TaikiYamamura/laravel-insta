@extends('layouts.app')

@section('title', 'Direct Message')

@section('content')
<div class="container">
    <h5>Chat with {{ $conversation->userOne->id === auth()->id() ? $conversation->userTwo->name : $conversation->userOne->name }}</h5>

    <livewire:message-thread :conversation="$conversation" :key="$conversation->id" />
</div>
@endsection