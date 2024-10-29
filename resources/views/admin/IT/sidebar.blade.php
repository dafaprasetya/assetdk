<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
        aria-expanded="true" aria-controls="collapseUtilities">
        <i class="fas fa-fw fa-wrench"></i>
        <span>IT PRIVILAGE</span>
    </a>
    <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Pengaturan: </h6>
            <a class="collapse-item" href="{{ route('kategorilist') }}">Kategori</a>
            <a class="collapse-item" href="{{ route('jabatanlist') }}">Jabatan</a>
            <a class="collapse-item" href="{{ route('divisilist') }}">Divisi</a>
            <a class="collapse-item" href="{{ route('userlist') }}">User</a>
        </div>
    </div>
</li>