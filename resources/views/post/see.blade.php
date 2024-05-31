@extends('layouts.master')
@extends('layouts.sidebar')
@section('title', 'See Post')
@section('content')
<div class="col" style="margin-left: 300px;">
        {{-- Fixed header in the right section --}}
        <div class="bg-primary m-1 sticky-top">
            <div class="container-fluid">
                <div class="d-flex justify-content-center">
                    <img style="height:50px;" src="{{ asset('assets/logo-medsos.png') }}" alt="Logo Medsos">
                </div>
                <div class="gap-3 fw-semibold py-2" style="color: #fff;">
                    <a href="#" style="color: #fff; text-decoration: none;"><i class="fa-solid fa-angle-left fa-2xl"></i></a>
                    <a href="#" class="fw-bold fs-" style="color: #fff; text-decoration: none;">Back</a>
                </div>
            </div>
        </div>

        {{-- detail  --}}
        <div class="">
            <div class=" m-1 bg-success" style="height: 100vh; overflow-y: auto;">
                <div class="container-fluid py-5">
                    <div class="row justify-content-center">
                        <div class="col-md-10 bg-secondary">
                            {{-- Example posts --}}
                                <div class="row border p-4 bg-black rounded mb-3">
                                    <div class="col">
                                        <div class="mb-3">
                                        <div class="d-flex align-items-center">
                                            <img src="https://via.placeholder.com/150" alt="User Avatar" class="rounded-circle me-3" style="width: 50px; height: 50px;">
                                            <div class="flex-grow-1">
                                                <div class="fw-bold mb-1">Username</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Assumenda aliquam saepe, placeat asperiores quam odio impedit voluptas itaque blanditiis optio quo aliquid omnis modi sit atque minus! Mollitia, sint velit.
                                    </div>
                                    <a href="{{ route('seePost') }}">
                                                <img src="https://via.placeholder.com/800x800" class="card-img-top rounded" alt="Post Image" style="max-height: 400px;">
                                            </a>
                                    </div>
                                    <div class="col">
                                        <div class="shadow-sm mb-3">
                                            <h5 class="fw-bold">Komentar</h5>
                                            <p class="text-center py-3">Belum ada Komentar</p>
                                           <hr>
                                            <div class="row py-2">
                                                <div class="col-12 d-flex align-items-center justify-content-between gap-4">
                                                    <div class="d-flex align-items-center gap-2 mr-4">
                                                        <i class="fa-regular fa-heart fa-lg"></i>
                                                        <i class="fa-regular fa-comment fa-lg"></i>
                                                        <i class="fa-regular fa-paper-plane fa-lg"></i>

                                                    </div>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <i class="fa-regular fa-bookmark fa-lg"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="m-0 pt-3">0 Likes</p>
                                            <p class="m-0 p-0">waktu</p>
                                            <div class="d-flex pt-3">
                                                <div class="flex-grow-1">
                                                    <p class="me-2 py-1 border-bottom">Tambahkan Komentar</p>                                   
                                                </div>
                                                <a href="#" style="color: #fff; text-decoration: none;">kirim</a>
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