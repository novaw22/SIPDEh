<!-- Menu -->
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a class="navbar-brand" href="/"><img src="{{ asset('user/assets/img/logo.svg')}}" height="40" alt="logo" /></a>
        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none"><i class="bx bx-chevron-left bx-sm align-middle"></i></a>
    </div>
    <div class="menu-inner-shadow"></div>
    <ul class="menu-inner py-1 mt-3">
        <!-- Dashboard -->
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Dashboard</span>
        </li>
        <li class="menu-item {{ (request()->is('admin/dashboard*')) ? 'active' : '' }}">
            <a href="{{ route('admin.dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>
        <li class="menu-item {{ (request()->is('admin/profile*')) ? 'active' : '' }}">
            <a href="{{ route('admin.profile') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div data-i18n="Analytics">Profile</div>
            </a>
        </li>
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Master</span>
        </li>
        <li class="menu-item {{ (request()->is('admin/documents*')) ? 'active' : '' }}">
            <a href="{{ route('admin.documents.index') }}" class="menu-link">
                <i class='menu-icon tf-icons bx bx-file'></i>
                <div data-i18n="Analytics">Jenis Dokumen</div>
            </a>
        </li>
        <li class="menu-item {{ (request()->is('admin/users*')) ? 'active' : '' }}">
            <a href="{{ route('admin.users.index') }}" class="menu-link">
                <i class='menu-icon tf-icons bx bx-group'></i>
                <div data-i18n="Analytics">User</div>
            </a>
        </li>
        <li class="menu-item {{ (request()->is('admin/civilians*')) ? 'active' : '' }}">
            <a href="{{ route('admin.civilians.index') }}" class="menu-link">
                <i class='menu-icon tf-icons bx bx-face' ></i>
                <div data-i18n="Analytics">Penduduk</div>
            </a>
        </li>
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Pengajuan</span>
        </li>
        <li class="menu-item {{ (request()->is('admin/submissions*')) ? 'active' : '' }}">
            <a href="{{ route('admin.submissions.index') }}" class="menu-link">
                <i class='menu-icon tf-icons bx bx-edit-alt'></i>
                <div data-i18n="Analytics">Pengajuan</div>
            </a>
        </li>
        {{-- <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Template</span>
        </li>
        <li class="menu-item {{ (request()->is('admin/profile*')) ? 'active' : '' }}">
            <a href="{{ route('admin.profile') }}" class="menu-link">
                <i class='menu-icon tf-icons bx bxl-blogger'></i>
                <div data-i18n="Analytics">Template Surat</div>
            </a>
        </li> --}}
    </ul>
</aside>
<!-- / Menu -->
