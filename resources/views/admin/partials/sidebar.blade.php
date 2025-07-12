<style>
    .sidebar-custom {
        background-color: #6d4c41; /* Coklat tua */
        color: #ffffff;
        padding: 20px;
        height: 100%;
        min-height: 100vh;
        font-weight: 500;
    }

    .sidebar-custom h4 {
        color: #ffffff;
        font-weight: bold;
        margin-bottom: 25px;
    }

    .sidebar-custom .nav-link {
        color: #ffffff;
        padding: 12px 16px;
        border-radius: 8px;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        transition: background-color 0.2s ease-in-out;
    }

    .sidebar-custom .nav-link:hover,
    .sidebar-custom .nav-link.active {
        background-color: #8d6e63;
        color: #fff;
    }

    .sidebar-custom i {
        margin-right: 8px;
    }

    .sidebar-custom .btn-outline-danger {
        width: 100%;
        margin-top: 20px;
        border-radius: 8px;
        font-weight: bold;
        border: 1px solid #ffffff;
        color: #ffffff;
    }

    .sidebar-custom .btn-outline-danger:hover {
        background-color: #d32f2f;
        color: #fff;
        border-color: #d32f2f;
    }
</style>

<div class="sidebar-custom">
    <h4>CaPaw! 🐾</h4>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}" href="{{ url('/admin/dashboard') }}">
                <i class="fas fa-tachometer-alt"></i> Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/categories*') ? 'active' : '' }}" href="{{ route('categories.index') }}">
                <i class="fas fa-tags"></i> Kelola Kategori
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/locations*') ? 'active' : '' }}" href="{{ route('locations.index') }}">
                <i class="fas fa-map-marker-alt"></i> Kelola Lokasi
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/animals*') ? 'active' : '' }}" href="{{ route('animals.index') }}">
                <i class="fas fa-paw"></i> Data Hewan
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/reports*') ? 'active' : '' }}" href="{{ route('reports.index') }}">
                <i class="fas fa-file-alt"></i> Laporan Pengaduan
            </a>
        </li>
        <li class="nav-item mt-3">
            <form action="{{ route('logout') }}" method="POST" style="display:inline">
                @csrf
                <button type="submit" class="btn btn-outline-danger btn-sm">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </li>
    </ul>
</div>
