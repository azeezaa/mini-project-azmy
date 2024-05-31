@extends('layouts.master')

@section('title', 'Beranda')

@section('content')

<div class="d-flex">
    @include('layouts.sidebar')

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
        <div class="d-flex">
            <div class="col-md-7 m-1 bg-success" style="height: 100vh; overflow-y: auto;">
                <!-- Content here -->
            </div>
            <div class="col-md-5 m-1 bg-warning" style="position: sticky; top: 0; height: 100vh;">
                <div class="col-md-8 border mx-auto" style="margin-top: 50px; overflow-y: auto; height: calc(100vh - 50px);">
                    <p class="fw-bold fs-5 p-0 m-0">Daftar Pengguna</p>
                    <p class="text-secondary">Semua Pengguna yang Terdaftar</p>

                    <div class="container">
                        @if($users->count() > 0)
                            @foreach($users as $user)
                                @if(auth()->check() && auth()->user()->id !== $user->id)
                                    <div class="mb-3">
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset($user->profile_image) }}" alt="User Avatar" class="rounded-circle me-3" style="width: 50px; height: 50px;">
                                            <div class="flex-grow-1">
                                                <div class="fw-bold mb-1">{{ $user->username }}</div>
                                                <div class="text-light">{{ $user->fullname }}</div>
                                            </div>
                                            @if(auth()->user()->following && auth()->user()->following->contains($user->id))
                                                <span>Following</span>
                                            @else
                                                <form action="{{ route('follow', $user->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" style="color: #fff; text-decoration: none; background: none; border: none;">Follow</button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @endif
                    </div>


                    <hr>

                    <p class="mx-3">Terms of Service Privacy Policy Cookie Policy Accessibility Ads info More © 2024 Sosmed</p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
