@extends('layouts.app')

@section('title', 'Home Page')

@section('content')
    <div class="row">
        <div class="col-8">
            @forelse ($all_posts as $post)
                <div class="card mb-4">
                    {{-- title --}}
                    @include('users.posts.contents.title')

                    {{-- body --}}
                    @include('users.posts.contents.body')
                </div>
            @empty
                <div class="text-center">
                    <h2>Share photos</h2>
                    <p class="text-muted">
                        When you share photos, they'll appear on your profile <br>
                        <a href="{{ route('post.create') }}" class="text-decoration-none">
                            Share your first photo
                        </a>
                    </p>
                </div>
            @endforelse
        </div>
        <div class="col-4">
            <div class="row align-items-center mb-5 bg-white shadow-sm rounded-3 py-1">
                {{-- <div class="col-auto">
                    @if ($suggested_users->avatar)
                        <img src="{{ $suggested_users->avatar }}" alt="" class="rounded-circle avatar-md">
                    @else
                        <i class="fa-solid fa-circle-user text-secondary d-block text-center icon-md"></i>
                    @endif
                </div>
                <div class="col-auto">
                    <div class="row">
                        <p class="text-dark mt-3">{{ $suggested_users->name }}</p>
                    </div>
                    <div class="row">
                        <p class="text-dark text-muted">{{ $suggested_users->email }}</p>
                    </div>
                </div> --}}
            </div>
            @if ($suggested_users)
                <div class="row">
                    <div class="col-auto">
                        <p class="fw-bold text-secondary">Suggestion for you</p>
                    </div>
                    <div class="col text-end">
                        <a href="" class="text-dark text-decoration-none fw-bold">See All</a>
                    </div>
                </div>
                @foreach ($suggested_users as $user)
                    <div class="row align-items-center mb-3">
                        <div class="col-auto">
                            @if ($user->avatar)
                                <img src="{{ $user->avatar }}" alt="" class="rounded-circle avatar-sm">
                            @else
                                <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>
                            @endif
                        </div>
                        <div class="col text-truncate ps-0">
                            <a href="{{ route('profile.show', $user->id) }}" class="text-decoration-none text-dark fw-bold">{{ $user->name }}</a>
                        </div>
                        <div class="col-auto">
                            <form action="{{ route('follow.store', $user->id) }}" method="post">
                                @csrf

                                <button type="submit" class="btn btn-sm text-primary border-0 p-0">Follow</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection
