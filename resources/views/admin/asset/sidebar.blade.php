
    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ Route::is('home') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('home') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ Route::is('homedkl') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('homedkl') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard Asset Lancar</span></a>
    </li>
    <!-- Heading -->
    <div class="sidebar-heading">
        Asset
    </div>

    <!-- Nav Item - Add -->
    <li class="nav-item {{ Route::is('listasset') ? 'active' : '' }}">
        <a class="nav-link" href="{{route('listasset')}}">
            <i class="fas fa-fw fa-table"></i>
            <span>List Asset</span></a>
    </li>
    <li class="nav-item {{ Route::is('listassetdkl') ? 'active' : '' }}">
        <a class="nav-link" href="{{route('listassetdkl')}}">
            <i class="fas fa-fw fa-table"></i>
            <span>List Asset DKL</span></a>
    </li>
    <!-- Nav Item - Add -->
    <li class="nav-item {{ Route::is('tambahasset') ? 'active' : '' }}">
        <a class="nav-link" href="{{route('tambahasset')}}">
            <i class="fas fa-fw fa-table"></i>
            <span>Tambah Asset</span></a>
    </li>
    <!-- Heading -->
    <div class="sidebar-heading">
        Serah Terima
    </div>

    <!-- Nav Item - Add -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('buatserahterima') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Lakukan Serah Terima</span></a>
    </li>
    <!-- Nav Item - Add -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('serahterima') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>List Serah Terima</span></a>
    </li>