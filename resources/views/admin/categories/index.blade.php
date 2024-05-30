@extends('layouts.app')

@section('title', 'Admin:Categories')

@section('content')
    <div class="row mb-3">

        <form action="{{ route('admin.categories.create') }}" method="post">
            @csrf
            <div class="col-4 d-inline-block">
                <input type="text" name="category" class="form-control" placeholder="Add a category">
            </div>
            <div class="col-auto d-inline-block">
                <button type="submit" class="btn ms-2 btn-primary">
                    <i class="fa-solid fa-plus text-white"></i> Add
                </button>
            </div>
        </form>
    </div>

    <div class="row">
        <div class="col-auto">
            <table class="table table-hover text-center bg-white border mt-3d-flex align-items-center justify-content-center">
                <thead class="small table-warning text-dark">
                    <tr>
                        <th>#</th>
                        <th>NAME</th>
                        <th>COUNT</th>
                        <th>LAST UPDATED</th>
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
                                <a href="#" class="btn btn-outline-warning btn-sm me-3" data-bs-toggle="modal"
                                    data-bs-target="#edit-category-{{ $category->id }}">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <a href="{{ route('admin.categories.uncategorised', $category->id) }}"
                                    class="btn btn-outline-danger btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#delete-category-{{ $category->id }}">
                                    <i class="fa-solid fa-trash-can"></i>
                                </a>
                            </td>
                            @if ($loop->last)
                                <tr>
                                    <td></td>
                                    <td>
                                        <p>Uncategorized</p>
                                        <p class="text-secondary text-truncate">Hidden posts are not included</p>
                                    </td>
                                    <td>{{ $category->categoryPost->count() }}</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            @endif
                        </tr>
                    @include('admin.categories.modal.edit')
                    @include('admin.categories.modal.delete')
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
