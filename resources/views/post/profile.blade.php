@extends('layouts.master')
@section('title', 'My Profile')

@section('content')
<div class="d-flex">
    @extends('layouts.sidebar')

    <div class="col border-left border-secondary" style="margin-left: 300px;">
        {{-- Main content area --}}
        <div>
            <div class="row m-1 gap-1 p-4">
                <div class="col-md-10 mx-auto row bg-black rounded">
                    <div class="d-flex justify-content-between p-3 w-100">
                        <div class="d-flex align-items-center">
                            <img src="{{ asset(Auth::user()->profile_image) }}" alt="User Avatar" class="rounded-circle me-4" style="width: 100px; height: 100px;">
                            <div class="flex-grow-1">
                                <div class="fw-bold mb-1 fs-4">{{ Auth::user()->username }}</div>
                                <div class="d-flex small gap-3 py-2" style="color: #fff;">
                                    <a href="#" style="color: #fff; text-decoration: none;">{{ Auth::user()->posts->count() }} Posts</a>
                                    <a href="#" style="color: #fff; text-decoration: none;">{{ Auth::user()->following()->count() }} Following</a>
                                    <a href="#" style="color: #fff; text-decoration: none;">{{ Auth::user()->followers()->count() }} Followers</a>
                                </div>
                                <div class="fw-bold mb-1 small">{{ Auth::user()->fullname }}</div>
                                <div class="mb-1 small">{{ Auth::user()->bio }}</div>
                            </div>
                        </div>
                        <div class="pt-3">
                            <a class="text-decoration-none" style="color: inherit;" href="{{ route('editprofile') }}"><i class="fa-solid fa-gear fa-lg"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-10 mx-auto m-1 row bg-black rounded">
                    @if(Auth::user()->posts->count() > 0)
                    <div class="row g-2 p-3">
                            <hr>
                            <p class="fw-semibold text-center pb-3 m-0"><i class="fa-solid fa-table-cells-large me-2"></i>POSTS</p>
                            @foreach(Auth::user()->posts as $post)
                                <div class="col-6 col-md-3">
                                    <div class="ratio ratio-1x1 bg-light rounded">
                                        <a href="{{ route('seePost', ['postId' => $post->id]) }}">
                                            <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" class="img-fluid rounded">
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="d-flex justify-content-center align-items-center" style="height: 200px;">
                            <span class="text-light fw-bold">Belum ada postingan</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
