@extends('Layout.app')

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <style>
        .swiper {
            padding-left: 20px;
            padding-right: 20px;
            padding-top: 20px;
        }

        .swiper-wrapper {
            display: flex;
            align-items: stretch !important;
            padding-bottom: 2rem;
        }

        .swiper-slide {
            display: flex;
            height: auto !important;
            z-index: 1;
        }

        .swiper-slide > div {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        /* Styling untuk tombol navigasi */
        .swiper-button-next,
        .swiper-button-prev {
            color: #3b82f6 !important;
            width: 40px !important;
            height: 40px !important;
            background-color: black !important;
            border-radius: 50% !important;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1) !important;
            transform: translateY(-50%) !important;
            top: 50% !important;
        }

        /* Mengatur posisi tombol NEXT di kanan */
        .swiper-button-next {
            right: calc(-3rem) !important;
        }

        /* Mengatur posisi tombol PREV di kiri */
        .swiper-button-prev {
            left: calc(-3rem) !important;
        }

        /* Mengubah ukuran ikon panah di dalam tombol */
        .swiper-button-next:after,
        .swiper-button-prev:after {
            font-size: 16px !important;
            font-weight: bold;
        }

        .card-content-wrapper {
            position: relative;
            /* Make the container a positioning context */
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .card-text-container {
            flex-grow: 1;
            /* Allow text container to take up remaining space */
        }

        .read-more-link {
            position: absolute;
            /* Position the link absolutely */
            bottom: 1rem;
            /* 1rem from the bottom */
            left: 1rem;
            /* 1rem from the left */
        }

        .calendar-day {
            width: 100%;
            height: 70px;
            /* Tinggi yang cukup untuk tanggal dan penanda */
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: center;
            padding-top: 4px;
            cursor: pointer;
            transition: all 0.15s;
            border-radius: 0.5rem;
            /* rounded-lg */
            margin: 1px;
            /* Jarak antar sel */
        }

        .calendar-day-number {
            font-size: 1rem;
            font-weight: 600;
            /* font-semibold */
        }

        .calendar-day:hover:not(.active):not(.search-highlight) {
            background-color: #eef1f5;
            /* hover:bg-gray-100 */
        }

        /* Style untuk tanggal yang dipilih (Active state) */
        .calendar-day.active {
            background-color: #3b82f6;
            /* Menggunakan Light Teal */
            color: white;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.1);
        }

        /* Style untuk hasil pencarian (Search Highlight state) */
        .calendar-day.search-highlight {
            background-color: #22c55e;
            /* Menggunakan Gold/Amber */
            color: theme('colors.gray.900');
            /* Teks gelap di latar kuning */
            font-weight: 700;
        }

        /* Pastikan tanggal yang aktif dan merupakan hasil search tetap terlihat aktif, atau jika mode search aktif, semua highlight terlihat seperti aktif */
        .calendar-day.active.search-highlight,
        .calendar-day.search-highlight:hover {
            /* Menambahkan hover untuk tampilan lebih interaktif */
            background-color: #fbbf24;
            color: theme('colors.gray.900');
        }

        /* Kontainer untuk menampung banyak titik */
        .event-marker-container {
            display: flex;
            /* Untuk menyejajarkan titik-titik secara horizontal */
            gap: 3px;
            /* Jarak antar titik */
            margin-top: 4px;
            /* Jarak dari tanggal */
            height: 8px;
            /* Tinggi kontainer marker */
            justify-content: center;
        }

        /* Penanda acara (titik kecil) */
        .event-marker {
            display: block;
            height: 6px;
            width: 6px;
            border-radius: 9999px;
            /* rounded-full */
            transition: opacity 0.15s;
        }

        /* Marker visibility in active/search states */
        .calendar-day.active .event-marker,
        .calendar-day.search-highlight .event-marker {
            opacity: 0.9;
        }
    </style>
@endpush

@section('content')
    <div class="md:mt-0 ">
        <div class="relative w-full h-[calc(100vh-4rem)] overflow-hidden">
            <div id="slider" class="relative w-full h-full flex transition-transform duration-1000 ease-in-out">
                <div class="relative flex-shrink-0 w-full h-full">
                    <img src="{{ asset('images/bg-1.jpg') }}" alt="Gambar 1" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-black opacity-50"></div>
                </div>
                <div class="relative flex-shrink-0 w-full h-full">
                    <img src="{{ asset('images/bg-2.jpg') }}" alt="Logo" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-black opacity-50"></div>
                </div>
                <div class="relative flex-shrink-0 w-full h-full">
                    <img src="{{ asset('images/bg-3.jpg') }}" alt="Gambar 3" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-black opacity-50"></div>
                </div>
            </div>
            <div
                class="absolute top-1/2 md:left-1/2 transform md:-translate-x-1/2 md:-translate-y-1/2 text-center text-white z-20 md:p-16 px-2">
                <h1 id="hero-title"
                    class="text-xl md:text-4xl font-bold mb-4
                    opacity-0 -translate-x-full transition-all duration-1500 ease-out">
                    Selamat Datang di SD Negeri JuwetKenongo
                </h1>
                <p id="hero-subtitle"
                   class="text-lg md:text-md text-secondary
                    opacity-0 translate-x-full transition-all duration-1000 ease-out delay-300">
                    Mewujudkan Generasi Emas yang Cerdas dan Berkarakter
                </p>
                <button
                    class="mt-8 px-2 py-2 md:px-6 md:py-3 text-sm md:text-md bg-primary hover:bg-[#296B99] text-white font-semibold rounded-lg shadow-md transition-colors duration-300">
                    Selengkapnya
                </button>
            </div>
            <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-2 z-20" id="button-slider">
                <button
                    class="w-3 h-3 rounded-full bg-white opacity-50 hover:opacity-100 transition-opacity duration-300"
                    onclick="showSlide(0)"></button>
                <button
                    class="w-3 h-3 rounded-full bg-white opacity-50 hover:opacity-100 transition-opacity duration-300"
                    onclick="showSlide(1)"></button>
                <button
                    class="w-3 h-3 rounded-full bg-white opacity-50 hover:opacity-100 transition-opacity duration-300"
                    onclick="showSlide(2)"></button>
            </div>
        </div>
        {{-- berita --}}
        @include('Homepage.berita')

        {{-- Pengumuman --}}
        <div class="bg-linear-to-r from-[#FFF0CE]/20 to-[#EBCB90]/50 pb-8">
            <div class="max-w-7xl mx-auto px-4 pt-12 sm:px-6 lg:px-8 h-full flex flex-col">
                <div class="w-24 h-1 bg-primary mb-4"></div>
                <div class="flex items-center justify-between w-full">
                    <h2 class="text-2xl font-bold text-gray-800 items-center flex">Pengumuman</h2>
                    <a href="#" class="text-primary font-semibold">SELENGKAPNYA</a>
                </div>
            </div>
            <div class="flex flex-col lg:flex-row gap-3 max-w-7xl mx-auto px-4 sm:px-6 pt-6 ">
                <div id="calendar-container" class="lg:w-1/3 w-full p-6 rounded-2xl shadow-lg bg-white">
                    <div class="flex justify-center items-center mb-2 border-b pb-2">
                        <button id="prev-month-btn" class="p-2 rounded-full text-primary hover:bg-gray-100 transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M15 19l-7-7 7-7">
                                </path>
                            </svg>
                        </button>
                        <h2 id="current-month-year" class="text-xl font-bold text-gray-900"></h2>
                        <button id="next-month-btn" class="p-2 rounded-full text-primary hover:bg-gray-100 transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                </path>
                            </svg>
                        </button>
                    </div>

                    <div class="grid grid-cols-7 gap-1 text-center text-sm font-semibold text-gray-600 mb-2">
                        <span>Min</span>
                        <span>Sen</span>
                        <span>Sel</span>
                        <span>Rab</span>
                        <span>Kam</span>
                        <span>Jum</span>
                        <span>Sab</span>
                    </div>

                    <div id="calendar-grid" class="grid grid-cols-7 gap-1">
                        <div class="col-span-7 text-center py-4 text-gray-500">Memuat...</div>
                    </div>
                </div>
                <div id="details-container"
                     class="lg:w-2/3 w-full bg-white p-6 rounded-xl shadow-lg border border-gray-100">
                    <!-- Judul Rincian menggunakan Deep Teal -->
                    <h2 class="text-lg font-bold mb-4 text-primary border-b pb-2">Rincian Kegiatan</h2>

                    <!-- === START: Search Input & Tab Navigation === -->
                    <div class="mb-4 flex gap-4">
                        <div class="flex flex-grow items-center bg-gray-100 rounded-lg p-1 border border-gray-200 ">
                            <input type="text" id="search-input" placeholder="Cari Judul Acara (misal: Rapat)..."
                                   class="flex-grow bg-transparent px-3 py-1.5 focus:outline-none text-gray-700 placeholder-gray-400 text-sm">
                            <button id="search-button"
                                    class="bg-primary text-white p-2 rounded-lg hover:bg-primary/90 transition shadow-md"
                                    onclick="handleSearch()">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="flex mb-4 p-1 bg-gray-100 rounded-xl">
                        <button id="tab-selected-date" data-mode="selected"
                                class="flex-1 py-2 px-4 rounded-lg text-sm font-semibold text-white bg-secondary shadow-md transition"
                                onclick="setViewMode('selected')">
                            Rincian Tanggal Terpilih
                        </button>
                        <button id="tab-search-results" data-mode="search"
                                class="flex-1 py-2 px-4 rounded-lg text-sm font-semibold text-gray-700 shadow-md transition "
                                onclick="setViewMode('search')">
                            Hasil Pencarian
                        </button>
                    </div>
                    <div id="event-details">
                        <p class="text-gray-500 italic p-4 bg-amber-50 rounded-lg border border-amber-200">
                            Silakan pilih tanggal dari kalender atau gunakan kolom pencarian di atas.
                        </p>
                    </div>

                    <div id="loading-indicator" class="hidden text-center p-8">
                        <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-primary mx-auto"></div>
                        <p class="mt-2 text-primary bg-marker-green">Memuat rincian...</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Prestasi --}}
        @include('Homepage.prestasi')

        {{-- Fasilitas --}}
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-12">
            <div class="w-24 bg-primary mb-4 h-1"></div>
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-gray-800 items-center flex">Fasilitas Siswa</h2>
                <a href="#" class="text-primary font-semibold">SELENGKAPNYA</a>
            </div>
            <div class="swiper mySwiper">
                <div class="swiper-wrapper ">
                    {{-- Fasilitas List --}}
                    @foreach ($facilities as $data)
                        <div class="swiper-slide">
                            <div
                                class="bg-white rounded-lg shadow-md overflow-hidden transform hover:scale-120 transition-transform duration-300 ease-in-out relative group">
                                <div class="relative w-full h-48">
                                    <img src="{{ Storage::url($data->image) }}" alt="{{ $data->name }}"
                                         class="w-full h-full object-cover rounded-t-lg">
                                </div>
                                <div
                                    class="absolute rounded-lg inset-x-0 bottom-0 h-1/2 bg-gradient-to-t from-black via-black/50 transition-opacity group-hover:opacity-0 duration-300 ease-in-out to-transparent flex items-end p-4">
                                    <h3 class="text-xl font-bold text-white">{{ $data->name }}</h3>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="w-full mx-auto pt-12">
            @include('Homepage.guru')
        </div>

{{--        footer--}}
        <div class="w-full mx-auto">
            @include('Homepage.footer')
        </div>

    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        let currentSlide = 0;
        const slider = document.getElementById('slider');
        const slides = document.querySelectorAll('#slider > div');
        const totalSlides = slides.length;
        const heroTitle = document.getElementById('hero-title');
        const heroSubtitle = document.getElementById('hero-subtitle');
        var swiper = new Swiper(".mySwiper", {
            slidesPerView: 4,
            spaceBetween: 30,
            // slidesOffsetBefore: 20,
            // slidesOffsetAfter: 20,
            loop: false,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            breakpoints: {
                320: {
                    slidesPerView: 1,
                    spaceBetween: 10,
                },
                768: {
                    slidesPerView: 2,
                    spaceBetween: 20,
                },
                1024: {
                    slidesPerView: 4,
                    spaceBetween: 30,
                },
            },
        });

        function showSlide(index) {
            const offset = -index * 100;
            slider.style.transform = `translateX(${offset}%)`;
            currentSlide = index;
            const buttonSlider = document.getElementById('button-slider');
            const buttons = buttonSlider.querySelectorAll('button');
            buttons.forEach((button, idx) => {
                if (idx === index) {
                    button.classList.add('opacity-100');
                    button.classList.remove('opacity-50');
                } else {
                    button.classList.add('opacity-50');
                    button.classList.remove('opacity-100');
                }
            });
        }

        function nextSlide() {
            currentSlide = (currentSlide + 1) % totalSlides;
            showSlide(currentSlide);
        }

        function animateHeroText() {
            heroTitle.classList.remove('opacity-0', '-translate-x-full');
            heroSubtitle.classList.remove('opacity-0', 'translate-x-full');
        }

        showSlide(currentSlide);

        document.addEventListener('DOMContentLoaded', () => {
            animateHeroText();
        });

        setInterval(nextSlide, 5000);

        function popUpNews() {

        }

        const EVENTS_DATA = @json($events);
        // console.log(dataEvents);

        // const EVENTS_DATA = [
        //     // Acara Rapat Perencanaan Proyek, 3 hari (3, 4, 5 November)
        //     {
        //         id: 1,
        //         title: 'Rapat Perencanaan Proyek',
        //         description: 'Rapat bulanan untuk meninjau kemajuan dan merencanakan proyek Q4. Diadakan di Ruang Konferensi Utama.',
        //         location: 'Ruang Konferensi Utama',
        //         category: 'Pekerjaan',
        //         hasEvent: true,
        //         time: '09:00 - 11:00',
        //         markerColor: 'marker-red',
        //         startDate: '2025-11-03',
        //         endDate: '2025-11-05'
        //     },
        //
        //     // Sesi Brainstorming Inovasi, 1 hari (5 November) - Berbagi tanggal dengan Rapat
        //     {
        //         id: 11,
        //         title: 'Sesi Brainstorming Inovasi',
        //         description: 'Diskusi informal untuk ide produk baru tahun depan. Wajib hadir untuk tim R&D dan Pemasaran.',
        //         location: 'Ruang Kreatif',
        //         category: 'Inovasi',
        //         hasEvent: true,
        //         time: '14:00 - 16:00',
        //         markerColor: 'marker-blue',
        //         startDate: '2025-11-05',
        //         endDate: '2025-11-05'
        //     },
        //
        //     // Acara Pengiriman Laporan Keuangan, 1 hari
        //     {
        //         id: 2,
        //         title: 'Pengiriman Laporan Keuangan',
        //         description: 'Batas waktu pengiriman laporan keuangan triwulan ke kantor pusat. Pastikan semua data sudah divalidasi dengan tim akunting.',
        //         location: 'Internal',
        //         category: 'Administrasi',
        //         hasEvent: true,
        //         time: '16:00',
        //         markerColor: 'marker-green',
        //         startDate: '2025-11-06',
        //         endDate: '2025-11-06'
        //     },
        //
        //     // Hari Bebas Acara (Non-event) - Hanya perlu satu tanggal
        //     {
        //         id: 3,
        //         title: 'Hari Bebas Acara',
        //         description: 'Tidak ada acara terjadwal pada tanggal ini. Fokus pada tugas rutin dan penyelesaian backlog. Waktu yang baik untuk istirahat singkat.',
        //         location: '-',
        //         category: 'Santai',
        //         hasEvent: false,
        //         time: '-',
        //         startDate: '2025-11-07',
        //         endDate: '2025-11-07'
        //     },
        //
        //     // Webinar Pengembangan Diri, 1 hari
        //     {
        //         id: 4,
        //         title: 'Webinar Pengembangan Diri',
        //         description: 'Webinar daring (online) tentang "Keterampilan Komunikasi Efektif" oleh Bapak Budi Santoso. Wajib bagi semua staf. Link Zoom akan dikirim melalui email.',
        //         location: 'Online (Zoom)',
        //         category: 'Edukasi',
        //         hasEvent: true,
        //         time: '10:00',
        //         markerColor: 'marker-blue',
        //         startDate: '2025-11-08',
        //         endDate: '2025-11-08'
        //     },
        //
        //     // Ulang Tahun Perusahaan, 2 hari (10 & 11 November)
        //     {
        //         id: 5,
        //         title: 'Ulang Tahun Perusahaan ke-10',
        //         description: 'Perayaan ulang tahun perusahaan! Acara makan malam dan hiburan akan diadakan di Balai Agung. Dress code: Formal Batik.',
        //         location: 'Balai Agung',
        //         category: 'Sosial',
        //         hasEvent: true,
        //         time: '19:00',
        //         markerColor: 'marker-red',
        //         startDate: '2025-11-10',
        //         endDate: '2025-11-11'
        //     },
        //
        //     // Persiapan Audit Internal, 1 hari
        //     {
        //         id: 51,
        //         title: 'Persiapan Audit Internal',
        //         description: 'Sesi terakhir untuk memfinalisasi dokumen sebelum inspeksi kualitas.',
        //         location: 'Ruang Arsip',
        //         category: 'Administrasi',
        //         hasEvent: true,
        //         time: '10:00',
        //         markerColor: 'marker-green',
        //         startDate: '2025-11-10',
        //         endDate: '2025-11-10'
        //     },
        //
        //     // Peluncuran Produk Baru, 1 hari
        //     {
        //         id: 52,
        //         title: 'Peluncuran Produk Baru',
        //         description: 'Peluncuran resmi produk Alpha 2026 secara virtual.',
        //         location: 'Online (YouTube)',
        //         category: 'Pemasaran',
        //         hasEvent: true,
        //         time: '14:00',
        //         markerColor: 'marker-blue',
        //         startDate: '2025-11-10',
        //         endDate: '2025-11-10'
        //     },
        //
        //     // Pelatihan Keamanan Data, 3 hari
        //     {
        //         id: 6,
        //         title: 'Pelatihan Keamanan Data',
        //         description: 'Sesi pelatihan wajib untuk memastikan semua karyawan memahami protokol keamanan data terbaru dan pencegahan phising.',
        //         location: 'Ruang Pelatihan B',
        //         category: 'Pelatihan',
        //         hasEvent: true,
        //         time: '13:00',
        //         markerColor: 'marker-green',
        //         startDate: '2025-11-12',
        //         endDate: '2025-11-14'
        //     },
        //
        //     // Inspeksi Kualitas Tahunan, 1 hari
        //     {
        //         id: 7,
        //         title: 'Inspeksi Kualitas Tahunan',
        //         description: 'Tim audit eksternal akan melakukan inspeksi menyeluruh terhadap standar kualitas produk dan proses operasional.',
        //         location: 'Semua Departemen',
        //         category: 'Audit',
        //         hasEvent: true,
        //         time: 'Sepanjang Hari',
        //         markerColor: 'marker-red',
        //         startDate: '2025-11-15',
        //         endDate: '2025-11-15'
        //     },
        //
        //     // Cuti Bersama, 1 hari
        //     {
        //         id: 8,
        //         title: 'Pengambilan Cuti Bersama',
        //         description: 'Hari libur nasional/cuti bersama. Kantor tutup.',
        //         location: '-',
        //         category: 'Libur',
        //         hasEvent: true,
        //         time: '-',
        //         markerColor: 'marker-blue',
        //         startDate: '2025-11-18',
        //         endDate: '2025-11-18'
        //     },
        //
        //     // Pesta Akhir Tahun, 1 hari
        //     {
        //         id: 9,
        //         title: 'Pesta Akhir Tahun',
        //         description: 'Pesta perayaan akhir tahun dan apresiasi karyawan. Lokasi: Hotel Bintang Lima.',
        //         category: 'Sosial',
        //         hasEvent: true,
        //         time: '18:00',
        //         markerColor: 'marker-red',
        //         startDate: '2025-12-05',
        //         endDate: '2025-12-05'
        //     },
        //
        //     // Libur Natal, 1 hari
        //     {
        //         id: 10,
        //         title: 'Libur Natal',
        //         description: 'Libur Nasional memperingati Hari Raya Natal.',
        //         location: '-',
        //         category: 'Libur',
        //         hasEvent: true,
        //         time: '-',
        //         markerColor: 'marker-green',
        //         startDate: '2025-12-25',
        //         endDate: '2025-12-25'
        //     },
        // ];

        // --- Variabel Global ---
        // Kita menggunakan tanggal 1 Nov 2025 sebagai "Hari Ini" untuk inisialisasi kalender
        const TODAY_DATE = new Date(2025, 10, 5);
        const TODAY_DATE_STRING = formatDate(TODAY_DATE);

        let currentViewMode = 'selected'; // Mode default: selected (tanggal terpilih)
        let activeSearchQuery = ''; // Menyimpan query pencarian aktif
        let searchResultDates = []; // Array YYYY-MM-DD dari hasil pencarian

        // Elemen DOM
        const calendarGridElement = document.getElementById('calendar-grid');
        const currentMonthYearElement = document.getElementById('current-month-year');
        const prevMonthBtn = document.getElementById('prev-month-btn');
        const nextMonthBtn = document.getElementById('next-month-btn');
        const detailsElement = document.getElementById('event-details');
        const loadingElement = document.getElementById('loading-indicator');
        const searchInputElement = document.getElementById('search-input');

        // Elemen Tab
        const tabSelectedDate = document.getElementById('tab-selected-date');
        const tabSearchResults = document.getElementById('tab-search-results');

        // Inisialisasi tanggal awal (November 2025)
        let currentDate = new Date(2025, 10, 1);
        let activeDateString = TODAY_DATE_STRING; // Menyimpan tanggal aktif (YYYY-MM-DD)

        const MONTH_NAMES = [
            "Januari", "Februari", "Maret", "April", "Mei", "Juni",
            "Juli", "Agustus", "September", "Oktober", "November", "Desember"
        ];

        /**
         * Mengubah objek Date menjadi string format YYYY-MM-DD
         */
        function formatDate(date) {
            const y = date.getFullYear();
            const m = String(date.getMonth() + 1).padStart(2, '0');
            const d = String(date.getDate()).padStart(2, '0');
            return `${y}-${m}-${d}`;
        }

        /**
         * Mengubah string tanggal menjadi format tampilan yang singkat (Contoh: 5 Nov)
         */
        function getShortDateDisplay(dateString) {
            return new Date(dateString + 'T00:00:00').toLocaleDateString('id-ID', {
                day: 'numeric',
                month: 'short'
            });
        }

        /**
         * Mengubah string tanggal menjadi format tampilan lengkap (Contoh: Senin, 5 November 2025)
         */
        function getLongDateDisplay(dateString) {
            return new Date(dateString + 'T00:00:00').toLocaleDateString('id-ID', {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });
        }

        function getShortMonthName(dateString) {
            return new Date(dateString + 'T00:00:00').toLocaleDateString('id-ID', {
                month: 'short'
            });
        }

        function getDayOfMonth(dateString) {
            return new Date(dateString + 'T00:00:00').getDate();
        }

        /**
         * Membuat Map yang memetakan setiap tanggal dengan array acara yang terjadi pada tanggal tersebut.
         */
        function generateEventsMap(events) {
            const map = new Map();
            events.forEach(event => {
                if (!event.hasEvent) {
                    map.set(event.startDate, [event]);
                    return;
                }

                const start = new Date(event.startDate + 'T00:00:00');
                const end = new Date(event.endDate + 'T00:00:00');

                let current = new Date(start);

                while (current <= end) {
                    const dateString = formatDate(current);
                    const eventsOnDate = map.get(dateString) || [];

                    eventsOnDate.push(event);
                    map.set(dateString, eventsOnDate);

                    current.setDate(current.getDate() + 1);
                }
            });
            return map;
        }

        const EVENTS_DATA_MAP = generateEventsMap(EVENTS_DATA);

        /**
         * Fungsi untuk mencari acara berdasarkan query.
         * Mengembalikan array acara yang cocok dan memperbarui searchResultDates.
         */
        function searchEvents(query) {
            if (!query) {
                searchResultDates = [];
                return [];
            }
            const lowerCaseQuery = query.toLowerCase();

            // 1. Filter Events Data asli berdasarkan judul yang cocok
            const matchedEvents = EVENTS_DATA.filter(event =>
                event.hasEvent && event.title.toLowerCase().includes(lowerCaseQuery)
            );

            // 2. Kumpulkan semua tanggal dari event yang cocok
            const dates = new Set();
            matchedEvents.forEach(event => {
                const start = new Date(event.startDate + 'T00:00:00');
                const end = new Date(event.endDate + 'T00:00:00');

                let current = new Date(start);
                while (current <= end) {
                    dates.add(formatDate(current));
                    current.setDate(current.getDate() + 1);
                }
            });

            searchResultDates = Array.from(dates);
            return matchedEvents;
        }

        /**
         * Menangani aksi pencarian (tombol klik atau Enter)
         */
        function handleSearch() {
            const query = searchInputElement.value.trim();
            activeSearchQuery = query;
            const results = searchEvents(query);

            // 1. Atur activeDateString ke kosong agar tidak ada tanggal aktif tunggal
            activeDateString = ''; // PERBAIKAN: Hapus status aktif tunggal

            // 2. Selalu beralih ke mode pencarian
            setViewMode('search');

            // 3. Render kalender (ini yang akan menerapkan highlight)
            renderCalendar();

            // 4. Tampilkan hasilnya di panel rincian
            renderSearchResults(results);
        }

        /**
         * Fungsi untuk merender daftar hasil pencarian.
         */
        function renderSearchResults(results) {
            loadingElement.classList.remove('hidden');

            setTimeout(() => {
                loadingElement.classList.add('hidden');

                let detailsContent;

                if (results.length > 0) {
                    const totalCount = results.length;

                    detailsContent = `
                        <div class="space-y-6">
                            <div class="p-4 bg-primary/5 rounded-lg border border-primary/20 mb-6">
                                <h3 class="text-2xl font-bold text-primary mb-2">Hasil Pencarian: "${activeSearchQuery}"</h3>
                                <p class="text-lg text-gray-700">Ditemukan <span class="font-extrabold"> ${totalCount} acara</span> yang judulnya cocok.</p>
                            </div>

                            <div class="space-y-8">
                                ${results.map(event => {
                        const isMultiDay = event.startDate !== event.endDate;
                        const dateDisplay = isMultiDay
                            ? `<span class="font-semibold text-gray-700">Durasi: &nbsp;</span> ${getShortDateDisplay(event.startDate)} - ${getShortDateDisplay(event.endDate)}`
                            : `<span class="font-semibold text-gray-700">Tanggal: &nbsp;</span> ${getShortDateDisplay(event.startDate)}`;

                        return `
                                        <div class="p-6 border border-gray-200 rounded-lg shadow-md bg-white">
                                            <h4 class="text-2xl font-bold text-gray-900 mb-2">${event.title}</h4>

                                            <!-- Durasi Acara -->
                                            <div class="text-sm mb-3 p-2 rounded-lg bg-gray-100 border border-gray-200 flex items-center justify-between">
                                                <span class="text-sm text-gray-600 flex items-center">
                                                    <svg class="w-4 h-4 mr-1 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                                    ${dateDisplay}
                                                </span>

                                                <!-- Kategori menggunakan kelas Tailwind marker color -->
                                                <span class="px-3 py-1 bg-${event.markerColor} text-white rounded-full text-xs font-semibold shadow-md">
                                                    ${event.category}
                                                </span>
                                            </div>

                                            <p class="text-gray-700 leading-relaxed">${event.description}</p>
                                        </div>
                                    `
                    }).join('<div class="h-px bg-gray-200 my-6"></div>')}
                            </div>
                        </div>
                    `;
                } else {
                    detailsContent = `
                        <div class="p-8 bg-amber-50 rounded-lg border border-amber-200">
                            <h3 class="text-2xl font-bold text-amber-700 mb-2">Pencarian Tidak Ditemukan</h3>
                            <p class="text-lg text-amber-600">
                                Tidak ada acara yang cocok dengan kata kunci "${activeSearchQuery}".
                            </p>
                            <p class="mt-2 text-gray-600">Coba kata kunci lain atau pilih tanggal di kalender.</p>
                        </div>
                    `;
                }

                detailsElement.innerHTML = detailsContent;

            }, 300);
        }

        /**
         * Fungsi untuk beralih tampilan antara rincian tanggal terpilih dan hasil pencarian.
         */
        function setViewMode(mode, internalCall = false) {
            currentViewMode = mode;

            // Update tampilan tombol tab
            const tabs = [tabSelectedDate, tabSearchResults];
            tabs.forEach(tab => {
                tab.classList.remove('bg-secondary', 'text-white', 'shadow-md');
                tab.classList.add('text-gray-700', 'hover:bg-gray-200');
            });

            if (mode === 'search') {
                tabSearchResults.classList.add('bg-secondary', 'text-white', 'shadow-md');
                tabSearchResults.classList.remove('text-gray-700', 'hover:bg-gray-200');

                // Hapus aktif tunggal (agar semua highlight hasil pencarian terlihat sama)
                document.querySelectorAll('.calendar-day.active').forEach(item => {
                    item.classList.remove('active', 'text-white');
                    item.classList.add('text-gray-800');
                });

                // Jika ini bukan panggilan internal, jalankan pencarian
                if (!internalCall) {
                    const results = searchEvents(activeSearchQuery);
                    renderSearchResults(results);
                }
                renderCalendar();
            } else { // mode === 'selected'
                tabSelectedDate.classList.add('bg-secondary', 'text-white', 'shadow-md');
                tabSelectedDate.classList.remove('text-gray-700', 'hover:bg-gray-200');

                // Nonaktifkan highlight pencarian
                activeSearchQuery = '';
                searchResultDates = [];
                renderCalendar();

                // Tampilkan rincian untuk tanggal yang terakhir dipilih HANYA JIKA BUKAN dipanggil secara internal.
                if (activeDateString && !internalCall) {
                    const events = EVENTS_DATA_MAP.get(activeDateString) || [];
                    displayEventDetails(events, true); // KIRIM FLAG untuk mencegah panggilan balik
                } else if (!activeDateString) {
                    detailsElement.innerHTML = `<p class="text-gray-500 italic p-4 bg-amber-50 rounded-lg border border-amber-200">
                        Silakan pilih tanggal dari kalender untuk melihat rincian.
                    </p>`;
                }
            }
        }

        function getUpcomingEventsForDisplay(dateString) {
            const upcomingEvents = new Map(); // Map untuk mengelompokkan berdasarkan tanggal

            const selectedDate = new Date(dateString + 'T00:00:00');
            const tomorrow = new Date(selectedDate);
            tomorrow.setDate(selectedDate.getDate() + 1); // Mulai dari hari berikutnya

            const thirtyDaysLater = new Date(tomorrow);
            thirtyDaysLater.setDate(tomorrow.getDate() + 30); // Batas 30 hari

            let current = new Date(tomorrow);

            while (current < thirtyDaysLater) {
                const currentDateString = formatDate(current);
                const eventsOnDate = EVENTS_DATA_MAP.get(currentDateString) || [];

                const actualEvents = eventsOnDate.filter(e => e.hasEvent);

                if (actualEvents.length > 0) {
                    // Kumpulkan judul acara unik untuk tanggal ini
                    const uniqueTitles = [...new Set(actualEvents.map(e => e.title))];
                    const markers = [...new Set(actualEvents.map(e => e.markerColor))].slice(0, 3);

                    upcomingEvents.set(currentDateString, {
                        titles: uniqueTitles,
                        markers: markers
                    });
                }
                current.setDate(current.getDate() + 1);
            }
            return upcomingEvents;
        }

        /**
         * Fungsi untuk menampilkan rincian acara di panel kanan (Mode Tanggal Terpilih).
         */
        function displayEventDetails(events, fromSetViewMode = false) {
            loadingElement.classList.remove('hidden');

            const dateString = activeDateString;
            const displayDateText = getLongDateDisplay(dateString);

            // JIKA mode beralih dari search ke selected, pastikan mode tab diatur.
            // Mencegah Rekursi: HANYA panggil setViewMode jika kita TIDAK datang dari setViewMode.
            if (!fromSetViewMode) {
                // Panggil setViewMode untuk memperbarui tampilan tab dan KIRIM FLAG untuk mencegah panggilan balik.
                setViewMode('selected', true);
            }

            setTimeout(() => {
                loadingElement.classList.add('hidden');

                let detailsContent;

                if (events.length > 0 && events.some(e => e.hasEvent)) {
                    // --- TAMPILAN JIKA ADA ACARA PADA TANGGAL INI ---
                    const actualEvents = events.filter(e => e.hasEvent);

                    detailsContent = `
                        <div class="space-y-6">
                            <p class="text-sm font-medium text-primary uppercase tracking-wider pb-3 border-b-2 border-primary/50">
                                Acara Terjadwal pada Tanggal: ${displayDateText}
                            </p>

                            <div class="space-y-8 max-h-80 overflow-y-auto pr-2">
                                ${actualEvents.map((event, index) => {
                        const isMultiDay = event.startDate !== event.endDate;
                        const dateDisplay = isMultiDay
                            ? `<span class="font-semibold text-gray-700">Durasi : &nbsp;</span> ${getShortDateDisplay(event.startDate)} - ${getShortDateDisplay(event.endDate)}`
                            : `<span class="font-semibold text-gray-700">Tanggal : &nbsp;</span> ${getShortDateDisplay(event.startDate)}`;

                        return `
                                        <div class="p-6 border border-gray-200 rounded-lg shadow-md bg-white">
                                            <h4 class="text-2xl font-bold text-gray-900 mb-2">${event.title}</h4>

                                            <!-- Durasi Acara -->
                                            <div class="text-sm mb-3 p-2 rounded-lg bg-gray-100 border border-gray-200 flex items-center justify-between">
                                                <span class="text-sm text-gray-600 flex items-center">
                                                    <svg class="w-4 h-4 mr-1 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                                    ${dateDisplay}
                                                </span>

                                                <!-- Kategori menggunakan kelas Tailwind marker color -->
                                                <span class="px-3 py-1 bg-${event.markerColor} text-white rounded-full text-xs font-semibold shadow-md">
                                                    ${event.category}
                                                </span>
                                            </div>

                                            <div class="flex flex-wrap gap-x-4 gap-y-2 text-sm mb-3">

                                                <!-- Waktu -->
                                                <span class="font-medium text-gray-600 flex items-center">
                                                    <svg class="w-4 h-4 mr-1 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                    ${event.time}
                                                </span>

                                                <!-- Lokasi -->
                                                <span class="font-medium text-gray-600 flex items-center">
                                                    <svg class="w-4 h-4 mr-1 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                                    ${event.location}
                                                </span>
                                            </div>
                                            <h5 class="text-lg font-semibold text-gray-800 mt-4 mb-1">Deskripsi:</h5>
                                            <p class="text-gray-700 leading-relaxed">${event.description}</p>
                                        </div>
                                    `
                    }).join('<div class="h-px bg-gray-200 my-6"></div>')}
                            </div>

                            <div class="mt-6 p-4 bg-primary/10 rounded-lg border-l-4 border-primary">
                                <p class="font-semibold text-primary">Total Acara Hari Ini:</p>
                                <p class="text-sm text-gray-700">${actualEvents.length} acara terdaftar pada tanggal ini.</p>
                            </div>
                        </div>
                    `;

                } else {
                    const upcomingEventsMap = getUpcomingEventsForDisplay(dateString);
                    let upcomingContent = '';

                    if (upcomingEventsMap.size > 0) {
                        upcomingContent = `
                            <h4 class="font-bold text-primary mt-6 mb-4 border-t pt-4">Acara Mendatang (30 Hari ke Depan)</h4>
                            <div class="space-y-4 max-h-80 overflow-y-auto pr-2">
                                ${Array.from(upcomingEventsMap.entries()).map(([dateStr, data]) => `
                                        <div class="p-4 bg-white rounded-xl shadow-md flex gap-4 items-start transition hover:shadow-lg">

                                            <!-- Format Tanggal Besar (Tanggal & Bulan) -->
                                            <div class="flex flex-col items-center justify-center text-center bg-gray-50 border border-gray-200 rounded-lg p-2 flex-shrink-0 w-16 h-16 shadow-inner">
                                                <span class="text-2xl font-bold text-primary leading-none">${getDayOfMonth(dateStr)}</span>
                                                <span class="text-xs font-semibold text-gray-600 uppercase mt-0.5">${getShortMonthName(dateStr)}</span>
                                            </div>

                                            <div class="flex-1 min-w-0">
                                                <p class="font-semibold text-gray-900 text-base">${data.titles.join('; ')}</p>
                                                <p class="text-xs text-gray-500 mb-2">${getLongDateDisplay(dateStr).split(', ')[0]}</p>
                                                <!-- Markers -->
                                                <div class="flex gap-1 items-center">
                                                    ${data.markers.map(color => `<span class="h-3 w-3 rounded-full bg-${color}"></span>`).join('')}
                                                </div>
                                            </div>
                                        </div>
                                    `).join('')}
                            </div>
                            <p class="text-sm text-gray-500 mt-4 italic">Total ${upcomingEventsMap.size} hari dengan acara dalam 30 hari ke depan.</p>
                        `;
                    } else {
                        upcomingContent =
                            `<p class="mt-4 text-gray-600 italic">Tidak ada acara terjadwal dalam 30 hari ke depan setelah tanggal ini.</p>`;
                    }

                    detailsContent = `
                        <div class="p-8 bg-teal-50 rounded-lg border border-teal-200">
                            <h3 class="text-lg font-bold text-teal-700 mb-2">Tanggal: ${displayDateText}</h3>
                            <p class="text-teal-600">
                                Tidak ada acara atau pengumuman spesifik yang terjadwal hari ini.
                            </p>
                            ${upcomingContent}
                        </div>
                    `;
                }

                detailsElement.innerHTML = detailsContent;
            }, 500);
        }

        /**
         * Fungsi untuk menangani klik pada sel kalender.
         */
        function handleDateClick(dateString) {
            // 1. Hapus status 'active' dari semua sel
            document.querySelectorAll('.calendar-day').forEach(item => {
                item.classList.remove('active', 'text-white');
                // Tambahkan lagi warna teks default jika tidak ada active class
                item.classList.add('text-gray-800');
            });
            // Hapus semua highlight pencarian jika pengguna mengklik tanggal tertentu
            document.querySelectorAll('.calendar-day.search-highlight').forEach(item => {
                item.classList.remove('search-highlight');
            });
            searchResultDates = []; // Hapus data highlight pencarian
            activeSearchQuery = ''; // Hapus query pencarian
            searchInputElement.value = ''; // Kosongkan input

            // 2. Tambahkan status 'active' ke sel yang diklik
            const activeCell = document.querySelector(`[data-date="${dateString}"]`);
            if (activeCell) {
                activeCell.classList.add('active');
                activeCell.classList.remove('text-gray-800');
            }

            // 3. Update active date
            activeDateString = dateString;

            // 4. Selalu tampilkan rincian tanggal terpilih setelah klik tanggal
            const events = EVENTS_DATA_MAP.get(dateString) || [];
            displayEventDetails(events);
        }


        /**
         * Fungsi utama untuk merender tampilan kalender.
         */
        function renderCalendar() {
            const year = currentDate.getFullYear();
            const month = currentDate.getMonth();

            currentMonthYearElement.textContent = `${MONTH_NAMES[month]} ${year}`;

            const firstDayOfMonth = new Date(year, month, 1).getDay();
            const daysInMonth = new Date(year, month + 1, 0).getDate();

            calendarGridElement.innerHTML = '';

            for (let i = 0; i < firstDayOfMonth; i++) {
                const emptyCell = document.createElement('div');
                emptyCell.className = 'calendar-day';
                calendarGridElement.appendChild(emptyCell);
            }

            for (let day = 1; day <= daysInMonth; day++) {
                const date = new Date(year, month, day);
                const dateString = formatDate(date);
                const eventsOnDate = EVENTS_DATA_MAP.get(dateString);

                const isEvent = eventsOnDate && eventsOnDate.some(e => e.hasEvent);

                // --- LOGIKA MULTI-TITIK ---
                let markerColors = [];
                if (isEvent) {
                    const allColors = eventsOnDate
                        .filter(e => e.hasEvent && e.markerColor)
                        .map(e => e.markerColor);

                    // Filter warna unik dan batasi maksimal 3 titik
                    markerColors = [...new Set(allColors)].slice(0, 3);
                }

                // Membangun HTML marker menggunakan kelas Tailwind langsung
                const markersHtml = markerColors.map(colorName =>
                    // colorName seperti 'marker-red' digunakan sebagai bagian dari kelas
                    `<span class="event-marker bg-${colorName} transition duration-150"></span>`
                ).join('');

                // --- END LOGIKA MULTI-TITIK ---

                // --- LOGIKA HIGHLIGHT PENCARIAN ---
                const isSearchMatch = searchResultDates.includes(dateString);

                let cellClasses = `calendar-day relative group`; // Hapus text-gray-800 dari sini

                if (dateString === activeDateString) {
                    cellClasses += ' active text-white';
                } else {
                    cellClasses += ' text-gray-800'; // Default text color
                }

                // Jika hasil pencarian, tambahkan highlight
                if (isSearchMatch) {
                    cellClasses += ' search-highlight';
                    // Karena search-highlight memiliki aturan warna teks di CSS, kita tidak perlu menambahkan text-white di sini.
                }

                const cell = document.createElement('div');
                cell.className = cellClasses;
                cell.setAttribute('data-date', dateString);
                cell.setAttribute('title', isEvent ? `${eventsOnDate.filter(e => e.hasEvent).length} Acara` :
                    'Tidak ada acara');
                cell.setAttribute('role', 'button');

                cell.innerHTML = `
                    <span class="calendar-day-number">${day}</span>
                    <div class="event-marker-container">
                        ${markersHtml}
                    </div>
                `;

                cell.addEventListener('click', () => handleDateClick(dateString));
                calendarGridElement.appendChild(cell);
            }
        }

        /**
         * Fungsi untuk mengubah bulan (navigasi)
         */
        function changeMonth(delta) {
            // Hapus semua visual highlight saat berpindah bulan
            document.querySelectorAll('.calendar-day.active').forEach(item => {
                item.classList.remove('active', 'text-white');
            });
            document.querySelectorAll('.calendar-day.search-highlight').forEach(item => {
                item.classList.remove('search-highlight');
            });

            // Atur ulang status pencarian
            activeSearchQuery = '';
            searchResultDates = [];
            searchInputElement.value = '';


            currentDate.setMonth(currentDate.getMonth() + delta);
            renderCalendar();

            // Atur view mode kembali ke selected (default)
            setViewMode('selected');

            // Tampilkan pesan default di rincian
            detailsElement.innerHTML = `<p class="text-gray-500 italic p-4 bg-amber-50 rounded-lg border border-amber-200">
                Silakan pilih tanggal dari kalender di sebelah kiri untuk melihat deskripsi acara secara lengkap.
            </p>`;
        }

        // Setup Event Listeners untuk Navigasi
        prevMonthBtn.addEventListener('click', () => changeMonth(-1));
        nextMonthBtn.addEventListener('click', () => changeMonth(1));
        searchInputElement.addEventListener('keyup', (event) => {
            if (event.key === 'Enter') {
                handleSearch();
            }
        });
        document.getElementById('search-button').addEventListener('click', handleSearch);


        // Inisialisasi: Render kalender dan set view default ke Rincian Tanggal Terpilih (Tanggal 1)
        window.onload = () => {
            // Set tanggal aktif default untuk kalender
            activeDateString = TODAY_DATE_STRING;
            renderCalendar();
            // Default view: Rincian Tanggal Terpilih
            setViewMode('selected');
        };
    </script>
@endpush
