<!-- Pastikan Bootstrap & Bootstrap Icons sudah dimuat -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
    /* Efek Hover Logout */
    .navbar {
        background-color: #282458;
    }
    /* Efek Hover pada Menu - Full Background + Text ke Tengah */
.navbar-nav .nav-item .nav-link {
    transition: background-color 0.3s ease-in-out, color 0.3s ease-in-out, text-align 0.3s ease-in-out;
    border-radius: 5px;
    display: flex;
    align-items: center;
    padding: 10px 15px;
    gap: 10px; /* Jarak antara ikon dan teks */
}

.navbar-nav .nav-item .nav-link:hover {
    background-color: #FBBC05 !important;
    color: #6359E9 !important;
    justify-content: center; /* Memindahkan teks ke tengah */
}

.navbar-nav .nav-item .nav-link:hover i {
    color: #6359E9 !important;
}

    .btn-logout {
        background-color: #ffffff;
        transition: all 0.3s ease-in-out;
        border: 2px solid rgb(243, 234, 234);
        position: relative;
        overflow: hidden;
    }

    .btn-logout:hover {
        background-color: rgb(93, 127, 207);
        color: white;
    }

    /* Efek Garis Bawah Animasi */
    .btn-logout span {
        position: relative;
        display: inline-block;
    }

    .btn-logout span::after {
        content: "";
        position: absolute;
        left: 0;
        bottom: -3px;
        width: 100%;
        height: 2px;
        background-color: white;
        transform: scaleX(0);
        transition: transform 0.3s ease-in-out;
    }

    .btn-logout:hover span::after {
        transform: scaleX(1);
    }

    /* Custom garis pemisah */
    .divider {
        width: 80%;
        height: 1.5px;
        background-color: #878080dd;
        border: none;
      
    }
</style>

<nav class="navbar navbar-expand-lg navbar-light h-100 shadow-sm">
    <div class="container-fluid d-flex flex-column h-100">
        <!-- Top Section (Logo & Nav Links) -->
        <div class="d-flex flex-column align-items-start w-100">
            <!-- Brand -->
            <a class="navbar-brand mb-4 ps-3" href="{{ route('dashboard') }}">
                <x-application-logo class="w-20 h-20" />
            </a>

            <!-- Navigation Items -->
            <div class="collapse navbar-collapse w-100" id="navbarNav">
                <ul class="navbar-nav flex-column w-100 gap-0 ps-3"> 
                    <li class="nav-item">
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="nav-link text-white px-0">
                            <i class="bi bi-grid-fill mr-2"></i>
                            {{ __('Dashboard') }}
                        </x-nav-link>
                    </li>
                    <li class="nav-item">
                        <x-nav-link :href="route('metrics')" :active="request()->routeIs('metrics')" class="nav-link text-white px-0">
                            <i class="bi bi-graph-up-arrow mr-2"></i>
                            {{ __('Metrics') }}
                        </x-nav-link>
                    </li>
                    <li class="nav-item">
                        <x-nav-link :href="route('data')" :active="request()->routeIs('data')" class="nav-link text-white px-0">
                            <i class="bi bi-file-earmark-bar-graph mr-2"></i>
                            {{ __('Data Feeds') }}
                        </x-nav-link>
                    </li>
                    <li class="nav-item">
                        <x-nav-link :href="route('user')" :active="request()->routeIs('user')" class="nav-link text-white px-0">
                            <i class="bi bi-people mr-2"></i>
                            {{ __('User') }}
                        </x-nav-link>
                    </li>
                    <li class="nav-item">
                        <x-nav-link :href="route('settings')" :active="request()->routeIs('settings')" class="nav-link text-white px-0">
                            <i class="bi bi-gear mr-2"></i>
                            {{ __('Settings') }}
                        </x-nav-link>
                    </li>

                     <!-- Garis Pemisah -->
                     <hr class="divider text-white">

                    <!-- Help Centre -->
                        <li class="nav-item">
                            <x-nav-link :href="route('help')" :active="request()->routeIs('help')" class="nav-link text-white px-0">
                                <i class="bi bi-question-circle mr-2"></i>
                                {{ __('Help Centre') }}
                            </x-nav-link>
                        </li>

                        <li class="nav-item">
                            <x-nav-link :href="route('notifications')" :active="request()->routeIs('notifications')" class="nav-link text-white px-0">
                                <i class="bi bi-bell mr-2"></i>
                                {{ __('Notifications') }}
                            </x-nav-link>
                        </li>
                </ul>
            </div>
        </div>

        <!-- Bottom Section (Logout Button) -->
       <!-- Bagian Logout yang diganti dengan Dropdown User -->
<div class="mt-auto w-100 text-center">
    <div class="btn-group dropup">
        <button class="btn btn-light dropdown-toggle w-100 d-flex align-items-center justify-content-center gap-2 py-2" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-person-circle"></i>
            <span class="fw-semibold">{{ Auth::user()->name }}</span>
        </button>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
            <li><a class="dropdown-item" href="{{ route('profile.show') }}"><i class="bi bi-person-circle me-2"></i> Profile</a></li>
            <li><hr class="dropdown-divider"></li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="dropdown-item text-danger"><i class="bi bi-box-arrow-right me-2"></i> Logout</button>
                </form>
            </li>
        </ul>
    </div>
</div>


        <!-- Hamburger -->
        <button class="navbar-toggler position-absolute top-0 end-0 mt-2 me-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
</nav>