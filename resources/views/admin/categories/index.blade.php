@extends('layouts.app')

@section('title', 'Admin: Categories')

@section('content')
<div class="row">
    <div class="col-8">
        <div class="row">
            <div class="col-9">
                <form action="{{ route('admin.categories.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="row mb-3">
            <div class="col-9">
                <input type="text" name="name" class="form-control" placeholder="Add a category">
            </div>
            <div class="col-3">
                <button type="submit" class="btn btn-primary ">+ Add</button>
            </div>
        </div>
        {{-- Error --}}
            @error('category')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
    </form>
            </div>
        </div>

    <table class="table table-hover align-middle bg-white border text-secondary text-center">
        <thead class="small table-warning text-secondary">
            <tr>
                <th>#</th>
                <th>NAME</th>
                <th>COUNT</th>
                <th>LAST UPDATE</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($all_categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->categoryPost->count() }}</td>
                    <td>{{ $category->updated_at }}</td>
                    <td>
                        <div>
                            <button class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#edit-category-{{ $category->id }}"><i class="fa-solid fa-pencil"></i></button>
                            <button class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#delete-category-{{ $category->id }}"><i class="fa-solid fa-trash-can"></i></button>
                        </div>
                        {{-- include modal here --}}
                            @include('admin.categories.modal.edit')
                            @include('admin.categories.modal.delete')
                    </td>
                </tr>
            @endforeach
            <tr>
                <td></td>
                <td>
                    Uncategorized
                    <br>
                    <span class="text-secondary fw-light">Hidden posts are not included.</span>
                </td>
                <td>{{ $uncategorized_count }}</td>
                <td></td>
                <td></td>
            </tr> 
        </tbody>
    </table>
    </div>
</div>
@endsection