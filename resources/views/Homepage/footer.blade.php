    <script src="https://unpkg.com/lucide@latest"></script>

    <footer class="bg-darkbg text-slate-300 border-t-4 border-secondary relative overflow-hidden">

        <!-- Background Pattern (Optional decoration) -->
        <div class="absolute top-0 right-0 -mt-10 -mr-10 w-64 h-64 bg-primary/5 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 -mb-10 -ml-10 w-64 h-64 bg-secondary/5 rounded-full blur-3xl"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-16 pb-8 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 lg:gap-8">

                <!-- Kolom 1: Identitas Sekolah -->
                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <!-- Logo Placeholder -->
                        <div class="bg-white p-1.5 rounded-lg h-12 w-12 flex items-center justify-center shadow-lg">
                            <!-- Ganti src dengan logo sekolah Anda -->
                            <img src="{{ asset('images/LOGO SEKOLAH.jpeg') }}" alt="Logo SD"
                                class="h-full w-auto object-contain">
                        </div>
                        <div class="flex md:flex-col md:gap-0 gap-1.5">
                            <h3 class="text-lg font-bold text-white leading-none">SD Negeri</h3>
                            <h3 class="text-lg font-bold text-primary leading-none md:mt-0.5">JuwetKenongo</h3>
                        </div>
                    </div>
                    <p class="text-sm text-slate-400 leading-relaxed text-justify">
                        Mewujudkan generasi cerdas, berkarakter, dan berakhlak mulia. Kami berkomitmen memberikan
                        pendidikan dasar terbaik untuk putra-putri bangsa.
                    </p>
                </div>

                <!-- Kolom 2: Navigasi Cepat -->
                <div>
                    <h3 class="text-white font-bold text-lg mb-6 relative inline-block">
                        Tautan Cepat
                        <span class="absolute bottom-0 left-0 w-1/2 h-0.5 bg-secondary"></span>
                    </h3>
                    <ul class="space-y-3 text-sm">
                        <li>
                            <a href="{{ route('home') }}"
                                class="hover:text-secondary transition-colors flex items-center gap-2">
                                <i data-lucide="chevron-right" class="w-3 h-3 text-primary"></i> Beranda
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('landing.visi-misi') }}"
                                class="hover:text-secondary transition-colors flex items-center gap-2">
                                <i data-lucide="chevron-right" class="w-3 h-3 text-primary"></i> Profil Sekolah
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('landing.guru') }}"
                                class="hover:text-secondary transition-colors flex items-center gap-2">
                                <i data-lucide="chevron-right" class="w-3 h-3 text-primary"></i> Guru & Staf
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('landing.struktur') }}"
                                class="hover:text-secondary transition-colors flex items-center gap-2">
                                <i data-lucide="chevron-right" class="w-3 h-3 text-primary"></i> Informasi PPDB
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('landing.prestasi') }}"
                                class="hover:text-secondary transition-colors flex items-center gap-2">
                                <i data-lucide="chevron-right" class="w-3 h-3 text-primary"></i> Prestasi
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Kolom 3: Kontak -->
                <div>
                    <h3 class="text-white font-bold text-lg mb-6 relative inline-block">
                        Hubungi Kami
                        <span class="absolute bottom-0 left-0 w-1/2 h-0.5 bg-secondary"></span>
                    </h3>
                    <ul class="space-y-4 text-sm">
                        <li class="flex items-start gap-3">
                            <div class="mt-1 bg-slate-800 p-2 rounded-lg text-primary shrink-0">
                                <i data-lucide="map-pin" class="w-4 h-4"></i>
                            </div>
                            <span class="text-slate-400">
                                Jl. Raya Juwet Kenongo No. 123, Kec. Porong, Kab. Sidoarjo, Jawa Timur 61274
                            </span>
                        </li>
                        <li class="flex items-center gap-3">
                            <div class="bg-slate-800 p-2 rounded-lg text-primary shrink-0">
                                <i data-lucide="phone" class="w-4 h-4"></i>
                            </div>
                            <span class="text-slate-400">(031) 885xxxx</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <div class="bg-slate-800 p-2 rounded-lg text-primary shrink-0">
                                <i data-lucide="mail" class="w-4 h-4"></i>
                            </div>
                            <a href="mailto:info@sdnjuwetkenongo.sch.id"
                                class="text-slate-400 hover:text-secondary transition-colors">
                                info@sdnjuwetkenongo.sch.id
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Kolom 4: Peta Lokasi -->
                <div>
                    <h3 class="text-white font-bold text-lg mb-6 relative inline-block">
                        Lokasi Sekolah
                        <span class="absolute bottom-0 left-0 w-1/2 h-0.5 bg-secondary"></span>
                    </h3>
                    <div
                        class="w-full h-48 bg-slate-800 rounded-xl overflow-hidden shadow-lg border border-slate-700 group relative">
                        <!-- Google Maps Iframe -->
                        <!-- Ganti src dengan embed map lokasi sekolah asli dari Google Maps -->
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3955.3198870046626!2d112.68928419999999!3d-7.5400493!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7de42f05245e3%3A0x15a30300df7691a2!2sSD%20NEGERI%20JUWET%20KENONGO%20No.%2087!5e0!3m2!1sid!2sid!4v1764161553380!5m2!1sid!2sid"
                            width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                            class="w-full h-full transition-all duration-500"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>

                        <!-- Overlay Text (Optional) -->
                        <div
                            class="absolute bottom-0 left-0 w-full bg-primary/90 py-1.5 text-center translate-y-full group-hover:translate-y-0 transition-transform duration-300">
                            <a href="https://maps.google.com" target="_blank"
                                class="text-xs font-bold text-white flex items-center justify-center gap-1">
                                Buka di Google Maps <i data-lucide="external-link" class="w-3 h-3"></i>
                            </a>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Copyright Bottom -->
            <div
                class="mt-12 pt-8 border-t border-slate-800 text-center md:text-left flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-sm text-slate-500">
                    &copy; 2024 <span class="text-white font-semibold">SD Negeri JuwetKenongo</span>. All rights
                    reserved.
                </p>
            </div>
        </div>
    </footer>
    <script>
        lucide.createIcons();
    </script>
