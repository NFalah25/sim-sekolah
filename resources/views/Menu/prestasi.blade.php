@extends('Layout.app')

@section('content')
    <main class="flex-grow w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-12">

        <!-- Header -->
        <div class="flex flex-col md:flex-row justify-between items-end mb-10 gap-4">
            <div>
                <h1 class="text-2xl md:text-3xl font-extrabold text-slate-800 uppercase tracking-tight">
                    ARSIP: <span class="text-primary">PRESTASI</span>
                </h1>
                <p class="text-slate-500 mt-2 font-medium">Rekam jejak kebanggaan siswa-siswi SD Negeri JuwetKenongo.
                </p>
            </div>

            <!-- Search -->
            <div class="relative w-full md:w-64">
                <input type="text" placeholder="Cari prestasi..." id="search"
                    class="w-full pl-10 pr-4 py-2 bg-white border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all">
                <i data-lucide="search" class="absolute left-3 top-2.5 h-4 w-4 text-gray-400"></i>
            </div>
        </div>

        <!-- Grid Prestasi -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12 items-start">

            @forelse ($prestasi as $data)
                <article
                    class="achievement-card bg-white rounded-xl overflow-hidden flex flex-col h-full cursor-pointer group"
                    onclick="openModal(this)">
                    <div class="img-wrapper relative h-48 bg-gray-100 flex-shrink-0">
                        <img src="{{ asset('storage/' . $data->image) }}" alt="Thumbnail"
                            class="w-full h-full object-cover">
                        <div
                            class="absolute inset-0 bg-primary/0 group-hover:bg-primary/20 transition-colors flex items-center justify-center">
                            <i data-lucide="zoom-in"
                                class="text-white opacity-0 group-hover:opacity-100 transition-opacity transform scale-75 group-hover:scale-100 w-8 h-8 drop-shadow-md"></i>
                        </div>

                        <!-- Hidden Data -->
                        <div class="hidden modal-data-desc">
                            {!! nl2br(e($data->description)) !!}
                        </div>
                        <div class="hidden modal-data-full-img">
                            {{ asset('storage/' . $data->image) }}</div>
                    </div>

                    <div class="p-5 flex flex-col flex-grow">
                        <!-- Wrapper untuk animasi judul -->
                        <div class="achievement-title-wrapper">
                            <h2
                                class="achievement-title text-base font-bold text-slate-900 leading-snug mb-3 group-hover:text-primary transition-colors modal-data-title">
                                {{ $data->title }}
                            </h2>
                        </div>

                        <div class="mt-auto flex items-center gap-3 pt-4 border-t border-third">
                            <span
                                class="bg-primary text-white text-[10px] font-bold px-2 py-1 rounded tracking-wide">Admin</span>
                            <span
                                class="text-xs text-gray-500 font-medium modal-data-date">{{ \Carbon\Carbon::parse($data->date)->isoFormat('D MMMM YYYY') }}</span>
                        </div>
                    </div>
                </article>
            @empty
                <p class="text-center text-gray-500 col-span-full">Tidak ada prestasi yang ditemukan.</p>
            @endforelse
        </div>

        <!-- Pagination -->
        @if ($prestasi->count() > 0)
            <div class="flex flex-col items-center justify-center space-y-4">

                <div
                    class="bg-white rounded-full shadow-lg shadow-slate-200/50 px-2 py-2 flex items-center space-x-1 border border-slate-50">

                    <!-- Tombol Previous -->
                    <a href="{{ $prestasi->previousPageUrl() }}"
                        class="w-10 h-10 flex items-center justify-center rounded-full text-slate-400 hover:text-primary hover:bg-slate-50 transition-all duration-200 group">
                        <i data-lucide="chevron-left" class="w-5 h-5 group-hover:-translate-x-0.5 transition-transform"></i>
                    </a>

                    @php
                        $currentPage = $prestasi->currentPage();
                        $lastPage = $prestasi->lastPage();
                        $pagesToShow = 5;
                    @endphp

                    @if ($lastPage > $pagesToShow)
                        <a href="{{ $prestasi->url(1) }}"
                            class="w-10 h-10 flex items-center justify-center rounded-full {{ $currentPage == 1 ? 'bg-primary text-white shadow-md shadow-blue-200 font-semibold hover:bg-primary-dark' : 'text-slate-400 hover:text-primary hover:bg-slate-50 transition-all duration-200 group' }}">
                            1
                        </a>

                        @if ($currentPage > 3)
                            <span class="text-slate-400">...</span>
                        @endif

                        @foreach (range(max(2, $currentPage - 2), min($lastPage - 1, $currentPage + 2)) as $page)
                            <a href="{{ $prestasi->url($page) }}"
                                class="w-10 h-10 flex items-center justify-center rounded-full {{ $page == $currentPage ? 'bg-primary text-white shadow-md shadow-blue-200 font-semibold hover:bg-primary-dark' : 'text-slate-400 hover:text-primary hover:bg-slate-50 transition-all duration-200 group' }}">
                                {{ $page }}
                            </a>
                        @endforeach

                        @if ($currentPage < $lastPage - 2)
                            <span class="text-slate-400">...</span>
                        @endif

                        <a href="{{ $prestasi->url($lastPage) }}"
                            class="w-10 h-10 flex items-center justify-center rounded-full {{ $currentPage == $lastPage ? 'bg-primary text-white shadow-md shadow-blue-200 font-semibold hover:bg-primary-dark' : 'text-slate-400 hover:text-primary hover:bg-slate-50 transition-all duration-200 group' }}">
                            {{ $lastPage }}
                        </a>
                    @else
                        @foreach (range(1, $lastPage) as $page)
                            <a href="{{ $prestasi->url($page) }}"
                                class="w-10 h-10 flex items-center justify-center rounded-full {{ $page == $currentPage ? 'bg-primary text-white shadow-md shadow-blue-200 font-semibold hover:bg-primary-dark' : 'text-slate-400 hover:text-primary hover:bg-slate-50 transition-all duration-200 group' }}">
                                {{ $page }}
                            </a>
                        @endforeach
                    @endif

                    <a href="{{ $prestasi->nextPageUrl() }}"
                        class="w-10 h-10 flex items-center justify-center rounded-full text-slate-400 hover:text-primary hover:bg-slate-50 transition-all duration-200 group">
                        <i data-lucide="chevron-right" class="w-5 h-5 group-hover:translate-x-0.5 transition-transform"></i>
                    </a>
                </div>

                <p class="text-xs text-slate-400 font-medium">
                    Menampilkan {{ $prestasi->firstItem() }} - {{ $prestasi->lastItem() }} dari total
                    {{ $prestasi->total() }} prestasi
                </p>
            </div>
        @endif


    </main>
    <div id="achievement-modal"
        class="fixed inset-0 z-[100] flex items-center justify-center bg-black/80 backdrop-blur-sm hidden p-4">
        <!-- Overlay Click to Close -->
        <div class="absolute inset-0" onclick="closeModal()"></div>

        <!-- Modal Content Container -->
        <div
            class="modal-content relative bg-white rounded-2xl shadow-2xl w-full max-w-4xl max-h-[90vh] flex flex-col overflow-hidden">

            <!-- Close Button -->
            <button onclick="closeModal()"
                class="absolute top-4 right-4 z-20 p-2 bg-black/50 hover:bg-black/70 rounded-full text-white transition-colors backdrop-blur">
                <i data-lucide="x" class="w-6 h-6"></i>
            </button>

            <!-- Scrollable Body -->
            <div class="overflow-y-auto custom-scrollbar flex flex-col h-full">

                <!-- Full Image Section -->
                <div class="w-full bg-slate-900 flex items-center justify-center min-h-[300px] md:min-h-[400px] p-4">
                    <img id="modal-image" src="" alt="Detail Prestasi"
                        class="max-w-full max-h-[60vh] object-contain rounded-lg shadow-lg">
                </div>

                <!-- Text Content Section -->
                <div class="p-6 md:p-8 bg-white flex-grow">
                    <div class="flex items-center gap-3 mb-3">
                        <span
                            class="bg-secondary text-slate-900 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide">Prestasi</span>
                        <div class="flex items-center text-slate-400 text-xs font-medium">
                            <i data-lucide="calendar" class="w-3.5 h-3.5 mr-1.5"></i>
                            <span id="modal-date"></span>
                        </div>
                    </div>

                    <h2 id="modal-title" class="text-2xl md:text-3xl font-bold text-slate-900 mb-6 leading-tight">
                    </h2>

                    <div class="prose prose-slate max-w-none">
                        <p id="modal-desc" class="text-slate-600 leading-relaxed text-lg"></p>
                    </div>

                    <!-- Share Section -->
                    <div class="mt-8 pt-6 border-t border-gray-100 flex items-center gap-4">
                        <span class="text-sm text-slate-500 font-medium">Bagikan prestasi ini:</span>
                        <div class="flex gap-2">
                            <button
                                class="w-10 h-10 rounded-full bg-third flex items-center justify-center text-primary hover:bg-primary hover:text-white transition-colors">
                                <i data-lucide="facebook" class="w-4 h-4"></i>
                            </button>
                            <button
                                class="w-10 h-10 rounded-full bg-third flex items-center justify-center text-primary hover:bg-primary hover:text-white transition-colors">
                                <i data-lucide="twitter" class="w-4 h-4"></i>
                            </button>
                            <button
                                class="w-10 h-10 rounded-full bg-third flex items-center justify-center text-primary hover:bg-primary hover:text-white transition-colors">
                                <i data-lucide="link" class="w-4 h-4"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        .achievement-card {
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1), box-shadow 0.3s ease;
            border: 1px solid #f1f5f9;
            will-change: transform, box-shadow;
        }

        .achievement-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px -5px rgba(51, 150, 211, 0.2), 0 10px 10px -6px rgba(51, 150, 211, 0.1);
            border-color: #3396D3;
            z-index: 10;
        }

        /* Image Hover Zoom */
        .img-wrapper {
            overflow: hidden;
        }

        .img-wrapper img {
            transition: transform 0.6s ease;
        }

        .achievement-card:hover .img-wrapper img {
            transform: scale(1.1);
        }

        /* Title Animation Styles (Smooth Expand) */
        .achievement-title-wrapper {
            overflow: hidden;
            transition: height 0.4s ease-out;
            will-change: height;
        }

        .achievement-title {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            /* Batas baris awal */
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .line-clamp-none {
            -webkit-line-clamp: unset !important;
        }

        /* Modal Animation */
        #achievement-modal {
            transition: opacity 0.3s ease;
        }

        #achievement-modal.hidden {
            opacity: 0;
            pointer-events: none;
        }

        #achievement-modal:not(.hidden) {
            opacity: 1;
            pointer-events: auto;
        }

        .modal-content {
            transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        #achievement-modal.hidden .modal-content {
            transform: scale(0.95) translateY(20px);
        }

        #achievement-modal:not(.hidden) .modal-content {
            transform: scale(1) translateY(0);
        }

        /* Custom Scrollbar */
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #3396D3;
            border-radius: 4px;
        }
    </style>
@endpush

@push('scripts')
    <script>
        lucide.createIcons();

        // Mobile Menu Logic
        const btn = document.getElementById('mobile-menu-btn');
        const menu = document.getElementById('mobile-menu');

        $('#search').on('keydown', function(e) {
            if (e.key === 'Enter') {
                const query = e.target.value.trim();
                if (query) {
                    window.location.href = `{{ url('/prestasi') }}?search=${encodeURIComponent(query)}`;
                } else {
                    window.location.href = `{{ url('/prestasi') }}`;
                }
            }
        });

        btn.addEventListener('click', () => {
            menu.classList.toggle('hidden');
        });

        // --- Optimized Smooth Expansion Script for Achievements ---
        const cards = document.querySelectorAll('.achievement-card');

        cards.forEach(card => {
            const wrapper = card.querySelector('.achievement-title-wrapper');
            const title = card.querySelector('.achievement-title');

            // Set initial height
            requestAnimationFrame(() => {
                if (wrapper && title) {
                    wrapper.style.height = `${title.offsetHeight}px`;
                }
            });

            card.addEventListener('mouseenter', () => {
                if (!wrapper || !title) return;
                const startHeight = title.offsetHeight;
                title.classList.add('line-clamp-none');
                const endHeight = title.offsetHeight;
                title.classList.remove('line-clamp-none');
                wrapper.style.height = `${startHeight}px`;
                void wrapper.offsetHeight;
                title.classList.add('line-clamp-none');
                wrapper.style.height = `${endHeight}px`;
            });

            card.addEventListener('mouseleave', () => {
                if (!wrapper || !title) return;
                title.classList.remove('line-clamp-none');
                const collapsedHeight = title.offsetHeight;
                title.classList.add('line-clamp-none');
                void wrapper.offsetHeight;
                wrapper.style.height = `${collapsedHeight}px`;
                wrapper.addEventListener('transitionend', function() {
                    title.classList.remove('line-clamp-none');
                }, {
                    once: true
                });
            });
        });

        // --- Modal Logic ---
        const modal = document.getElementById('achievement-modal');
        const modalImg = document.getElementById('modal-image');
        const modalTitle = document.getElementById('modal-title');
        const modalDate = document.getElementById('modal-date');
        const modalDesc = document.getElementById('modal-desc');

        function openModal(cardElement) {
            const title = cardElement.querySelector('.modal-data-title').innerText;
            const date = cardElement.querySelector('.modal-data-date').innerText;
            const desc = cardElement.querySelector('.modal-data-desc').innerHTML;
            const fullImgSrc = cardElement.querySelector('.modal-data-full-img').innerText;

            modalTitle.innerText = title;
            modalDate.innerText = date;
            modalDesc.innerHTML = desc;
            modalImg.src = fullImgSrc;

            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            modal.classList.add('hidden');
            document.body.style.overflow = '';
        }

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
                closeModal();
            }
        });
    </script>
@endpush
