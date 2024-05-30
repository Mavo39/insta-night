<div class="modal fade" id="delete-category-{{ $category->id }}">
    <div class="modal-dialog">
        <div class="modal-content border-danger">
            <div class="modal-header border-danger align-items-center">
                <h2 class="h5 text-danger">
                    <i class="fa-solid fa-trash-can text-outline-danger"></i> Delete Category
                </h2>
            </div>
            <div class="modal-body">
                <p class="text-dark">
                    Are you sure you want to delete {{ $category->name }} category? <br>
                    This action will affect all the posts under this category. Posts without category will fall under Uncategorized.
                </p>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">
                    Cancel
                </button>
                <form action="{{ route('admin.categories.uncategorised', $category->id) }}" method="post">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
