<div>
    <aside id="sidebar"
        class="w-72 h-full fixed top-0 left-0 bg-white transform -translate-x-full md:translate-x-0
           transition-transform duration-300 ease-in-out flex flex-col justify-between
           z-40 border-r border-gray-200 px-4 py-5">
        <div class="flex flex-col h-full">
            <div class="flex flex-col items-center mb-5">
                <img src="{{ asset('images/LOGO SEKOLAH.jpeg') }}" alt="Logo" class="w-12 h-12 mx-auto mb-2">
                <div>SDN Juwetkenongo</div>
            </div>
            <div class="flex flex-col ">
                <a href="{{ route('dashboard') }}"
                    class="flex mb-2 items-center p-3 rounded-lg  {{ request()->routeIs('dashboard') ? 'bg-primary hover:bg-primary-dark text-white' : 'bg-white text-black font-normal hover:bg-third' }}  transition duration-150 group">
                    <!-- Ikon Beranda -->
                    <svg class="icon {{ request()->routeIs('dashboard') ? 'text-white' : 'text-primary' }}"
                        xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                        <polyline points="9 22 9 12 15 12 15 22" />
                    </svg>
                    <span class="nav-text ml-3 text-sm">Dashboard</span>
                </a>
                <div class="nav-item">
                    <button type="button"
                        class="flex items-center w-full p-3 text-base text-gray-900 transition duration-300 rounded-lg hover:bg-third"
                        aria-controls="dropdown-master" data-collapse-toggle="dropdown-master">
                        <svg class="icon text-primary" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 7V4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3" />
                            <path d="M12 17a4 4 0 0 0 0-8 4 4 0 0 0 0 8" />
                            <path d="M4 11a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2z" />
                        </svg>
                        <span class="nav-text ml-3 text-left whitespace-nowrap text-sm">Data Master</span>
                        <!-- Ikon Panah Dropdown -->
                        <svg class="nav-text w-3 h-3 ml-auto transition-transform duration-300 transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>
                    <ul id="dropdown-master"
                        class="flex flex-col space-y-2 transform transition-[max-height] max-h-0 duration-500 ease-in-out -translate-y-4 opacity-0 pointer-events-none overflow-hidden">
                        <li><a href="#"
                                class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 hover:bg-third text-xs">Siswa</a>
                        </li>
                        <li><a href="#"
                                class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 hover:bg-third text-xs">Guru
                                & Staf</a></li>
                        <li><a href="#"
                                class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 hover:bg-third text-xs">Kelas</a>
                        </li>
                    </ul>
                </div>
                <div class="nav-item">
                    @php
                        // Cek apakah salah satu route di dalam dropdown Info Publik aktif
                        $isInfoPublikActive =
                            request()->routeIs('facilities.*') ||
                            request()->routeIs('berita.*') ||
                            request()->routeIs('kegiatan.*') ||
                            request()->routeIs('prestasi.*');
                    @endphp

                    <button type="button"
                        class="flex items-center w-full p-3 text-base rounded-lg transition duration-75
            {{ $isInfoPublikActive ? 'bg-primary text-white' : 'text-gray-900 hover:bg-third' }}"
                        aria-controls="dropdown-publik" data-collapse-toggle="dropdown-publik">
                        <svg class="icon {{ $isInfoPublikActive ? 'text-white' : 'text-primary' }}"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path
                                d="M11 5c0-1.74 3.01-3 6.75-3s6.75 1.26 6.75 3v14c0 1.66-3.03 3-6.75 3S4.25 20.66 4.25 19V5C4.25 3.34 7.27 2 11 2z" />
                        </svg>
                        <span class="nav-text ml-3 text-left whitespace-nowrap text-sm">Info Publik</span>
                        <svg class="nav-text w-3 h-3 ml-auto transition-transform duration-300 transform
            {{ $isInfoPublikActive ? 'rotate-180' : '' }}"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>

                    <ul id="dropdown-publik"
                        class="flex flex-col space-y-2 transform transition-[max-height] duration-500 ease-in-out
        {{ $isInfoPublikActive ? 'translate-y-0 opacity-100 pointer-events-auto max-h-96' : '-translate-y-4 opacity-0 pointer-events-none max-h-0' }}">
                        <li><a href="#"
                                class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 hover:bg-third text-xs">Berita</a>
                        </li>
                        <li><a href="#"
                                class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 hover:bg-third text-xs">Kegiatan</a>
                        </li>
                        <li><a href="#"
                                class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 hover:bg-third text-xs">Prestasi</a>
                        </li>
                        <li>
                            <a href="{{ route('facilities.index') }}"
                                class="flex items-center w-full p-2 rounded-lg pl-11 transition duration-75 text-xs
               {{ request()->routeIs('facilities.*') ? 'text-primary font-semibold' : 'text-gray-900 hover:bg-third' }}">
                                Fasilitas
                            </a>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </aside>
</div>
<script>
    // Dropdown functionality
    document.addEventListener('DOMContentLoaded', function() {
        const dropdownToggle = document.querySelector('[data-collapse-toggle="dropdown-master"]');
        const dropdownMenu = document.getElementById('dropdown-master');
        const dropdownTogglePublik = document.querySelector('[data-collapse-toggle="dropdown-publik"]');
        const dropdownMenuPublik = document.getElementById('dropdown-publik');

        dropdownToggle.addEventListener('click', function() {
            // Tentukan kelas yang harus diubah
            const closedClasses = ['-translate-y-4', 'opacity-0', 'pointer-events-none', 'max-h-0'];
            const openClasses = ['translate-y-0', 'opacity-100', 'pointer-events-auto', 'max-h-96'];

            // Periksa apakah sedang terbuka (misalnya, cek apakah punya translate-y-0)
            const isOpen = dropdownMenu.classList.contains('translate-y-0');

            if (isOpen) {
                // Tutup
                dropdownMenu.classList.remove(...openClasses);
                dropdownMenu.classList.add(...closedClasses);
            } else {
                // Buka
                dropdownMenu.classList.add(...openClasses);
                dropdownMenu.classList.remove(...closedClasses);
            }

            // Toggle Arah Panah
            const arrowIcon = this.querySelector('svg.nav-text');
            arrowIcon.classList.toggle('rotate-180');
        });

        dropdownTogglePublik.addEventListener('click', function() {
            const closedClasses = ['-translate-y-4', 'opacity-0', 'pointer-events-none', 'max-h-0'];
            const openClasses = ['translate-y-0', 'opacity-100', 'pointer-events-auto', 'max-h-96'];

            const isOpen = dropdownMenuPublik.classList.contains('translate-y-0');

            if (isOpen) {
                dropdownMenuPublik.classList.remove(...openClasses);
                dropdownMenuPublik.classList.add(...closedClasses);
            } else {
                dropdownMenuPublik.classList.add(...openClasses);
                dropdownMenuPublik.classList.remove(...closedClasses);
            }

            const arrowIcon = this.querySelector('svg.nav-text');
            arrowIcon.classList.toggle('rotate-180');
        });
    });
</script>
