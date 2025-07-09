{{-- resources/views/admin/partials/sidebar.blade.php --}}
<h4>Admin Menu</h4>
<ul class="nav flex-column">
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/admin/dashboard') }}">Dashboard</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('categories.index') }}">Kelola Kategori</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('locations.index') }}">Kelola Lokasi</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('animals.index') }}">Data Hewan</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('reports.index') }}">Laporan Pengaduan</a>
    </li>
    <li class="nav-item mt-3">
        <form action="{{ route('logout') }}" method="POST" style="display:inline">
            @csrf
            <button type="submit" class="btn btn-outline-danger btn-sm">Logout</button>
        </form>
    </li>
</ul>