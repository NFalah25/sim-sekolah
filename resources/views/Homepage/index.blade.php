@extends('Layout.app')

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <style>

        .card-content-wrapper {
            position: relative;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .card-text-container {
            flex-grow: 1;
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
                @foreach ($heroes as $hero)
                    <div class="relative flex-shrink-0 w-full h-full">
                        <img src="{{ Storage::url($hero->image) }}" alt="Gambar Hero"
                             class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-black opacity-50"></div>
                    </div>
                @endforeach

                {{-- <div class="relative flex-shrink-0 w-full h-full">
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
                </div> --}}
            </div>
            <div
                class="absolute top-1/3 md:top-1/2 md:left-1/2 transform md:-translate-x-1/2 md:-translate-y-1/2 text-center text-white z-20 md:p-16 px-2">
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
                    class="mt-8 px-2 py-2 md:px-6 md:py-3 text-sm md:text-md bg-primary hover:bg-[#296B99] text-white font-semibold rounded-lg shadow-md transition-colors duration-300" onclick="window.location.href='#pengumuman'">
                    Selengkapnya
                </button>
            </div>
            <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-2 z-20" id="button-slider">
                @foreach ($heroes as $hero => $value)
                    <button
                        class="w-3 h-3 rounded-full bg-white opacity-50 hover:opacity-100 transition-opacity duration-300"
                        onclick="showSlide({{ $hero }})"></button>
                @endforeach
                {{-- <button
                    class="w-3 h-3 rounded-full bg-white opacity-50 hover:opacity-100 transition-opacity duration-300"
                    onclick="showSlide(0)"></button>
                <button
                    class="w-3 h-3 rounded-full bg-white opacity-50 hover:opacity-100 transition-opacity duration-300"
                    onclick="showSlide(1)"></button>
                <button
                    class="w-3 h-3 rounded-full bg-white opacity-50 hover:opacity-100 transition-opacity duration-300"
                    onclick="showSlide(2)"></button> --}}
            </div>
        </div>
        {{-- berita --}}
        @include('Homepage.berita')

        {{-- Pengumuman --}}
        @include('Homepage.pengumuman')

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


    </script>
@endpush
