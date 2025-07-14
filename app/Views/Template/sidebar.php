<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('/'); ?>">
        <div class="sidebar-brand-icon">
            <img src="<?= base_url('Assets/logo_pemalang.png'); ?>" width="50" height="50" alt="">
        </div>
        <div class="sidebar-brand-text mx-3">Balai Desa Pabuaran</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?= ($menu_active == 'dashboard') ? 'active' : ''; ?>">
        <a class="nav-link" href="<?= base_url('/'); ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Master Data
    </div>

    <li class="nav-item <?= ($menu_active == 'Data_desa') ? 'active' : ''; ?>">
        <a class="nav-link" href="<?= base_url('Data_desa'); ?>">
            <i class="fas fa-fw fa-building"></i>
            <span>Profile Desa</span></a>
    </li>
    <li class="nav-item <?= ($menu_active == 'Persyaratan') ? 'active' : ''; ?>">
        <a class="nav-link" href="<?= base_url('Persyaratan'); ?>">
            <i class="fas fa-fw fa-list"></i>
            <span>Persyaratan</span></a>
    </li>
    <li class="nav-item <?= ($menu_active == 'jenis_surat') ? 'active' : ''; ?>">
        <a class="nav-link" href="<?= base_url('Jenis_surat'); ?>">
            <i class=" fas fa-fw fa-book"></i>
            <span>Jenis Surat</span></a>
    </li>
    <li class="nav-item <?= ($menu_active == 'Keluarga') ? 'active' : ''; ?>">
        <a class="nav-link" href="<?= base_url('Keluarga'); ?>">
            <i class=" fas fa-fw fa-users"></i>
            <span>Keluarga</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Admin
    </div>

    <li class="nav-item <?= ($menu_active == 'Pengajuan') ? 'active' : ''; ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true"
            aria-controls="collapsePages">
            <i class="fas fa-fw fa-envelope"></i>
            <span>Surat</span>
        </a>
        <div id="collapsePages" class="collapse <?= ($menu_active == 'Pengajuan') ? 'show' : ''; ?>"
            aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Data Surat</h6>
                <a class="collapse-item <?= ($menu_active == 'Pengajuan') ? 'active' : ''; ?>"
                    href="<?= base_url('Pengajuan'); ?>">Pengajuan</a>
            </div>
        </div>
    </li>

    <li class="nav-item <?= ($menu_active == 'Users') ? 'active' : ''; ?>">
        <a class="nav-link collapsed " href="#" data-toggle="collapse" data-target="#uersMenu" aria-expanded="true"
            aria-controls="uersMenu">
            <i class="fas fa-fw fa-user"></i>
            <span>Users</span>
        </a>
        <div id="uersMenu" class="collapse <?= ($menu_active == 'Users') ? 'show' : ''; ?>"
            aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Data User</h6>
                <a class="collapse-item <?= ($menu_active == 'Users') ? 'active' : ''; ?>"
                    href="<?= base_url('Users'); ?>">User</a>
            </div>
        </div>
    </li>
    <li class="nav-item <?= ($menu_active == 'Laporan') ? 'active' : ''; ?>">
        <a class="nav-link" href="<?= base_url('Laporan'); ?>">
            <i class=" fas fa-fw fa-chart-area"></i>
            <span>Laporan</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>