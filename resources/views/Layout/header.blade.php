{{-- header --}}
<header class="">
    <div class="w-full fixed top-0 left-0 right-0 bg-white shadow-md z-50">
        <div class="flex items-center justify-between py-4 md:px-16 px-4">
            <div class="md:text-2xl text-md font-bold text-gray-800">
                <img src="{{ asset('images/LOGO SEKOLAH.jpeg') }}" alt="Logo Sekolah" class="fixed h-12 w-12 -mt-2">
                <a href="{{ url('/') }}" class="ms-16">SD Negeri JuwetKenongo</a>
            </div>
            <nav>
                <ul class="hidden space-x-4 md:flex">
                    <li><a href="{{ url('/') }}" class="text-gray-600 hover:text-gray-800 font-bold">BERANDA</a></li>

                    <li class="relative group">
                        <a href="#" class="text-gray-600 hover:text-gray-800 flex items-center font-bold">
                            PROFIL SEKOLAH
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor"
                                class="size-4 inline-block ms-1 transition-transform duration-300 ease-in-out group-hover:rotate-180">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                            </svg>

                        </a>

                        <ul
                            class="absolute bg-gray-100 shadow-md mt-2 p-2 space-y-2 w-48
                                   opacity-0 invisible group-hover:opacity-100 group-hover:visible
                                   transform -translate-y-2 group-hover:translate-y-0
                                   transition-all duration-300 ease-in-out rounded-lg">
                            <li><a href="#" class="block px-2 py-1 text-gray-600 hover:text-gray-800">Sejarah</a>
                            </li>
                            <li><a href="#" class="block px-2 py-1 text-gray-600 hover:text-gray-800">Visi &
                                    Misi</a></li>
                            <li><a href="#" class="block px-2 py-1 text-gray-600 hover:text-gray-800">Struktur
                                    Organisasi</a></li>
                            <li><a href="#"
                                    class="block px-2 py-1 text-gray-600 hover:text-gray-800">Fasilitas</a></li>
                        </ul>
                    </li>

                    <li class="relative group">
                        <a href="#" class="text-gray-600 hover:text-gray-800 flex items-center font-bold">BERITA
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor"
                                class="size-4 inline-block ms-1 transition-transform duration-300 ease-in-out group-hover:rotate-180">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                            </svg>
                        </a>

                        <ul
                            class="absolute bg-gray-100 shadow-md mt-2 p-2 space-y-2 w-48
                                   opacity-0 invisible group-hover:opacity-100 group-hover:visible
                                   transform -translate-y-2 group-hover:translate-y-0
                                   transition-all duration-300 ease-in-out rounded-lg">
                            <li><a href="#" class="block px-2 py-1 text-gray-600 hover:text-gray-800">Sejarah</a>
                            </li>
                            <li><a href="#" class="block px-2 py-1 text-gray-600 hover:text-gray-800">Visi &
                                    Misi</a></li>
                            <li><a href="#" class="block px-2 py-1 text-gray-600 hover:text-gray-800">Struktur
                                    Organisasi</a></li>
                            <li><a href="#"
                                    class="block px-2 py-1 text-gray-600 hover:text-gray-800">Fasilitas</a></li>
                        </ul>
                    </li>
                    <li><a href="#" class="text-gray-600 hover:text-gray-800 font-bold">PRESTASI</a></li>
                </ul>
            </nav>
        </div>
    </div>
</header>
