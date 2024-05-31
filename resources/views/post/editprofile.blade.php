@extends('layouts.master')
@section('title', 'Edit Profile')

@section('content')

<div class="d-flex">
    @extends('layouts.sidebar')

    <div class="col" style="margin-left: 300px;">
        
        {{-- Main content area --}}
        <div>
            <div class="row m-1 bg-success gap-1 p-4">
                <div class="col-md-6 mx-auto m-1 row border bg-black rounded p-3">
                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row align-items-center d-flex my-2" style="cursor: pointer;">
                            <div class="mx-auto text-center">
                                <input type="file" id="profile_image_input" name="profile_image" style="display: none;">
                                <label for="profile_image_input">
                                    <img src="{{ asset(Auth::user()->profile_image) }}" id="profile_image_preview" alt="User Avatar" class="rounded-circle mx-auto" style="width: 100px; height: 100px;">
                                </label>
                            </div>
                        </div>
                        <p class="text-center">Edit Profile</p>
                        <div class="row align-items-center mb-3">
                            <div class="col-md-3">
                                <label for="username" class="form-label text-white fw-bold">Username</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" placeholder="Masukkan Username" class="rounded-3 form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ Auth::user()->username }}" required>
                            </div>
                        </div>
                        <div class="row align-items-center mb-3">
                            <div class="col-md-3">
                                <label for="fullname" class="form-label text-white fw-bold">Nama Lengkap</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" placeholder="Masukkan Nama Lengkap" class="rounded-3 form-control @error('fullname') is-invalid @enderror" id="fullname" name="fullname" value="{{ Auth::user()->fullname }}" required>
                            </div>
                        </div>
                        <div class="row align-items-center mb-3">
                            <div class="col-md-3">
                                <label for="bio" class="form-label text-white fw-bold">Bio</label>
                            </div>
                            <div class="col-md-9">
                                <textarea placeholder="Masukkan Bio" class="rounded-3 form-control @error('bio') is-invalid @enderror" id="bio" name="bio" rows="3">{{ Auth::user()->bio }}</textarea>
                            </div>
                        </div>
                        <div class="pt-3 pe-5 d-flex justify-content-end">
                            <button type="submit" class="px-3 btn btn-sm btn-info fw-bold" style="color: #fff;">Edit</button>
                        </div>
                    </form>
                </div>

            </div>

        </div>
    </div>

</div>

<script>
    // Fungsi untuk menampilkan gambar profil yang dipilih oleh pengguna
    function showPreview(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#profile_image_preview').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    // Memanggil fungsi showPreview saat input file diubah
    $("#profile_image_input").change(function(){
        showPreview(this);
    });
</script>

@endsection
