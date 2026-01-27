@extends('layouts.app')

@section('title', $category ? $category->name : 'Uncategorized')

@section('content')
    <livewire:category.category-show :category="$category" />
@endsection
