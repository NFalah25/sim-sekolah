{{-- header --}}
{{--<header class="">--}}
{{--    <div class="w-full fixed top-0 left-0 right-0 bg-white shadow-md z-50">--}}
{{--        <div class="flex items-center justify-between py-4 md:px-16 px-4">--}}
{{--            <div class="md:text-2xl text-md font-bold text-gray-800">--}}
{{--                <img src="{{ asset('images/LOGO SEKOLAH.jpeg') }}" alt="Logo Sekolah" class="fixed h-12 w-12 -mt-2">--}}
{{--                <a href="{{ url('/') }}" class="ms-16">SD Negeri JuwetKenongo</a>--}}
{{--            </div>--}}
{{--            <nav>--}}
{{--                <ul class="hidden space-x-4 md:flex">--}}
{{--                    <li><a href="{{ url('/') }}" class="text-gray-600 hover:text-gray-800 font-bold">BERANDA</a></li>--}}

{{--                    <li class="relative group">--}}
{{--                        <a href="#" class="text-gray-600 hover:text-gray-800 flex items-center font-bold">--}}
{{--                            PROFIL SEKOLAH--}}
{{--                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"--}}
{{--                                stroke="currentColor"--}}
{{--                                class="size-4 inline-block ms-1 transition-transform duration-300 ease-in-out group-hover:rotate-180">--}}
{{--                                <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />--}}
{{--                            </svg>--}}

{{--                        </a>--}}

{{--                        <ul--}}
{{--                            class="absolute bg-gray-100 shadow-md mt-2 p-2 space-y-2 w-48--}}
{{--                                   opacity-0 invisible group-hover:opacity-100 group-hover:visible--}}
{{--                                   transform -translate-y-2 group-hover:translate-y-0--}}
{{--                                   transition-all duration-300 ease-in-out rounded-lg">--}}
{{--                            <li><a href="#" class="block px-2 py-1 text-gray-600 hover:text-gray-800">Sejarah</a>--}}
{{--                            </li>--}}
{{--                            <li><a href="#" class="block px-2 py-1 text-gray-600 hover:text-gray-800">Visi &--}}
{{--                                    Misi</a></li>--}}
{{--                            <li><a href="#" class="block px-2 py-1 text-gray-600 hover:text-gray-800">Struktur--}}
{{--                                    Organisasi</a></li>--}}
{{--                            <li><a href="#"--}}
{{--                                    class="block px-2 py-1 text-gray-600 hover:text-gray-800">Fasilitas</a></li>--}}
{{--                        </ul>--}}
{{--                    </li>--}}

{{--                    <li class="relative group">--}}
{{--                        <a href="#" class="text-gray-600 hover:text-gray-800 flex items-center font-bold">BERITA--}}
{{--                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"--}}
{{--                                stroke="currentColor"--}}
{{--                                class="size-4 inline-block ms-1 transition-transform duration-300 ease-in-out group-hover:rotate-180">--}}
{{--                                <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />--}}
{{--                            </svg>--}}
{{--                        </a>--}}

{{--                        <ul--}}
{{--                            class="absolute bg-gray-100 shadow-md mt-2 p-2 space-y-2 w-48--}}
{{--                                   opacity-0 invisible group-hover:opacity-100 group-hover:visible--}}
{{--                                   transform -translate-y-2 group-hover:translate-y-0--}}
{{--                                   transition-all duration-300 ease-in-out rounded-lg">--}}
{{--                            <li><a href="#" class="block px-2 py-1 text-gray-600 hover:text-gray-800">Sejarah</a>--}}
{{--                            </li>--}}
{{--                            <li><a href="#" class="block px-2 py-1 text-gray-600 hover:text-gray-800">Visi &--}}
{{--                                    Misi</a></li>--}}
{{--                            <li><a href="#" class="block px-2 py-1 text-gray-600 hover:text-gray-800">Struktur--}}
{{--                                    Organisasi</a></li>--}}
{{--                            <li><a href="#"--}}
{{--                                    class="block px-2 py-1 text-gray-600 hover:text-gray-800">Fasilitas</a></li>--}}
{{--                        </ul>--}}
{{--                    </li>--}}
{{--                    <li><a href="#" class="text-gray-600 hover:text-gray-800 font-bold">PRESTASI</a></li>--}}
{{--                </ul>--}}
{{--            </nav>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</header>--}}

<style>
    .group:hover .dropdown-menu {
        visibility: visible;
        opacity: 1;
        transform: translateY(0);
    }

    .nav-link { position: relative; }
    .nav-link::after {
        content: '';
        position: absolute;
        width: 0;
        height: 3px;
        bottom: -4px;
        left: 0;
        background-color: #F3D898;
        transition: width 0.3s ease-in-out;
    }
    .nav-link:hover::after { width: 100%; }

    .nav-link.active::after { width: 100%; }
</style>

<nav class="sticky top-0 z-50 bg-white shadow-sm">

    <div class="container mx-auto px-4 sm:px-6 lg:px-12">
        <div class="flex justify-between items-center h-24">
            <div class="flex items-center gap-3 md:gap-4">
                <div class="flex-shrink-0">
                    <img class="h-14 w-auto" src="{{ asset('images/LOGO SEKOLAH.jpeg') }}" alt="Logo SD">
                </div>
                <div class="flex flex-col justify-center">
                    <h1 class="text-xl md:text-2xl font-bold text-slate-800 leading-none">
                        SD Negeri <span class="text-sky-500">JuwetKenongo</span>
                    </h1>
                    <p class="text-[10px] md:text-xs text-slate-500 mt-1 tracking-wide font-medium">
                        Mewujudkan Generasi Cerdas & Berkarakter
                    </p>
                </div>
            </div>

            <div class="hidden lg:flex items-center space-x-8">

                <a href="{{route('home')}}" class="nav-link hover:text-sky-500 font-medium text-base transition-colors {{request()->routeIs('home') ? 'active text-sky-500' : 'text-slate-600'}}">
                    Beranda
                </a>

                <div class="relative group py-4">
                    <button class="nav-link flex items-center gap-1 group-hover:text-sky-500 font-medium text-base transition-colors focus:outline-none {{request()->routeIs('landing.visi-misi', 'landing.guru') ? 'text-sky-500 active' : 'text-slate-600 hover:text-sky-500'}}">
                        Profil Sekolah
                        <svg class="w-4 h-4 transition-transform duration-300 group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>

                    <div class="dropdown-menu absolute left-0 top-full mt-0 w-56 bg-white rounded-b-lg shadow-xl border-t-2 border-sky-500 opacity-0 invisible transform translate-y-2 transition-all duration-300 z-50">
                        <div class="py-2">
                            <a href="{{route('landing.visi-misi')}}" class="block px-4 py-3 text-sm text-slate-600 hover:bg-sky-50 hover:text-sky-600 transition-colors border-b border-gray-50 last:border-0">Visi & Misi</a>
                            <a href="{{route('landing.guru')}}" class="block px-4 py-3 text-sm text-slate-600 hover:bg-sky-50 hover:text-sky-600 transition-colors">Guru & Staff</a>
                            <a href="{{route('landing.ekstrakurikuler')}}" class="block px-4 py-3 text-sm text-slate-600 hover:bg-sky-50 hover:text-sky-600 transition-colors">Ekstrakurikuler</a>
                        </div>
                    </div>
                </div>

                <div class="relative group py-4">
                    <button class="nav-link flex items-center gap-1 group-hover:text-sky-500 font-medium text-base transition-colors focus:outline-none {{request()->routeIs('landing.berita') ? 'text-sky-500 active' : 'text-slate-600 hover:text-sky-500'}}">
                        Berita
                        <svg class="w-4 h-4 transition-transform duration-300 group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>

                    <div class="dropdown-menu absolute left-0 top-full mt-0 w-48 bg-white rounded-b-lg shadow-xl border-t-2 border-sky-500 opacity-0 invisible transform translate-y-2 transition-all duration-300 z-50">
                        <div class="py-2">
                            <a href="{{route('landing.berita')}}" class="block px-4 py-3 text-sm text-slate-600 hover:bg-sky-50 hover:text-sky-600 transition-colors border-b border-gray-50 last:border-0">Terbaru</a>
                            <a href="#" class="block px-4 py-3 text-sm text-slate-600 hover:bg-sky-50 hover:text-sky-600 transition-colors">Pengumuman</a>
                        </div>
                    </div>
                </div>

                <a href="{{route('landing.prestasi')}}" class="nav-link hover:text-sky-500 font-medium text-base transition-colors {{request()->routeIs('landing.prestasi') ? 'text-sky-500 active' : 'text-slate-600 hover:text-sky-500'}}">
                    Prestasi
                </a>

                <a href="{{route('landing.fasilitas')}}" class="nav-link font-medium text-base transition-colors {{request()->routeIs('landing.fasilitas') ? 'text-sky-500 active' : 'text-slate-600 hover:text-sky-500'}}">
                    Fasilitas
                </a>

            </div>

            <div class="lg:hidden flex items-center">
                <button id="mobile-menu-btn" class="text-slate-600 hover:text-sky-500 focus:outline-none p-2">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div class="w-full h-[4px] bg-[#F3D898]"></div>

    <div id="mobile-menu" class="hidden lg:hidden fixed inset-0 z-40 bg-white overflow-y-auto pt-24 pb-6 px-6 transition-all duration-300">
        <button id="close-menu-btn" class="absolute top-6 right-6 text-slate-500 hover:text-red-500">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>

        <div class="flex flex-col space-y-4">
            <a href="#" class="text-lg font-medium text-slate-700 hover:text-sky-500 border-b border-gray-100 pb-2">Beranda</a>

            <div x-data="{ open: false }">
                <button onclick="toggleSubmenu('sub-profil', 'arrow-profil')" class="flex justify-between items-center w-full text-lg font-medium text-slate-700 hover:text-sky-500 border-b border-gray-100 pb-2">
                    Profil Sekolah
                    <svg id="arrow-profil" class="w-4 h-4 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                <div id="sub-profil" class="hidden pl-4 mt-2 space-y-2 bg-gray-50 py-2 rounded-lg">
                    <a href="{{route('landing.visi-misi')}}" class="block text-slate-600 py-1 hover:text-sky-500">Visi Misi</a>
                    <a href="{{route('landing.guru')}}" class="block text-slate-600 py-1 hover:text-sky-500">Guru & Staff</a>
                    <a href="{{route('landing.ekstrakurikuler')}}" class="block text-slate-600 py-1 hover:text-sky-500">Ekstrakurikuler</a>
                </div>
            </div>

            <div>
                <button onclick="toggleSubmenu('sub-berita', 'arrow-berita')" class="flex justify-between items-center w-full text-lg font-medium text-slate-700 hover:text-sky-500 border-b border-gray-100 pb-2">
                    Berita
                    <svg id="arrow-berita" class="w-4 h-4 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                <div id="sub-berita" class="hidden pl-4 mt-2 space-y-2 bg-gray-50 py-2 rounded-lg">
                    <a href="{{route('landing.berita')}}" class="block text-slate-600 py-1 hover:text-sky-500">Terbaru</a>
                    <a href="{{route('landing.pengumuman')}}" class="block text-slate-600 py-1 hover:text-sky-500">Pengumuman</a>
                </div>
            </div>

            <a href="{{route('landing.prestasi')}}" class="text-lg font-medium text-slate-700 hover:text-sky-500 border-b border-gray-100 pb-2">Prestasi</a>

            <a href="{{route('landing.fasilitas')}}" class="text-lg font-bold text-sky-600 bg-sky-50 pl-3 py-2 rounded border-l-4 border-[#F3D898]">Fasilitas</a>
        </div>
    </div>
</nav>

<script>
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const closeMenuBtn = document.getElementById('close-menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');

    mobileMenuBtn.addEventListener('click', () => {
        mobileMenu.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    });

    closeMenuBtn.addEventListener('click', () => {
        mobileMenu.classList.add('hidden');
        document.body.style.overflow = 'auto';
    });

    function toggleSubmenu(menuId, arrowId) {
        const submenu = document.getElementById(menuId);
        const arrow = document.getElementById(arrowId);

        if (submenu.classList.contains('hidden')) {
            submenu.classList.remove('hidden');
            arrow.classList.add('rotate-180');
        } else {
            submenu.classList.add('hidden');
            arrow.classList.remove('rotate-180');
        }
    }
</script>
