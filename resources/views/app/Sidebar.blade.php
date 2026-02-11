<div class="sidebar-brand">
    <a href="{{ route('dashboard') }}">SDN Juwetkenongo</a>
</div>
<div class="sidebar-brand sidebar-brand-sm">
    <a href="{{ route('dashboard') }}">SD</a>
</div>
<ul class="sidebar-menu">
    <li class="menu-header">Dashboard</li>
    <li class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('dashboard') }}"><i class="fas fa-home"></i>
            <span>Dashboard</span></a>
    </li>

    <li
        class="nav-item dropdown {{ request()->routeIs('fasilitas.*') || request()->routeIs('berita.*') || request()->routeIs('prestasi.*') || request()->routeIs('ekstrakurikuler.*') || request()->routeIs('struktur.*')  || request()->routeIs('hero.*') ? 'active' : ''}}">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
            <span>Informasi Sekolah</span></a>
        <ul class="dropdown-menu">
            <li class="{{ request()->routeIs('berita.*') ? 'active' : '' }}"><a class="nav-link"
                    href="{{ route('berita.index') }}">Berita</a>
            </li>
            <li class="{{ request()->routeIs('prestasi.*') ? 'active' : '' }}"><a class="nav-link"
                    href="{{ route('prestasi.index') }}">Prestasi</a>
            </li>
            <li class="{{ request()->routeIs('fasilitas.*') ? 'active' : '' }}"><a class="nav-link"
                    href="{{ route('fasilitas.index') }}">Fasilitas</a>
            </li>
            <li class="{{ request()->routeIs('ekstrakurikuler.*') ? 'active' : '' }}"><a class="nav-link"
                    href="{{ route('ekstrakurikuler.index') }}">Ekstrakurikuler</a>
            </li>
            <li class="{{ request()->routeIs('struktur.*') ? 'active' : '' }}"><a class="nav-link"
                    href="{{ route('struktur.index') }}">Struktur Organisasi</a>
            </li>
            <li class="{{ request()->routeIs('hero.*') ? 'active' : '' }}"><a class="nav-link"
                    href="{{ route('hero.index') }}">Background Hero</a>
            </li>
        </ul>
    </li>
    <li
        class="nav-item dropdown {{ request()->routeIs('acara.*') || request()->routeIs('pengumuman.*') ? 'active' : '' }}">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-calendar-days"></i>
            <span>Pengumuman</span></a>
        <ul class="dropdown-menu">
            <li class="{{ request()->routeIs('pengumuman.*') ? 'active' : '' }}"><a class="nav-link"
                    href="{{ route('pengumuman.index') }}">Pengumuman</a>
            </li>
            <li class="{{ request()->routeIs('acara.*') ? 'active' : '' }}"><a class="nav-link"
                    href="{{ route('acara.index') }}">Agenda</a>
            </li>
        </ul>
    </li>
    <li class="{{ request()->routeIs('user.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('user.index') }}">
            <i class="fas fa-user"></i>
            <span>User Akun</span></a>
    </li>

</ul>

{{-- <div class="mt-4 mb-4 p-3 hide-sidebar-mini"> --}}
{{--    <a href="https://getstisla.com/docs" class="btn btn-primary btn-lg btn-block btn-icon-split"> --}}
{{--        <i class="fas fa-rocket"></i> Documentation --}}
{{--    </a> --}}
{{-- </div> --}}
<script src="https://kit.fontawesome.com/d881b9b36f.js" crossorigin="anonymous"></script>
