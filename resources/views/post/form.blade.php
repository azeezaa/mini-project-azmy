@extends('layouts.master')
@section('title', 'Posting')

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
            <div class="col m-1 bg-success" style="height: 100vh; overflow-y: auto;">
                <div class="col-md-4 mx-auto border p-4 bg-black rounded mb-3">
                    <form action="{{ route('formPost') }}" method="post">
                        <div class="mb-4">
                            <div class="d-flex align-items-center">
                                <img src="https://via.placeholder.com/150" alt="User Avatar" class="rounded-circle me-3" style="width: 50px; height: 50px;">
                                <div class="flex-grow-1">
                                    <div class="fw-bold mb-1">Username</div>
                                    <div class="text-light">Waktu</div>
                                </div>
                                <i class="fa-regular fa-bookmark fa-lg"></i>
                            </div>
                            {{-- Tambah postingan --}}
                            <div class="mb-3">
                                <textarea class="form-control" placeholder="Write a caption..." name="caption" id="caption" rows="3"></textarea>
                            </div>
                            <div class="mb-3 position-relative">
                                <input type="file" class="form-control d-none" id="image" name="image" accept="image/*">
                                
                                <div id="imagePreview" class="border border-secondary rounded" style="height: 200px; display: flex; justify-content: center; align-items: center;">
                                    <span class="text-light"><label for="image" class="form-label text-light fw-bold position-absolute" style="cursor: pointer; top: 50%; left: 50%; transform: translate(-50%, -50%);">Add Image</label></span>
                                </div>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-end">
                                        <button type="submit" class="btn btn-sm btn-info fw-bold" style="color: #fff;">Posting</button>
                                    </div>
                        </div>
                    </form>
                </div>
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
