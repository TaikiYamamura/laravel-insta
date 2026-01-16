@if ($post->trashed())
    {{-- visible --}}
<div class="modal fade" id="visible-post-{{ $post->id }}">
    <div class="modal-dialog">
        <div class="modal-content border-primary">
            <div class="modal-header border-primary">
                <h3 class="h5 modal-title text-primary">
                    <i class="fa-solid fa-eye-check"></i> Visible Post
                </h3>
            </div>
            <div class="modal-body">
                Are you sure you want to see <span class="fw-bolder">Post {{ $post->id }}</span>?
                <div class="mt-3">
                    <img src="{{ $post->image }}" alt="post id {{ $post->id }}" class="image-lg">
                    <p class="mt-1 text-muted">{{ $post->description }}</p>
                </div>
            </div>
            <div class="modal-footer border-0">
                <form action="{{ route('admin.posts.visible', $post->id) }}" method="post">
                    @csrf
                    @method('PATCH')

                    <button type="button" class="btn btn-outline-primary btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary btn-sm">Visible</button>
                </form>
            </div>
        </div>
    </div>
</div>
@else
    {{-- deactivate --}}
<div class="modal fade" id="invisible-post-{{ $post->id }}">
    <div class="modal-dialog">
        <div class="modal-content border-danger">
            <div class="modal-header border-danger">
                <h3 class="h5 modal-title text-danger">
                    <i class="fa-solid fa-eye-slash"></i> Invisible Post
                </h3>
            </div>
            <div class="modal-body">
                Are you sure you do not want to see <span class="fw-bolder">Post {{ $post->id }}</span>?
                <div class="mt-3">
                    <img src="{{ $post->image }}" alt="post id {{ $post->id }}" class="image-lg">
                    <p class="mt-1 text-muted">{{ $post->description }}</p>
                </div>
            </div>
            <div class="modal-footer border-0">
                <form action="{{ route('admin.posts.invisible', $post->id) }}" method="post">
                    @csrf
                    @method('DELETE')

                    <button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger btn-sm">Invisible</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endif