@extends('layouts.master')
@section('title', 'Login Page')

@section('content')
    <div class="container" style="height: 100px"></div>
    <div class="mx-lg-5 mt-lg-5 mb-lg-3">        
        <div class="grid mx-3 mt-4">
            <div class="row row-gap-4 justify-content-center">
                <div class="card bg-transparent w-75" style="height: auto; padding: 20px;">
                    <h3 class="fw-bold text-white text-center">Login</h3>
                    <div class="row align-items-start">
                        <div class="col-4 d-flex justify-content-center align-items-center">
                            <div>
                                <img style="height:200px;" src="{{ asset('assets/logo-medsos.png') }}" alt="Logo Medsos">
                            </div>
                        </div>

                        <div class="col-8">
                            <div class="card-body">
                                <form action="{{ route('login.authenticate') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="username" class="form-label text-white fw-bold">Username</label>
                                        <input type="text" placeholder="Masukkan Username" class="rounded-3 form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username') }}" required>
                                        @error('username')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="password" class="form-label text-white fw-bold">Password</label>
                                        <input type="password" placeholder="Masukkan Password" class="rounded-3 form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                                        @error('password')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="d-flex justify-content-end">
                                        <button type="submit" class="btn btn-light fw-bold">Login</button>
                                    </div>                                    

                                    <div class="mb-3 text-center">
                                        <label class="text-white form-label">
                                            Belum punya akun? <span class="fw-bold"><a href="{{ route('register') }}" style="color: white;">Daftar Sekarang</a></span>
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
