<head>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<div id="sidebar" class="sidebar">
    <ul class="nav flex-column">
        <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link">
                <i class="bi bi-house-door"></i>
                <span class="nav-text">Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="bi bi-bar-chart"></i>
                <span class="nav-text">Analytics</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="bi bi-gear"></i>
                <span class="nav-text">Settings</span>
            </a>
        </li>
    </ul>
</div>

<style>
    .sidebar {
        width: 60px;
        height: 100vh;
        background: #343a40;
        transition: width 0.3s ease-in-out;
        position: fixed;
        top: 0;
        left: 0;
        overflow: hidden;
        padding-top: 20px;
        z-index: 1000; /* Supaya sidebar selalu di atas */
    }

    .sidebar:hover {
        width: 200px;
    }

    .nav-link {
        color: white;
        display: flex;
        align-items: center;
        padding: 10px;
        white-space: nowrap;
        text-decoration: none;
    }

    .nav-link i {
        font-size: 24px;
        margin-right: 10px;
    }

    .nav-text {
        display: none;
    }

    .sidebar:hover .nav-text {
        display: inline;
    }
</style>
