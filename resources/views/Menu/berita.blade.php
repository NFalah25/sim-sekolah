@extends('Layout.app')

@section('content')
    <div class="bg-white border-b mt-4 border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3">
            <p class="text-sm text-gray-500">
                <a href="{{route('home')}}" class="hover:text-primary">Beranda</a>
                <span class="mx-2 text-secondary">/</span>
                <span class="font-semibold text-gray-800">Berita</span>
            </p>
        </div>
    </div>
    <main class="flex-grow w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-12">

        <!-- Header -->
        <div class="flex flex-col md:flex-row justify-between items-end mb-10 gap-4">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-slate-900 border-l-4 border-secondary pl-4">Arsip <span class="text-primary">Berita</span></h1>
                <p class="text-slate-500 mt-2 pl-5">Informasi terkini dan kegiatan sekolah terbaru.</p>
            </div>

            <!-- Search -->
            <div class="relative w-full md:w-64">
                <input type="text" placeholder="Cari berita..." id="search-input"
                    class="w-full pl-10 pr-4 py-2 bg-white border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all">
                <i data-lucide="search" class="absolute left-3 top-2.5 h-4 w-4 text-gray-400"></i>
            </div>
        </div>

        <!-- Grid Berita -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12 items-start">

            <!-- Card 1 -->
            @forelse ($berita as $data)
                <article
                    class="news-card bg-white rounded-xl border border-gray-100 overflow-hidden flex flex-col h-full cursor-pointer group"
                    onclick="openModal(this)">
                    <div class="img-container relative h-48 bg-gray-200 flex-shrink-0">
                        <img src="{{ $data->image }}"
                            alt="Thumbnail" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-primary/0 group-hover:bg-primary/10 transition-colors"></div>
                        <!-- Hidden content for modal -->
                        <div class="hidden news-content-full">
                            {{ $data->content }}
                        </div>
                    </div>
                    <div class="p-5 flex flex-col flex-grow">
                        <div class="news-title-wrapper">
                            <h2
                                class="news-title text-base font-bold text-slate-900 leading-snug mb-3 group-hover:text-primary transition-colors">
                                {{ $data->title }}
                            </h2>
                        </div>
                        <div class="mt-auto flex items-center gap-3 pt-4 border-t border-third">
                            <span
                                class="bg-primary text-white text-[10px] font-bold px-2 py-1 rounded tracking-wide">Admin</span>
                            <span class="text-xs text-gray-500 font-medium news-date">{{ $data->created_at->format('d F Y') }}</span>
                        </div>
                    </div>
                </article>
            @empty
                <p class="text-center text-gray-500 col-span-full">Tidak ada berita tersedia.</p>
            @endforelse


        </div>

        <!-- Pagination -->
        @if ($berita->count() > 0)
            <div class="flex flex-col items-center justify-center space-y-4">

                <div
                    class="bg-white rounded-full shadow-lg shadow-slate-200/50 px-2 py-2 flex items-center space-x-1 border border-slate-50">

                    <!-- Tombol Previous -->
                    <a href="{{ $berita->previousPageUrl() }}"
                        class="w-10 h-10 flex items-center justify-center rounded-full text-slate-400 hover:text-primary hover:bg-slate-50 transition-all duration-200 group">
                        <i data-lucide="chevron-left" class="w-5 h-5 group-hover:-translate-x-0.5 transition-transform"></i>
                    </a>

                    @php
                        $currentPage = $berita->currentPage();
                        $lastPage = $berita->lastPage();
                        $pagesToShow = 5;
                    @endphp

                    @if ($lastPage > $pagesToShow)
                        <a href="{{ $berita->url(1) }}"
                            class="w-10 h-10 flex items-center justify-center rounded-full {{ $currentPage == 1 ? 'bg-primary text-white shadow-md shadow-blue-200 font-semibold hover:bg-primary-dark' : 'text-slate-400 hover:text-primary hover:bg-slate-50 transition-all duration-200 group' }}">
                            1
                        </a>

                        @if ($currentPage > 3)
                            <span class="text-slate-400">...</span>
                        @endif

                        @foreach (range(max(2, $currentPage - 2), min($lastPage - 1, $currentPage + 2)) as $page)
                            <a href="{{ $berita->url($page) }}"
                                class="w-10 h-10 flex items-center justify-center rounded-full {{ $page == $currentPage ? 'bg-primary text-white shadow-md shadow-blue-200 font-semibold hover:bg-primary-dark' : 'text-slate-400 hover:text-primary hover:bg-slate-50 transition-all duration-200 group' }}">
                                {{ $page }}
                            </a>
                        @endforeach

                        @if ($currentPage < $lastPage - 2)
                            <span class="text-slate-400">...</span>
                        @endif

                        <a href="{{ $berita->url($lastPage) }}"
                            class="w-10 h-10 flex items-center justify-center rounded-full {{ $currentPage == $lastPage ? 'bg-primary text-white shadow-md shadow-blue-200 font-semibold hover:bg-primary-dark' : 'text-slate-400 hover:text-primary hover:bg-slate-50 transition-all duration-200 group' }}">
                            {{ $lastPage }}
                        </a>
                    @else
                        @foreach (range(1, $lastPage) as $page)
                            <a href="{{ $berita->url($page) }}"
                                class="w-10 h-10 flex items-center justify-center rounded-full {{ $page == $currentPage ? 'bg-primary text-white shadow-md shadow-blue-200 font-semibold hover:bg-primary-dark' : 'text-slate-400 hover:text-primary hover:bg-slate-50 transition-all duration-200 group' }}">
                                {{ $page }}
                            </a>
                        @endforeach
                    @endif

                    <a href="{{ $berita->nextPageUrl() }}"
                        class="w-10 h-10 flex items-center justify-center rounded-full text-slate-400 hover:text-primary hover:bg-slate-50 transition-all duration-200 group">
                        <i data-lucide="chevron-right" class="w-5 h-5 group-hover:translate-x-0.5 transition-transform"></i>
                    </a>
                </div>

                <p class="text-xs text-slate-400 font-medium">
                    Menampilkan {{ $berita->firstItem() }} - {{ $berita->lastItem() }} dari total
                    {{ $berita->total() }} berita
                </p>
            </div>
        @endif

    </main>

    <div id="news-modal"
        class="fixed inset-0 z-[100] flex items-center justify-center bg-black/50 backdrop-blur-sm hidden p-4">
        <!-- Overlay Click to Close -->
        <div class="absolute inset-0" onclick="closeModal()"></div>

        <!-- Modal Content -->
        <div
            class="modal-content relative bg-white rounded-2xl shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-hidden flex flex-col">

            <!-- Close Button -->
            <button onclick="closeModal()"
                class="absolute top-4 right-4 z-10 p-2 bg-white/80 hover:bg-white rounded-full text-slate-600 hover:text-primary transition-colors shadow-sm backdrop-blur">
                <i data-lucide="x" class="w-6 h-6"></i>
            </button>

            <!-- Scrollable Area -->
            <div class="overflow-y-auto custom-scrollbar flex flex-col">
                <!-- Image -->
                <div class="relative h-64 sm:h-80 w-full bg-gray-200 shrink-0">
                    <img id="modal-image" src="" alt="Detail Berita" class="w-full h-full object-contain">
                </div>

                <!-- Text Content -->
                <div class="p-6 sm:p-8">
                    <div class="flex items-center gap-3 mb-4">
                        <span class="bg-primary text-white text-xs font-bold px-2.5 py-1 rounded-md">Berita Sekolah</span>
                        <div class="flex items-center text-slate-400 text-xs font-medium">
                            <i data-lucide="calendar" class="w-3.5 h-3.5 mr-1.5"></i>
                            <span id="modal-date"></span>
                        </div>
                    </div>

                    <h2 id="modal-title" class="text-2xl sm:text-3xl font-bold text-slate-900 mb-6 leading-tight"></h2>

                    <div id="modal-body" class="prose prose-slate text-slate-600 leading-relaxed text-base sm:text-lg">
                        <!-- Content injected via JS -->
                    </div>

                    <!-- Footer / Share (Optional) -->
                    <div class="mt-8 pt-6 border-t border-gray-100 flex justify-between items-center">
                        <span class="text-sm text-slate-400">Bagikan berita ini:</span>
                        <div class="flex gap-2">
                            <button
                                class="p-2 rounded-full bg-third text-primary hover:bg-primary hover:text-white transition-colors">
                                <i data-lucide="share-2" class="w-4 h-4"></i>
                            </button>
                            <button
                                class="p-2 rounded-full bg-third text-primary hover:bg-primary hover:text-white transition-colors">
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
        .news-card {
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1), box-shadow 0.3s ease;
            will-change: transform, box-shadow;
        }

        .news-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px -5px rgba(51, 150, 211, 0.15), 0 10px 10px -6px rgba(51, 150, 211, 0.1);
            z-index: 10;
        }

        .img-container {
            overflow: hidden;
        }

        .img-container img {
            transition: transform 0.6s ease;
        }

        .news-card:hover .img-container img {
            transform: scale(1.08);
        }

        .news-title-wrapper {
            overflow: hidden;
            transition: height 0.4s ease-out;
            will-change: height;
        }

        .news-title {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .line-clamp-none {
            -webkit-line-clamp: unset !important;
        }

        /* Modal Animation */
        #news-modal {
            transition: opacity 0.3s ease;
        }

        #news-modal.hidden {
            opacity: 0;
            pointer-events: none;
        }

        #news-modal:not(.hidden) {
            opacity: 1;
            pointer-events: auto;
        }

        .modal-content {
            transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        #news-modal.hidden .modal-content {
            transform: scale(0.95) translateY(10px);
        }

        #news-modal:not(.hidden) .modal-content {
            transform: scale(1) translateY(0);
        }

        /* Custom Scrollbar for Modal */
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
    </style>
@endpush

@push('scripts')
    <script>
        lucide.createIcons();

        const cards = document.querySelectorAll('.news-card');

        cards.forEach(card => {
            const wrapper = card.querySelector('.news-title-wrapper');
            const title = card.querySelector('.news-title');

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
        const modal = document.getElementById('news-modal');
        const modalImg = document.getElementById('modal-image');
        const modalTitle = document.getElementById('modal-title');
        const modalDate = document.getElementById('modal-date');
        const modalBody = document.getElementById('modal-body');

        function openModal(cardElement) {
            // Extract data from the clicked card
            const imgSrc = cardElement.querySelector('img').src;
            const title = cardElement.querySelector('.news-title').innerText;
            const date = cardElement.querySelector('.news-date').innerText;

            // Get full content from hidden div if available, otherwise fallback to title
            const hiddenContent = cardElement.querySelector('.news-content-full');
            const content = hiddenContent ? hiddenContent.innerHTML : title; // Using innerHTML to preserve line breaks

            // Populate Modal
            modalImg.src = imgSrc;
            modalTitle.innerText = title;
            modalDate.innerText = date;
            modalBody.innerHTML = content;

            // Show Modal
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden'; // Prevent background scrolling
        }

        function closeModal() {
            modal.classList.add('hidden');
            document.body.style.overflow = ''; // Restore scrolling
        }

        // Close on Escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
                closeModal();
            }
        });

        $('#search-input').on('keydown', function(e) {
            if(e.key === 'Enter' || e.keyCode === 13) {
                const query = $(this).val().trim();
                if(query) {
                    window.location.href = "{{ url('/berita') }}" + "?search=" + encodeURIComponent(query);
                } else {
                    window.location.href = "{{ url('/berita') }}";
                }
            }
        });
    </script>
@endpush
