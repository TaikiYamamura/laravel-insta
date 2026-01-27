@extends('layouts.app')

@section('title', 'Search Results')

@section('content')
    <livewire:search :query="$query" />
@endsection

