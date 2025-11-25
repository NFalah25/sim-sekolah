<div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-12">
        <div class="w-24 h-1 bg-primary mb-4"></div>
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-gray-800 items-center flex">Berita<span
                    class="text-secondary">&nbsp;Terbaru</span></h2>
            <a href="#" class="text-primary font-semibold">SELENGKAPNYA</a>
        </div>
    </div>
    <div class="relative md:mx-32 mx-16">
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                @foreach ($news as $berita)
                    <div class="swiper-slide">
                        <div
                            class="bg-white rounded-lg shadow-md overflow-hidden transform hover:scale-105 transition-transform duration-300 ease-in-out">
                            <div class="relative w-full h-48">
                                <img src="{{ asset($berita->image) }}" alt="{{ $berita->title }}"
                                    class="w-full h-full object-cover rounded-t-lg">
                                <div
                                    class="absolute inset-x-0 bottom-0 h-1/2 bg-gradient-to-t from-black via-black/50 to-transparent flex items-end p-4">
                                    <h3 class="text-xl font-bold text-white">{{ $berita->title }}</h3>
                                </div>
                            </div>
                            <div class="card-content-wrapper p-4 bg-white rounded-b-lg">
                                <div class="card-text-container mb-6">
                                    <div class="flex items-center text-sm text-gray-600 mb-3">
                                        <span
                                            class="bg-[#EBCB90] text-white px-2 py-1 rounded-full text-xs font-semibold mr-2">Admin</span>
                                        <span>{{ \Carbon\Carbon::parse($berita->created_at)->isoFormat('D MMMM YYYY') }}</span>
                                    </div>
                                    <p class="text-gray-700 mb-4 text-base text-justify">
                                        {{ Str::limit($berita->description, 100) }}
                                    </p>
                                </div>
                                <a href="#"
                                    class="read-more-link inline-block bg-primary text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-secondary hover:text-gray-600 transition-colors duration-200">
                                    Baca Selengkapnya
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="swiper-pagination"></div>
        <button class="swiper-button-prev"></button>
        <button class="swiper-button-next"></button>
    </div>
</div>

