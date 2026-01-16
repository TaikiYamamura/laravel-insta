@extends('layouts.app')
 
@section('title', 'Admin: Posts')
 
@section('content')
    <table class="table table-hover align-middle bg-white border text-secondary">
        <thead class="small table-primary text-secondary">
            <tr>
                <th></th>
                <th></th>
                <th>CATEGORY</th>
                <th>OWNER</th>
                <th>CREATED AT</th>
                <th>STATUS</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($all_posts as $post)
                <tr>
                    <td>{{ $post->id }}</td>
                    <td>
                        <a href="{{ route('post.show', $post->id) }}">
                            <img src="{{ $post->image }}" alt="Post at {{ $post->user->name }}" class="post-square">
                        </a>
                    </td>
                    <td>
                        @if ($post->categoryPost->isEmpty())
                            <div class="badge bg-dark">
                                Uncategorized
                            </div>
                        @else
                            @foreach ($post->categoryPost as $category_post)
                                <div class="badge bg-secondary bg-opacity-50">
                                    {{ $category_post->category->name }}
                                </div>
                            @endforeach
                        @endif
                    </td>
                    <td>{{ $post->user->name }}</td>
                    <td>{{ $post->created_at }}</td>
                    <td>
                        @if ($post->trashed())
                            <i class="fa-solid fa-circle text-secondary"></i> &nbsp; Invisible
                        @else
                            <i class="fa-solid fa-circle text-primary"></i> &nbsp; Visible
                        @endif
                        
                    </td>
                    <td>
                        
                            <div class="dropdown">
                                <button class="btn btn-sm" data-bs-toggle="dropdown">
                                    <i class="fa-solid fa-ellipsis"></i>
                                </button>

                                <div class="dropdown-menu">
                                    @if ($post->trashed())
                                        <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#visible-post-{{ $post->id }}">
                                            <i class="fa-solid fa-eye"></i> Visible Post{{ $post->id }}
                                        </button>
                                    @else
                                        <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#invisible-post-{{ $post->id }}">
                                            <i class="fa-solid fa-eye-slash"></i> Invisible Post{{ $post->id }}
                                        </button>
                                    @endif
                                </div>
                            </div>
                            {{-- include modal here --}}
                            @include('admin.posts.modal.status')
                        
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {{ $all_posts->links() }}
    </div>
@endsection