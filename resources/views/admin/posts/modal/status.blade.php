<div class="modal fade" id="hide-post-{{ $post->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-danger">
                <h5 class="modal-title text-danger" id="modalTitleId">
                    <i class="fa-solid fa-user-slash"></i> Hide Post
                </h5>
            </div>
            <div class="modal-body">
                <p class="text-darl">
                    Are you sure you want to hide this post?
                </p>
                <div class="d-block">
                    <img src="{{ $post->image }}" alt="" class="image-md">
                </div>
                <p class="text-secondary">
                    {{ $post->description }}
                </p>
            </div>
            <div class="modal-footer border-0">
                <form action="{{ route('admin.posts.hide', $post->id) }}" method="post">
                    @csrf
                    @method('DELETE')

                    <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-danger">Hide</button>
                </form>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="unhide-post-{{ $post->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-primary">
                <h5 class="modal-title text-primary" id="modalTitleId">
                    <i class="fa-solid fa-user-slash"></i> Unhide Post
                </h5>
            </div>
            <div class="modal-body">
                <p class="text-darl">
                    Are you sure you want to unhide this post?
                </p>
                <div class="d-block">
                    <img src="{{ $post->image }}" alt="" class="image-md">
                </div>
                <p class="text-secondary">
                    {{ $post->description }}
                </p>
            </div>
            <div class="modal-footer border-0">
                <form action="{{ route('admin.posts.unhide', $post->id) }}" method="post">
                    @csrf
                    @method('PATCH')

                    <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-primary">Unide</button>
                </form>

            </div>
        </div>
    </div>
</div>
