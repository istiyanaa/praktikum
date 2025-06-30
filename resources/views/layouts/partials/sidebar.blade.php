<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link text-center">
        <span class="brand-text fw-bold text-light">📁 Arsip Kepegawaian</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar mt-2">
        <!-- Sidebar Menu -->
        <nav>
            <ul class="nav nav-pills nav-sidebar flex-column text-sm fw-semibold" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Pegawai -->
                <li class="nav-item">
                    <a href="{{ route('pegawai') }}" class="nav-link {{ request()->routeIs('pegawai') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Pegawai</p>
                    </a>
                </li>
                <!-- Kategori Arsip -->
                <li class="nav-item">
                    <a href="{{ route('kategori-arsip') }}" class="nav-link {{ request()->routeIs('kategori-arsip') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-folder-open"></i>
                        <p>Kategori Arsip</p>
                    </a>
                </li>
                <!-- Surat -->
                <li class="nav-item">
                    <a href="{{ route('surat') }}" class="nav-link {{ request()->routeIs('surat') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-envelope"></i>
                        <p>Surat</p>
                    </a>
                </li>
                <!-- Dokumen -->
                <li class="nav-item">
                    <a href="{{ route('dokumen') }}" class="nav-link {{ request()->routeIs('dokumen') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-file-alt"></i>
                        <p>Dokumen</p>
                    </a>
                </li>
                <!-- SK Mengajar -->
                <li class="nav-item">
                    <a href="{{ route('skmengajar') }}" class="nav-link {{ request()->routeIs('skmengajar') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-file-signature"></i>
                        <p>SK Mengajar</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
