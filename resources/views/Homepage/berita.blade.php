<style>
    /* Custom Scrollbar untuk Modal */
    .custom-scrollbar::-webkit-scrollbar {
        width: 8px;
    }

    .custom-scrollbar::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 4px;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }

    /* Swiper Pagination Bullet Custom Color */
    .swiper-pagination-bullet-active {
        background-color: #3396D3 !important;
    }
</style>
<div class="">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-12">
        <div class="w-24 h-1 bg-primary mb-4"></div>
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-gray-800 items-center flex">Berita<span
                    class="text-secondary">&nbsp;Terbaru</span></h2>
            <a href="{{route('landing.berita')}}" class="text-primary font-semibold">SELENGKAPNYA</a>
        </div>
    </div>
    {{-- <div class="relative md:mx-32 mx-16"> --}}
    <div class="relative px-4 md:px-24 md:mx-5 mb-10">
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                @foreach ($news as $berita)
                    <div class="swiper-slide h-auto">
                        <div
                            class="bg-white rounded-xl shadow-lg border border-slate-100 overflow-hidden h-full flex flex-col transform hover:-translate-y-2 transition-all duration-300">
                            <!-- Image Wrapper (ADDED overflow-hidden) -->
                            <div class="relative w-full h-56 flex-shrink-0 group overflow-hidden">
                                <img src="{{ Storage::url($berita->image) }}" alt="Kegiatan Sekolah"
                                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                                <!-- Gradient Overlay & Title -->
                                <div
                                    class="absolute inset-x-0 bottom-0 h-2/3 bg-gradient-to-t from-black/90 via-black/50 to-transparent flex items-end p-5 pointer-events-none">
                                    <h3 class="text-lg font-bold text-white leading-snug line-clamp-2 drop-shadow-md">
                                        {{ $berita->title }}
                                    </h3>
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="p-5 flex flex-col flex-grow card-content-wrapper">
                                <div class="flex-grow">
                                    <div class="flex items-center text-sm text-gray-500 mb-4 gap-3">
                                        <span
                                            class="bg-secondary text-white px-2.5 py-0.5 rounded-full text-xs font-bold uppercase tracking-wide">Admin</span>
                                        <div class="flex items-center">
                                            <i data-lucide="calendar" class="w-3.5 h-3.5 mr-1.5"></i>
                                            <span>{{ \Carbon\Carbon::parse($berita->created_at)->format('d M Y') }}</span>
                                        </div>
                                    </div>
                                    <p class="text-slate-600 mb-4 text-sm leading-relaxed text-justify line-clamp-3">
                                        {{ Str::limit($berita->description, 150) }}
                                    </p>
                                </div>

                                <!-- Hidden Full Content for Modal -->
                                <div class="hidden hidden-full-content">
                                    {{ $berita->content }}
                                </div>

                                <button onclick="openNewsModal(this)" data-title="{{ $berita->title }}"
                                    data-image="{{ Storage::url($berita->image) }}"
                                    data-date="{{ \Carbon\Carbon::parse($berita->date)->format('d M Y') }}"
                                    class="w-full mt-auto inline-flex justify-center items-center bg-primary text-white px-4 py-2.5 rounded-lg text-sm font-semibold hover:bg-secondary hover:text-white transition-colors duration-200 shadow-sm hover:shadow-md">
                                    Baca Selengkapnya
                                </button>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="swiper-slide">
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
                    </div> --}}
                @endforeach
            </div>
        </div>
        <div class="swiper-pagination"></div>
        <button class="swiper-button-prev"></button>
        <button class="swiper-button-next"></button>
    </div>
    <div id="newsModal" class="fixed inset-0 z-[9999] hidden" aria-labelledby="modal-title" role="dialog"
        aria-modal="true">
        <!-- Backdrop -->
        <div class="fixed inset-0 bg-gray-900/70 backdrop-blur-sm transition-opacity" onclick="closeNewsModal()">
        </div>

        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">

                <!-- Modal Panel -->
                <div
                    class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-3xl border border-gray-100">

                    <!-- Close Button -->
                    <button type="button" onclick="closeNewsModal()"
                        class="absolute top-4 right-4 z-20 p-2 bg-white/80 hover:bg-white rounded-full text-slate-500 hover:text-red-500 transition-colors shadow-sm backdrop-blur-sm">
                        <i data-lucide="x" class="w-6 h-6"></i>
                    </button>

                    <!-- Content -->
                    <div class="bg-white flex flex-col max-h-[90vh]">
                        <!-- Image -->
                        <div class="relative h-64 sm:h-80 w-full bg-gray-900 flex-shrink-0">
                            <img id="modalImage" src="" alt="Detail Berita"
                                class="w-full h-full object-contain">
                            {{-- <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent">
                            </div> --}}
                            {{-- <div class="absolute bottom-0 left-0 p-6 sm:p-8 w-full">
                            </div> --}}
                        </div>

                        <!-- Body -->
                        <div class="px-6 py-6 sm:px-8 overflow-y-auto custom-scrollbar">
                            <h3 id="modalTitle"
                                class="text-xl sm:text-2xl font-bold text-black leading-tight drop-shadow-lg mb-3">
                            </h3>
                            <div class="flex items-center gap-3 mb-6 border-b border-third pb-4">
                                <span
                                    class="bg-secondary text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide">Berita
                                    Sekolah</span>
                                <div class="flex items-center text-slate-500 text-sm font-medium">
                                    <i data-lucide="calendar" class="w-4 h-4 mr-2 text-primary"></i>
                                    <span id="modalDate"></span>
                                </div>
                            </div>

                            <div
                                class="prose prose-slate max-w-none text-slate-600 leading-relaxed text-justify text-lg">
                                <div id="modalDescription"></div>
                            </div>
                        </div>

                        <!-- Footer -->
                        <div class="bg-gray-50 px-6 py-4 border-t border-gray-100 flex justify-end">
                            <button type="button" onclick="closeNewsModal()"
                                class="inline-flex justify-center rounded-lg bg-white px-6 py-2.5 text-sm font-semibold text-slate-700 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 hover:text-primary transition-all">
                                Tutup
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function openNewsModal(element) {
        const title = element.getAttribute('data-title');
        const image = element.getAttribute('data-image');
        const date = element.getAttribute('data-date');

        // Get content from hidden div
        const content = element.closest('.card-content-wrapper').querySelector('.hidden-full-content').innerHTML;

        // Set Modal Content
        document.getElementById('modalTitle').innerText = title;
        document.getElementById('modalImage').src = image;
        document.getElementById('modalDate').innerText = date;
        document.getElementById('modalDescription').innerHTML = content;

        // Show Modal
        const modal = document.getElementById('newsModal');
        modal.classList.remove('hidden');

        // Disable body scroll
        document.body.style.overflow = 'hidden';
    }

    function closeNewsModal() {
        const modal = document.getElementById('newsModal');
        modal.classList.add('hidden');

        // Enable body scroll
        document.body.style.overflow = 'auto';
    }

    // Close on ESC key
    document.addEventListener('keydown', function(event) {
        if (event.key === "Escape") {
            closeNewsModal();
        }
    });
</script>
