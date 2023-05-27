<!-- Menu -->
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
<div class="app-brand demo">
	<a class="navbar-brand" href="/"><img src="{{ asset('user/assets/img/logo.svg')}}" height="40" alt="logo" /></a>
	<a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none"><i class="bx bx-chevron-left bx-sm align-middle"></i></a>
</div>
<div class="menu-inner-shadow"></div>
<ul class="menu-inner py-1">
	<!-- Dashboard -->
	<li class="menu-item {{ (request()->is('admin/dashboard*')) ? 'active' : '' }}">
		<a href="/admin/dashboard" class="menu-link">
		<i class="menu-icon tf-icons bx bx-home-circle"></i>
		<div data-i18n="Analytics">Dashboard</div>
		</a>
	</li>
	<!-- Components -->
	<li class="menu-header small text-uppercase">
		<span class="menu-header-text">Master</span>
	</li>
	<!-- Cards -->
	<li class="menu-item {{ (request()->is('admin/penduduk*')) ? 'active' : '' }}">
		<a href="/admin/penduduk" class="menu-link">
		<i class="menu-icon tf-icons bx bx-user"></i>
		<div data-i18n="Basic">Penduduk</div>
		</a>
	</li>
	<li class="menu-item {{ (request()->is('admin/jenis-dokumen*')) ? 'active' : '' }}">
		<a href="/admin/jenis-dokumen" class="menu-link">
		<i class="menu-icon tf-icons bx bx-file"></i>
		<div data-i18n="Basic">Jenis Dokumen</div>
		</a>
	</li>
	<li class="menu-item {{ (request()->is('admin/syarat-pengajuan*')) ? 'active' : '' }}">
		<a href="/admin/syarat-pengajuan" class="menu-link">
		<i class="menu-icon tf-icons bx bx-category-alt"></i>
		<div data-i18n="Basic">Syarat Pengajuan</div>
		</a>
	</li>
	<!-- Components -->
	<li class="menu-header small text-uppercase">
		<span class="menu-header-text">Pengajuan</span>
	</li>
	<!-- Cards -->
	<li class="menu-item {{ (request()->is('admin/kelola-dokumen*')) ? 'active' : '' }}">
		<a href="/admin/kelola-dokumen" class="menu-link">
		<i class="menu-icon tf-icons bx bx-folder"></i>
		<div data-i18n="Basic">Kelola Dokumen</div>
		</a>
	</li>
</ul>
</aside>
<!-- / Menu -->