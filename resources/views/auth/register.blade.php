@extends('layouts.master')
@section('title', 'Register Page')

@section('content')
    <div class="container" style="height: 100px"></div>
    <div class="mx-lg-5  mb-lg-3">        
        <div class="grid mx-3">
            <div class="row row-gap-4 justify-content-center">
                <div class="card bg-transparent w-75" style="height: auto; padding: 20px;">
                    <h3 class="fw-bold text-white text-center">Register</h3>
                    <div class="row align-items-start">
                        <div class="col-4 d-flex justify-content-center align-items-center">
                            <div>
                                <img style="height:200px; margin-top:80px;" src="{{ asset('assets/logo-medsos.png') }}" alt="Logo Medsos">
                            </div>
                        </div>

                        <div class="col-8">
                            <div class="card-body">
                                <form action="{{ route('register.store') }}" method="POST">
                                    @csrf
                                    <div class="row mb-3">
                                        <div class="col">
                                            <label for="username" class="form-label text-white fw-bold">Username</label>
                                            <input type="text" placeholder="Masukkan Username" class="rounded-3 form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username') }}" required>
                                            @error('username')
                                                <div class="text-danger mt-2 text-sm">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col">
                                            <label for="fullname" class="form-label text-white fw-bold">Nama Lengkap</label>
                                            <input type="text" placeholder="Masukkan Nama Lengkap" class="rounded-3 form-control @error('fullname') is-invalid @enderror" id="fullname" name="fullname" value="{{ old('fullname') }}" required>
                                            @error('fullname')
                                                <div class="text-danger mt-2 text-sm">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="email" class="form-label text-white fw-bold">E - Mail</label>
                                        <input type="email" placeholder="Masukkan Akun Email" class="rounded-3 form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                                        @error('email')
                                            <div class="text-danger mt-2 text-sm">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label text-white fw-bold">Password</label>
                                        <input type="password" placeholder="Masukkan Password" class="rounded-3 form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                                        @error('password')
                                            <div class="text-danger mt-2 text-sm">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="password_confirmation" class="form-label text-white fw-bold">Konfirmasi Password</label>
                                        <input type="password" placeholder="Masukkan Konfirmasi Password" class="rounded-3 form-control" id="password_confirmation" name="password_confirmation" required>
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <button type="submit" class="btn btn-light fw-bold mt-3">Register</button>
                                    </div>                                    

                                    <div class="mb-3 text-center">
                                        <label class="text-white form-label">
                                            Sudah punya akun? <span class="fw-bold"><a href="{{ route('login') }}" style="color: white;">Login</a></span>
                                        </label>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
