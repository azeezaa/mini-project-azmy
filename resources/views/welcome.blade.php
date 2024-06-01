@extends('layouts.master')

@section('title', 'Beranda')

@section('content')
<div class="d-flex">
    @include('layouts.sidebar')

    <div class="col" style="margin-left: 300px;">
        {{-- ini header --}}
        <div class="m-1 bg-black sticky-top">
            <div class="container-fluid">
                <div class="mt-3 d-flex justify-content-center">
                    <img style="height:50px;" src="{{ asset('assets/logo-medsos.png') }}" alt="Logo Medsos">
                </div>
                <div class="d-flex justify-content-center gap-3 fw-semibold py-2" style="color: #fff;">
                    <a href="{{ route('beranda', ['filter' => 'for_you']) }}" style="color: {{ $filter === 'for_you' ? '#4CC2D0' : '#fff9' }}; text-decoration: none; {{ $filter === 'for_you' ? 'font-weight: bold;' : '' }}">For You</a>
                    <a href="{{ route('beranda', ['filter' => 'following']) }}" style="color: {{ $filter === 'following' ? '#4CC2D0' : '#fff9' }}; text-decoration: none; {{ $filter === 'following' ? 'font-weight: bold;' : '' }}">Following</a>

                </div>
            </div>
        </div>
        
        {{-- ini konten --}}
        <div class="d-flex">
            <div class="col-md-7 m-1" style="height: 100vh; overflow-y: auto;">
                <div class="container-fluid py-5">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            @foreach($posts as $post)
                                <div class="border p-4 bg-black rounded mb-3">
                                    <div class="mb-3">
                                        <div class="d-flex align-items-center">
                                            @if($post->user)
                                                <img src="{{ $post->user->profile_image ? asset($post->user->profile_image) : asset('assets/default_profile.png') }}" alt="User Avatar" class="rounded-circle me-3" style="width: 50px; height: 50px;">
                                                <div class="flex-grow-1">
                                                    <div class="fw-bold mb-1">{{ $post->user->username }}</div>
                                                    <div class="text-light">{{ $post->created_at->diffForHumans() }}</div>
                                                </div>
                                            @else
                                                <div class="text-danger">User not found</div>
                                            @endif
                                            <form action="{{ route('toggleBookmark', $post->id) }}" method="POST">
                                                @csrf
                                                <button style="background-color:transparent; border:transparent;" type="submit">
                                                    @if($post->isBookmarkedByUser(Auth::id()))
                                                        <i class="fa-solid fa-bookmark fa-lg text-light"></i>
                                                    @else
                                                        <i class="fa-regular fa-bookmark fa-lg text-light"></i>
                                                    @endif
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        {{ $post->caption }}
                                    </div>
                                    <div class="shadow-sm mb-3">
                                        <a href="{{ route('seePost', ['postId' => $post->id]) }}">
                                            <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top rounded" alt="Post Image" style="max-height: 400px;">
                                        </a>
                                        <hr>
                                        <div class="row">
                                            <div class="col-12 d-flex align-items-center gap-4">
                                                <div class="d-flex align-items-center gap-2 mr-4">
                                                    <form action="{{ route('toggleLike', $post->id) }}" method="POST">
                                                        @csrf
                                                        <button style="background-color:transparent; border:transparent;" class="like-button" data-post-id="{{ $post->id }}">
                                                            @if($post->likes->where('user_id', Auth::id())->count() > 0)
                                                                <i class="fa-solid fa-heart fa-lg text-light"></i>
                                                            @else
                                                                <i class="fa-regular fa-heart fa-lg text-light"></i>
                                                            @endif
                                                        </button>
                                                    </form>
                                                    <span id="like-count-{{ $post->id }}">{{ $post->likes()->count() }} Likes</span>
                                                </div>
                                                <div class="d-flex align-items-center gap-2">
                                                    <a href="{{ route('seePost', $post->id) }}"><i class="fa-regular fa-comment text-light fa-lg"></i></a>
                                                    <span id="like-count-{{ $post->id }}">{{ $post->comments()->count() }} Comments</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5 m-1" style="position: sticky; top: 0; height: 100vh;">
    <div class="col-md-9 mx-auto" style="margin-top: 40px; overflow-y: auto; height: calc(100vh - 50px);">
        <p class="fw-bold fs-5 p-0 m-0">Siapa yang harus diikuti</p>
        <p class="text-secondary mt-2" style="font-size: 14px">Orang yang mungkin anda kenal</p>

        <div class="container">
            @if($users->count() > 0)
                @foreach($users as $user)
                    @if(auth()->check() && auth()->user()->id !== $user->id && !auth()->guest())
                        <div class="mb-3">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset($user->profile_image) }}" alt="User Avatar" class="rounded-circle me-3" style="width: 50px; height: 50px;">
                                <div class="flex-grow-1">
                                    <div class="fw-bold mb-1">{{ $user->username }}</div>
                                    <div class="text-light">{{ $user->fullname }}</div>
                                </div>
                                @auth
                                    @if(auth()->user()->isFollowing($user))
                                        <form action="{{ route('unfollow', $user->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" style="text-decoration: none; border: none; border-radius: 5px; background-color: #fff; width: 80px; text-align: center;">Unfollow</button>
                                        </form>
                                    @else
                                        <form action="{{ route('follow', $user->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" style="color: #fff; text-decoration: none; background-color: transparent; border-radius: 5px; width: 80px; text-align: center;">Follow</button>
                                        </form>
                                    @endif
                                @else
                                    <form action="{{ route('login') }}">
                                        <button type="submit" style="color: #fff; text-decoration: none; background-color: transparent; border-radius: 5px; width: 80px; text-align: center;">Follow</button>
                                    </form>
                                @endauth
                            </div>
                        </div>
                    @elseif(auth()->guest())
                        <div class="mb-3">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset($user->profile_image) }}" alt="User Avatar" class="rounded-circle me-3" style="width: 50px; height: 50px;">
                                <div class="flex-grow-1">
                                    <div class="fw-bold mb-1">{{ $user->username }}</div>
                                    <div class="text-light">{{ $user->fullname }}</div>
                                </div>
                                <form action="{{ route('login') }}">
                                    <button type="submit" style="color: #fff; text-decoration: none; background-color: transparent; border-radius: 5px; width: 80px; text-align: center;">Follow</button>
                                </form>
                            </div>
                        </div>
                    @endif
                @endforeach
            @else
                <p>No users found.</p>
            @endif
        </div>
        <hr>
        <p class="text-secondary mt-2" style="font-size: 14px">Terms of Service Privacy Policy Cookie Policy Accessibility Ads info More © 2024 Sosmed<p>
        </div>
    </div>
</div>
@endsection
