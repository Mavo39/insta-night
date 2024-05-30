<div class="modal fade" id="edit-category-{{ $category->id }}">
    <div class="modal-dialog">
        <div class="modal-content border-warning">
            <div class="modal-header border-warning align-items-center">
                <h2 class="h5">
                    <i class="fa-regular fa-pen-to-square"></i> Edit Category
                </h2>
            </div>
            <div class="modal-body">
                <input type="text" name="category" id="" value="{{ $category->name }}" class="form-control w-100">
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-outline-warning" data-bs-dismiss="modal">
                    Cancel
                </button>
                <form action="{{ route('admin.categories.update', $category->id) }}" method="post">
                    @csrf
                    @method('PATCH')

                    <button type="submit" class="btn btn-warning">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
