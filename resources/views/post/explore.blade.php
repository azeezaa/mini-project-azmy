@extends('layouts.master')

@section('title', 'Explore People')

@section('content')
<div class="d-flex">
    @include('layouts.sidebar')

    <div class="col" style="margin-left: 300px;">
        {{-- ini header --}}
        <div class="bg-black my-3 m-1 sticky-top">
            <div class="container-fluid">
                <div class="d-flex justify-content-center">
                    <img style="height:50px;" src="{{ asset('assets/logo-medsos.png') }}" alt="Logo Medsos">
                </div>
            </div>
        </div>
        
        {{-- ini konten --}}
        <div class="d-flex">
            <div class="col-md-7 m-1" style="height: 100vh; overflow-y: auto;">
                <div class="row justify-content-center align-items-center">
                    <div class="col-md-8 py-3">
                        <form action="{{ route('search') }}" method="GET" class="d-flex align-items-center gap-2">
                            <input type="text" name="query" class="form-control py-1 px-2 bg-transparent text-light rounded border" placeholder="Cari User">
                            <button type="submit" class="btn btn-primary bg-transparent border-0 p-0"><i class="fa-solid fa-lg fa-magnifying-glass light"></i></button>
                        </form>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        {{-- List hasil pencarian --}}
                        <div class="col-md-8 mx-auto" style="overflow-y: auto; height: calc(100vh - 50px);">
                            @if($isSearching)
                                <p class="fw-bold fs-5 py-2 m-0">Hasil Pencarianmu</p>
                                <div class="container">
                                    @if(count($result) > 0)
                                        @foreach($result as $searchedUser)
                                            <div class="mb-3">
                                                <div class="d-flex align-items-center">
                                                    <img src="{{ $searchedUser->profile_image ? asset($searchedUser->profile_image) : asset('assets/default_profile.png') }}" alt="User Avatar" class="rounded-circle me-3" style="width: 50px; height: 50px;">
                                                    <div class="flex-grow-1">
                                                        <div class="fw-bold mb-1">{{ $searchedUser->username }}</div>
                                                        <div class="text-light">{{ $searchedUser->fullname }}</div>
                                                    </div>
                                                    
                                                    <form action="{{ route('follow', $searchedUser->id) }}" method="POST">
                                                        @csrf
                                                        @if(auth()->user()->isFollowing($searchedUser))
                                                            <form action="{{ route('unfollow', $searchedUser->id) }}" method="POST">
                                                                @csrf
                                                                <button type="submit" style="text-decoration: none; border: none; border-radius: 5px; background-color: #fff; width: 80px; text-align: center;">Unfollow</button>
                                                            </form>
                                                        @else
                                                            <form action="{{ route('follow', $searchedUser->id) }}" method="POST">
                                                                @csrf
                                                                <button type="submit" style="color: #fff; text-decoration: none; background-color:transparent ; border-radius: 5px; width: 80px; text-align: center;">Follow</button>
                                                            </form>
                                                        @endif
                                                    </form>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <p class="text-light">Tidak ada hasil pencarian.</p>
                                    @endif
                                </div>
                            @else
                                <p class="text-light">Tidak ada pencarian.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5 m-1" style="position: sticky; top: 0; height: 100vh;">
                <div class="col-md-8 mx-auto" style="margin-top: 50px; overflow-y: auto; height: calc(100vh - 50px);">
                    <p class="fw-bold fs-5 p-0 m-0">Siapa yang Harus Diikuti</p>
                    <p class="text-secondary">Orang yang mungkin anda kenal</p>
                    <div class="container">
                        @if(count($users) > 0)
                            @foreach($users as $user)
                                <div class="mb-3">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset($user->profile_image) }}" alt="User Avatar" class="rounded-circle me-3" style="width: 50px; height: 50px;">
                                        <div class="flex-grow-1">
                                            <div class="fw-bold mb-1">{{ $user->username }}</div>
                                            <div class="text-light">{{ $user->fullname }}</div>
                                        </div>
                                        @auth
                                            @if(auth()->user()->id !== $user->id)
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
                                            @endif
                                        @else
                                        @endauth
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p>No users found.</p>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
