@extends('layouts.master')

@section('title', 'Notifikasi')

@section('content')
<div class="d-flex">
    @include('layouts.sidebar')

    <div class="col" style="margin-left: 300px;">
        {{-- Ini header --}}
        <div class="m-1 sticky-top">
            <div class="container-fluid">
                <div class="d-flex justify-content-center">
                    <h4 class="fw-bold py-3">Notifikasi</h4>
                </div>
                <div class="d-flex justify-content-center gap-3 fw-semibold py-2" style="color: #fff;">
                    <a href="{{ route('notifications.index') }}" style="color: {{ request()->routeIs('notifications.index') ? '#4CC2D0' : '#888' }}; text-decoration: none;">Semua</a>
                    <a href="{{ route('notifications.comments') }}" style="color: {{ request()->routeIs('notifications.comments') ? '#4CC2D0' : '#888' }}; text-decoration: none;">Komentar</a>
                    <a href="{{ route('notifications.likes') }}" style="color: {{ request()->routeIs('notifications.likes') ? '#4CC2D0' : '#888' }}; text-decoration: none;">Disukai</a>
                </div>
            </div>
        </div>
        
        {{-- ini konten --}}
        <div class="col-md-8 mx-auto">
            <h5 class="fw-bold">
                @if (request()->routeIs('notifications.index'))
                    Semua Notifikasi
                @elseif (request()->routeIs('notifications.comments'))
                    Komentar
                @elseif (request()->routeIs('notifications.likes'))
                    Disukai
                @endif
            </h5>
            @if ($notifications->isEmpty())
                <p>Tidak ada notifikasi saat ini.</p>
            @else
                @foreach ($notifications as $notification)
                    <div class="d-flex justify-content-start gap-2">
                        <img src="{{ asset($notification->user->profile_image) }}" alt="user Avatar" class="rounded-circle" style="width: 30px; height: 30px;">
                        <div class="fw-bold mb-1">{{ $notification->user->username }}</div>
                        <p>{{ $notification->message }}</p>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
@endsection
