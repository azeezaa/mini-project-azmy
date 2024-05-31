@extends('layouts.master')
@section('title', 'Explore People')
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
                
            </div>
        </div>
        
        {{-- Main content area --}}
        <div class="d-flex">
            <div class="col-md-7 m-1 bg-success" style="height: 100vh; overflow-y: auto;">
                <div class="row justify-content-center align-items-center">
                    <div class="col-md-8 py-3">
                        <div class="d-flex align-items-center gap-2">
                            <input type="text" class="form-control py-1 px-2 bg-black rounded border" placeholder="Cari User">
                            <a href="#" class="text-white"><i class="fas fa-search fa-lg"></i></a>
                        </div>
                    </div>
                </div>
                <div class="container-fluid ">
                    <div class="row justify-content-center ">
                            {{-- List hasil pencarian --}}
                            <div class="col-md-8 border mx-auto bg-danger" style=" overflow-y: auto; height: calc(100vh - 50px);">
                                <p class="fw-bold fs-5 py-2 m-0">Hasil Pencarianmu</p>
                                <div class="container">
                                    <div class="mb-3">
                                        <div class="d-flex align-items-center">
                                            <img src="https://via.placeholder.com/150" alt="User Avatar" class="rounded-circle me-3" style="width: 50px; height: 50px;">
                                            <div class="flex-grow-1">
                                                <div class="fw-bold mb-1">Loremm</div>
                                                <div class="text-light">Lorem ipsum</div>
                                            </div>
                                            <a href="#" class="fw-bold" style="color: #4CC2D0; text-decoration: none;">Follow</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Tambahkan elemen lainnya jika diperlukan -->
                            </div>

                    </div>
                </div>
            </div>
            <div class="col-md-5 m-1 bg-warning" style="position: sticky; top: 0; height: 100vh;">
                <div class="col-md-8 border mx-auto" style="margin-top: 50px; overflow-y: auto; height: calc(100vh - 50px);">
                    <p class="fw-bold fs-5 p-0 m-0">Siapa yang Harus Diikuti</p>
                    <p class="text-secondary">Orang yang mungkin anda kenal</p>
                    <div class="container">
                        <div class="mb-3">
                            <div class="d-flex align-items-center">
                                <img src="https://via.placeholder.com/150" alt="User Avatar" class="rounded-circle me-3" style="width: 50px; height: 50px;">
                                <div class="flex-grow-1">
                                    <div class="fw-bold mb-1">Loremm</div>
                                    <div class="text-light">Lorem ipsum</div>
                                </div>
                                <a href="#" class="fw-bold" style="color: #4CC2D0; text-decoration: none;">Follow</a>
                            </div>
                        </div>
                    </div>
                    <!-- Tambahkan elemen lainnya jika diperlukan -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection