@extends('layouts.app')

@section('title', 'Admin:Posts')

@section('content')
    <table class="table table-hover align-middle bg-white border-text-secondary">
        <thead class="table-primary text-secondary small">
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
                    <td><img src="{{ $post->image }}" alt="" class="image-md"></td>
                    <td>
                        @foreach ($post->categoryPost as $category_post)
                            <span class="badge bg-secondary bg-opacity-50">
                                #{{ $category_post->category->name }}
                            </span>
                        @endforeach
                    </td>
                    <td>
                        <a href="{{ route('profile.show', $post->user->id) }}" class="text-decoration-none text-dark">
                            {{ $post->user->name }}
                        </a>
                    </td>
                    <td>{{ $post->user->created_at }}</td>
                    <td>
                        @if ($post->trashed())
                            <i class="fa-solid fa-circle-minus text-secondary"></i> Hidden
                        @else
                            <i class="fa-solid fa-circle text-primary"></i> Visible
                        @endif
                    </td>
                    <td>
                        @if ($post->user->id != Auth::id())
                            <div class="dropdown">
                                <button class="btn btn-sm" data-bs-toggle="dropdown">
                                    <i class="fa-solid fa-ellipsis"></i>
                                </button>
                                @if ($post->trashed())
                                    <div class="dropdown-menu">
                                        <button class="dropdown-item text-dark" data-bs-toggle="modal"
                                            data-bs-target="#unhide-post-{{ $post->id }}">
                                            <i class="fa-solid fa-eye"></i></i> Unhide Post
                                            {{ $post->id }}
                                        </button>
                                    </div>
                                @else
                                    <div class="dropdown-menu">
                                        <button class="dropdown-item text-danger" data-bs-toggle="modal"
                                            data-bs-target="#hide-post-{{ $post->id }}">
                                            <i class="fa-solid fa-eye-slash"></i></i> Hide Post
                                            {{ $post->id }}
                                        </button>
                                    </div>
                                @endif
                            </div>
                        @endif
                    </td>
                    @include('admin.posts.modal.status')
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="container">
        <div class="row justify-content-center">
            <nav aria-label="Page navigation example">
                <ul class="pagination text-center">
                    <li class="page-item"><a class="page-link" href="#"><</a></li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">></a></li>
                </ul>
            </nav>
        </div>
    </div>
@endsection
