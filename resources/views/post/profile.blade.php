@extends('layouts.master')
@section('title', 'My Profile')

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
            <div class="row m-1 bg-success gap-1 p-4">
                <div class="col-md-10 mx-auto m-1 row border bg-black rounded">
                    <div class="d-flex justify-content-between  p-3 w-100">
                        <div class="d-flex align-items-center">
                            <img src="{{ asset(Auth::user()->profile_image) }}" alt="User Avatar" class="rounded-circle me-4" style="width: 100px; height: 100px;">
                            <div class="flex-grow-1">
                                <div class="fw-bold mb-1 fs-4">{{ Auth::user()->username }}</div>
                                <div class="d-flex small gap-3 py-2" style="color: #fff;">
                                    {{-- jumlah postingan --}}
                                    <a href="#" style="color: #fff; text-decoration: none;">0 Posts</a>
                                    {{-- jumlah followers --}}
                                    <a href="#" style="color: #fff; text-decoration: none;">{{ auth()->user()->following->count() }} Following</a>
                                    {{-- jumlah following --}}
                                    <a href="#" style="color: #fff; text-decoration: none;">{{ auth()->user()->followers->count() }} Followers</a>
                                </div>
                                <div class="fw-bold mb-1 small">{{ Auth::user()->fullname }}</div>
                                <div class=" mb-1 small">{{ Auth::user()->bio }}</div>
                            </div>
                        </div>
                        <div class="pt-3">
                            <a class="text-decoration-none" style="color: inherit;" href="{{ route('editprofile') }}"><i class="fa-solid fa-gear fa-lg"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-10 mx-auto m-1 row border bg-black rounded">
                    <div class="d-flex justify-content-center align-items-center" style="height: 200px;">
                        <span>Belum ada postingan </span>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

