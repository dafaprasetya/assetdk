<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        
        <div class="sidebar-brand-text mx-3">DKRIUK ASSET <sup>Humas&Service</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Divider -->
    <hr class="sidebar-divider">
    @include('admin.asset.sidebar')
    @if (Auth::user()->divisi === 'IT')
        <hr class="sidebar-divider d-none d-md-block">
            
        @include('admin.IT.sidebar')
    @endif
    <!-- Divider -->
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
<!-- End of Sidebar -->
