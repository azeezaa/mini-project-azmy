@extends('layouts.master')
@section('title', 'Bookmark')

@section('content')

<div class="d-flex">
    @extends('layouts.sidebar')

    <div class="col" style="margin-left: 300px;">
        <div class="bg-black m-1 sticky-top">
            <div class="container-fluid">
                <div class="d-flex justify-content-center">
                    <img style="height:50px;" src="{{ asset('assets/logo-medsos.png') }}" alt="Logo Medsos">
                </div>
                <div class="d-flex justify-content-center gap-3 fw-semibold py-2" style="color: #fff;">
                    <a href="#" style="color: #fff; text-decoration: none;">For You</a>
                    <a href="#" style="color: #fff; text-decoration: none;">Following</a>
                </div>
            </div>
        </div>
        
        <div>
            <div class="row m-1 gap-1 p-4" style="overflow-y: auto;">
                <h4>All Bookmarks</h4>
                @foreach($bookmarkedPosts as $post)
                    <div class="border col-md-3 p-4 bg-black rounded mb-3">
                        <div class="mb-3">
                            <div class="d-flex align-items-center">
                                @if($post->user)
                                    <img src="{{ $post->post->user->profile_image ? asset($post->post->user->profile_image) : asset('path/to/default/image') }}" alt="User Avatar" class="rounded-circle me-3" style="width: 50px; height: 50px;">
                                    <div class="flex-grow-1">
                                        <div class="fw-bold mb-1">{{ $post->post->user->username }}</div>
                                        <div class="text-light">{{ $post->post->created_at->diffForHumans() }}</div>
                                    </div>
                                @else
                                    <div class="text-danger">User not found</div>
                                @endif
                            </div>
                        </div>
                        <div class="shadow-sm">
                            <a href="{{ route('seePost', $post->id) }}">
                                <img src="{{ asset('storage/' . $post->post->image) }}" class="card-img-top rounded" alt="Post Image" style="max-height: 200px;">
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        document.getElementById('image').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('imagePreview').innerHTML = `<img src="${e.target.result}" alt="Image" style="max-width: 100%; max-height: 100%;">`;
                }
                reader.readAsDataURL(file);
            } else {
                document.getElementById('imagePreview').innerHTML = '<span class="text-light">Add Image</span>';
            }
        });
    </script>
@endsection
