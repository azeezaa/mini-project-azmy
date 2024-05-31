@extends('layouts.master')
@section('title', 'Bookmark')

@section('content')

<div class="d-flex">
    @extends('layouts.sidebar')

    <div class="col" style="margin-left: 300px;">
        {{-- Fixed header in the right section --}}
        <div class="bg-primary m-1 sticky-top">
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
        
        {{-- Main content area --}}
        <div>
            <div class="row m-1 bg-success gap-1 p-4" style="overflow-y: auto;">
                <h4>All Bookmarks</h4>
                @for ($i = 0; $i < 9; $i++)
                <div class="col-md-2 m-1 row border bg-black rounded">
                    <div class="d-flex align-items-center py-2">
                        <img src="https://via.placeholder.com/150" alt="User Avatar" class="rounded-circle me-2" style="width: 40px; height: 40px;">
                        <div class="flex-grow-1">
                            <div class="fw-bold text-sm">Username</div>
                            <div class="text-light text-sm">Waktu</div>
                        </div>
                    </div>
                    <div class="position-relative" style="padding-bottom: 100%; height: 0; overflow: hidden;">
                        <img src="https://via.placeholder.com/400x400" class="card-img-top rounded position-absolute m-auto" alt="Post Image" style="width: 90%; height: 90%; object-fit: cover;">
                    </div>
                </div>
                @endfor
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
