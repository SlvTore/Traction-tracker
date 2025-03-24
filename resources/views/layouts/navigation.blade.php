<!-- Pastikan Bootstrap & Bootstrap Icons sudah dimuat -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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
    color: #6359E9 !important; /* Memindahkan teks ke tengah */
}

.navbar-nav .nav-item .nav-link:hover i {
    color: #6359E9 !important;
}

    .user-dropdown {
            background-color: #2d2654;
            color: white;
            border: none;
            padding: 7px 12px;
            border-radius: 0;
            width: 100%;
        }

        .user-dropdown:hover,
        .user-dropdown:focus {
            background-color: #352d65;
            color: white;
        }

        .user-avatar {
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #2d2654;
        }

        .user-info {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            line-height: 1.2;
        }

        .user-name {
            font-weight: 500;
            font-size: 16px;
        }

        .user-role {
            font-size: 14px;
            opacity: 0.8;
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
                            <i class="bi bi-grid-fill mx-2"></i>
                            {{ __('Dashboard') }}
                        </x-nav-link>
                    </li>
                    <li class="nav-item">
                        <x-nav-link :href="route('metrics')" :active="request()->routeIs('metrics')" class="nav-link text-white px-0">
                            <i class="bi bi-graph-up-arrow mx-2"></i>
                            {{ __('Metrics') }}
                        </x-nav-link>
                    </li>
                    <li class="nav-item">
                        <x-nav-link :href="route('user')" :active="request()->routeIs('user')" class="nav-link text-white px-0">
                            <i class="bi bi-people mx-2"></i>
                            {{ __('User') }}
                        </x-nav-link>
                    </li>
                    <li class="nav-item">
                        <x-nav-link :href="route('settings')" :active="request()->routeIs('settings')" class="nav-link text-white px-0">
                            <i class="bi bi-gear mx-2"></i>
                            {{ __('Settings') }}
                        </x-nav-link>
                    </li>

                     <!-- Garis Pemisah -->
                     <hr class="divider text-white">

                    <!-- Help Centre -->
                        <li class="nav-item">
                            <x-nav-link :href="route('helpIndex')" :active="request()->routeIs('helpIndex')" class="nav-link text-white px-0">
                                <i class="bi bi-question-circle mx-2"></i>
                                {{ __('Help Center') }}
                            </x-nav-link>
                        </li>
                </ul>
            </div>
        </div>

        <!-- Bottom Section (Logout Button) -->
       <!-- Bagian Logout yang diganti dengan Dropdown User -->
       <div class="mt-auto w-100">
        <div class="btn-group dropup w-100">
            <button class="user-dropdown dropdown-toggle d-flex align-items-center justify-content-between gap-3"
                    type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="d-flex align-items-center gap-3">
                    <div class="user-avatar">
                        <i class="bi bi-person-circle text-white fs-1"></i>
                    </div>
                    <div class="user-info">
                        <span class="user-name">{{ Auth::user()->name }}</span>
                        <span class="user-role">Admin</span>
                    </div>
                </div>
            </button>

            <ul class="dropdown-menu dropdown-menu-end w-100" aria-labelledby="userDropdown">
                <li><a class="dropdown-item" href="{{ route('profile.show') }}">
                    <i class="bi bi-person-circle me-2"></i> Profile</a>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger">
                            <i class="bi bi-box-arrow-right me-2"></i> Logout
                        </button>
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
