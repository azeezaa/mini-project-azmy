@extends('layouts.master')
@extends('layouts.sidebar')
@section('title', 'See Post')
@section('content')
<div class="col" style="margin-left: 300px;">
    <div class="bg-black m-1 sticky-top">
        <div class="container-fluid">
            <div class="d-flex justify-content-center">
                <img style="height:50px;" src="{{ asset('assets/logo-medsos.png') }}" alt="Logo Medsos">
            </div>
            <div class="gap-3 fw-semibold py-2" style="color: #fff;">
                <a href="javascript:history.back()" style="color: #fff; text-decoration: none;"><i class="fa-solid fa-angle-left fa-2xl"></i></a>
                <a href="javascript:history.back()" class="fw-bold fs-" style="color: #fff; text-decoration: none;">Back</a>
            </div>
        </div>
    </div>

    <div class="">
        <div class=" m-1" style="height: 100vh; overflow-y: auto;">
            <div class="container-fluid py-5">
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <div class="row border p-4 bg-black rounded mb-3">
                            <div class="col">
                                <div class="mb-3">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ $post->user->profile_image ? asset($post->user->profile_image) : asset('assets/default_profile.png') }}" alt="User Avatar" class="rounded-circle me-3" style="width: 50px; height: 50px;">
                                        <div class="flex-grow-1">
                                            <div class="fw-bold mb-1">{{ $post->user->username }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    {{ $post->caption }}
                                </div>
                                <a href="{{ route('seePost', $post->id) }}">
                                    <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top rounded" alt="Post Image" style="max-height: 400px;">
                                </a>
                            </div>
                            <div class="col">
                                <div class="shadow-sm mb-3">
                                    <h5 class="fw-bold">Komentar</h5>
                                    @if($post->comments->count() > 0)
                                        @foreach($post->comments as $comment)
                                        @if($comment->parent_id==null)
                                            <div class="mb-3 rounded">
                                                <div class="d-flex align-items-center">
                                                    <img src="{{asset($comment->user->profile_image)}}" alt="Profile Picture" class="rounded-circle me-2" style="width: 20px; height: 20px;">
                                                    <p class="fw-bold">{{ $comment->user->username }}</p>
                                                </div>
                                                <p>{{ $comment->content }}</p>
                                                <div class="d-flex align-items-center justify-content-between" style="flex-wrap: wrap;">
                                                    <div class="col d-flex gap-1">
                                                        <form action="{{ route('toggleCommentLike', $comment->id) }}" method="post">
                                                            @csrf
                                                            <button type="submit" class="bg-transparent border-0 text-primary">
                                                                @if($comment->likes->where('user_id', auth()->id())->count() > 0)
                                                                    <i class="fa-solid text-light fa-heart mt-1"></i>
                                                                @else
                                                                    <i class="fa-regular text-light fa-heart mt-1"></i>
                                                                @endif
                                                            </button>
                                                        </form>
                                                        <span>{{ $comment->likes()->count() }} Likes</span>
                                                    </div>
                                                    <div class="col d-flex justify-content-end pe-3 gap-3">
                                                        @if(auth()->check() && $comment->user_id === auth()->id())
                                                            <form action="{{ route('deleteComment', $comment->id) }}" method="post">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="bg-transparent border-0 text-danger">Hapus</button>
                                                            </form>
                                                            <button class="bg-transparent border-0 text-success reply-btn pb-3">Reply</button>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="reply-form" style="display: none;">
                                                    <form action="{{ route('replyComment', $comment->id) }}" method="post" class="d-flex">
                                                        @csrf
                                                        <input type="text" name="reply_content" required class="form-control me-2 bg-black border-0 border-bottom rounded-0 text-light" placeholder="Enter your reply here">
                                                        <button type="submit" class="btn btn-transparent">Reply</button>
                                                    </form>
                                                </div>
                                                @foreach($comment->replies as $reply)
                                                    <div class="ms-5 mb-3 rounded">
                                                        <div class="d-flex align-items-center">
                                                            <img src="{{ asset($reply->user->profile_image) }}" alt="Profile Picture" class="rounded-circle me-2" style="width: 20px; height: 20px;">
                                                            <p class="fw-bold">{{ $reply->user->username }}</p>
                                                        </div>
                                                        <p>{{ $reply->content }}</p>
                                                        <div class="d-flex align-items-center justify-content-end">
                                                            @if(auth()->check() && $reply->user_id === auth()->id())
                                                                <form action="{{ route('deleteComment', $reply->id) }}" method="post">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="bg-transparent border-0 text-danger">Hapus</button>
                                                                </form>
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                        @endforeach
                                    @else
                                        <p class="text-center py-3">Belum ada komentar.</p>
                                    @endif
                                    <hr>
                                    <div class="row pt-1">
                                        <div class="col-12 d-flex align-items-center justify-content-between gap-4">
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
                                                <form action=""><i class="fa-regular fa-comment fa-lg"></i></form>
                                                <form action=""><i class="fa-regular fa-paper-plane fa-lg"></i></form>
                                            </div>
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
                                    <p class="ps-1" id="like-count-{{ $post->id }}">{{ $post->likes()->count() }} Likes</p>
                                    <div class="d-flex pt-3">
                                        <form action="{{ route('addComment', $post->id) }}" method="POST" class="d-flex flex-grow-1">
                                            @csrf
                                            <input type="text" name="reply_content" required class="form-control me-2 bg-black border-0 border-bottom rounded-0" placeholder="Enter your reply here">
                                                        <button type="submit" class="btn btn-transparent">Kirim</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const replyButtons = document.querySelectorAll('.reply-btn');
        replyButtons.forEach(btn => {
            btn.addEventListener('click', function() {
                const replyForm = this.parentElement.parentElement.parentElement.querySelector('.reply-form');
                if (replyForm.style.display === 'none' || replyForm.style.display === '') {
                    replyForm.style.display = 'block';
                } else {
                    replyForm.style.display = 'none';
                }
            });
        });
    });
</script>
