{{-- Sidebar --}}
<div class="m-1 bg-secondary h-auto position-fixed" style="width: 300px; height: 100vh; overflow-y: auto;">
    <div class="py-4">
        <div class="mb-3">
            <div class="d-flex align-items-center">
                @if (Auth::check())
                    <a href="{{ route('profile', Auth::user()->id) }}" class="d-flex align-items-center text-decoration-none" style="color: inherit;">
                        <img src="{{ asset(Auth::user()->profile_image) }}" alt="User Avatar" class="rounded-circle mx-3" style="width: 50px; height: 50px;">
                        <div class="flex-grow-1">
                            <div class="fw-bold mb-1">{{ Auth::user()->username }}</div>
                            <div class="text-light">{{ Auth::user()->fullname }}</div>
                        </div>
                    </a>
                @else
                    <img src="{{ asset('assets/logo-medsos.png') }}" alt="User Avatar" class="me-3" style="width: 50px; height: 50px;">
                    <div class="flex-grow-1">
                        <div class="fw-bold mb-1">Silakan login dahulu</div>
                        <div class="text-light">Ayo login</div>
                    </div>
                @endif

            </div>
        </div>
    </div>
    <ul class="nav flex-column px-3">
        <li class="nav-item d-flex align-items-center">
            <i class="fa-solid fa-lg pe-2 fa-house" style="color: #4CC2D0;"></i>
            <a class="nav-link text-light" href="{{ route('beranda') }}">Beranda</a>
        </li>
        <li class="nav-item d-flex align-items-center">
            <i class="fa-solid fa-lg pe-2 fa-magnifying-glass" style="color: #4CC2D0;"></i>
            <a class="nav-link text-light" href="{{ route('explore') }}">Explore</a>
        </li>
        <li class="nav-item d-flex align-items-center">
            <i class="fa-solid fa-lg pe-2 fa-bell" style="color: #4CC2D0;"></i>
            <a class="nav-link text-light" href="#">Notifikasi</a>
        </li>
        <li class="nav-item d-flex align-items-center">
            <i class="fa-solid fa-lg pe-2 fa-plus" style="color: #4CC2D0;"></i>
            <a class="nav-link text-light" href="{{ route('formPost') }}">Posting</a>
        </li>
        <li class="nav-item d-flex align-items-center">
            <i class="fa-solid fa-lg pe-2 fa-bookmark" style="color: #4CC2D0;"></i>
            <a class="nav-link text-light" href="{{ route('bookmark') }}">Bookmark</a>
        </li>
        
        @if (Auth::check())
            <li class="nav-item d-flex align-items-center">
                <i class="fa-solid fa-lg pe-2 fa-arrow-left" style="color: #4CC2D0;"></i>
                <a class="nav-link text-light" href="{{ route('logout') }}">Logout</a>
            </li>
        @else
            <li class="nav-item d-flex align-items-center">
                <i class="fa-solid fa-lg pe-2 fa-arrow-left" style="color: #4CC2D0;"></i>
                <a class="nav-link text-light" href="{{ route('login') }}">Login</a>
            </li>
        @endif
    </ul>
</div>
{{-- End sidebar --}}
