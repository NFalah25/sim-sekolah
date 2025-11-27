@extends('Layout.app')
@section('content')
    <div class="bg-white border-b mt-4 border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3">
            <p class="text-sm text-gray-500">
                <a href="{{route('home')}}" class="hover:text-primary">Beranda</a>
                <span class="mx-2 text-secondary">/</span>
                <span class="font-semibold text-gray-800">Fasilitas</span>
            </p>
        </div>
    </div>
    <main class="flex-grow max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 w-full">

        <!-- Header Section -->
        <div class="text-center mb-12 fade-in-up" style="animation-delay: 0.1s;">
            <h2 class="text-3xl md:text-4xl font-heading font-bold text-gray-900 mb-4">
                Fasilitas <span class="text-primary">Unggulan</span> Kami
            </h2>
            <div class="h-1.5 w-24 bg-secondary mx-auto rounded-full mb-6"></div>
            <p class="text-gray-600 text-lg leading-relaxed">
                SD Negeri JuwetKenongo dilengkapi dengan berbagai fasilitas modern yang dirancang untuk mendukung kenyamanan
                siswa dan efektivitas proses pembelajaran.
            </p>
        </div>

        <!-- Gallery Grid -->
        <div id="facility-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8 fade-in-up"
            style="animation-delay: 0.3s;">
            <!-- Content will be injected by JS -->
        </div>
        @if ($fasilitas->count() > 0)
            <div class="flex flex-col items-center justify-center space-y-4">

                <div
                    class="bg-white rounded-full shadow-lg shadow-slate-200/50 px-2 py-2 flex items-center space-x-1 border border-slate-50">

                    <!-- Tombol Previous -->
                    <a href="{{ $fasilitas->previousPageUrl() }}"
                        class="w-10 h-10 flex items-center justify-center rounded-full text-slate-400 hover:text-primary hover:bg-slate-50 transition-all duration-200 group">
                        <i data-lucide="chevron-left" class="w-5 h-5 group-hover:-translate-x-0.5 transition-transform"></i>
                    </a>

                    @php
                        $currentPage = $fasilitas->currentPage();
                        $lastPage = $fasilitas->lastPage();
                        $pagesToShow = 5;
                    @endphp

                    @if ($lastPage > $pagesToShow)
                        <a href="{{ $fasilitas->url(1) }}"
                            class="w-10 h-10 flex items-center justify-center rounded-full {{ $currentPage == 1 ? 'bg-primary text-white shadow-md shadow-blue-200 font-semibold hover:bg-primary-dark' : 'text-slate-400 hover:text-primary hover:bg-slate-50 transition-all duration-200 group' }}">
                            1
                        </a>

                        @if ($currentPage > 3)
                            <span class="text-slate-400">...</span>
                        @endif

                        @foreach (range(max(2, $currentPage - 2), min($lastPage - 1, $currentPage + 2)) as $page)
                            <a href="{{ $fasilitas->url($page) }}"
                                class="w-10 h-10 flex items-center justify-center rounded-full {{ $page == $currentPage ? 'bg-primary text-white shadow-md shadow-blue-200 font-semibold hover:bg-primary-dark' : 'text-slate-400 hover:text-primary hover:bg-slate-50 transition-all duration-200 group' }}">
                                {{ $page }}
                            </a>
                        @endforeach

                        @if ($currentPage < $lastPage - 2)
                            <span class="text-slate-400">...</span>
                        @endif

                        <a href="{{ $fasilitas->url($lastPage) }}"
                            class="w-10 h-10 flex items-center justify-center rounded-full {{ $currentPage == $lastPage ? 'bg-primary text-white shadow-md shadow-blue-200 font-semibold hover:bg-primary-dark' : 'text-slate-400 hover:text-primary hover:bg-slate-50 transition-all duration-200 group' }}">
                            {{ $lastPage }}
                        </a>
                    @else
                        @foreach (range(1, $lastPage) as $page)
                            <a href="{{ $fasilitas->url($page) }}"
                                class="w-10 h-10 flex items-center justify-center rounded-full {{ $page == $currentPage ? 'bg-primary text-white shadow-md shadow-blue-200 font-semibold hover:bg-primary-dark' : 'text-slate-400 hover:text-primary hover:bg-slate-50 transition-all duration-200 group' }}">
                                {{ $page }}
                            </a>
                        @endforeach
                    @endif

                    <a href="{{ $fasilitas->nextPageUrl() }}"
                        class="w-10 h-10 flex items-center justify-center rounded-full text-slate-400 hover:text-primary hover:bg-slate-50 transition-all duration-200 group">
                        <i data-lucide="chevron-right" class="w-5 h-5 group-hover:translate-x-0.5 transition-transform"></i>
                    </a>
                </div>

                <p class="text-xs text-slate-400 font-medium">
                    Menampilkan {{ $fasilitas->firstItem() }} - {{ $fasilitas->lastItem() }} dari total
                    {{ $fasilitas->total() }} fasilitas
                </p>
            </div>
        @endif

    </main>

    <div id="image-modal"
        class="fixed inset-0 z-50 hidden bg-school-dark/90 flex items-center justify-center p-4 backdrop-blur-sm transition-opacity duration-300">
        <button onclick="closeModal()"
            class="absolute top-4 right-4 text-white hover:text-secondary focus:outline-none z-50 transition-colors">
            <i class="fas fa-times text-3xl"></i>
        </button>

        <div class="relative max-w-5xl w-full bg-white rounded-lg overflow-hidden shadow-2xl transform transition-all scale-95 opacity-0 border-t-4 border-secondary"
            id="modal-content">
            <div class="grid grid-cols-1 md:grid-cols-3">
                <div class="md:col-span-2 bg-black flex items-center justify-center h-[50vh] md:h-[70vh]">
                    <img id="modal-img" src="" alt="Fasilitas Detail" class="max-h-full max-w-full object-contain">
                </div>
                <div class="p-6 md:p-8 flex flex-col justify-center bg-white">
                    <div class="mb-4">
                        <span
                            class="inline-block px-3 py-1 text-xs font-bold text-gray-800 bg-secondary rounded-full mb-2">Fasilitas
                            Sekolah</span>
                        <h3 id="modal-title" class="text-2xl font-heading font-bold text-gray-900 mb-2">Nama Fasilitas</h3>
                        <div class="h-1 w-12 bg-primary rounded-full mb-4"></div>
                    </div>
                    <p id="modal-desc" class="text-gray-600 mb-6 leading-relaxed">
                        Deskripsi fasilitas.
                    </p>
                    <button onclick="closeModal()"
                        class="self-start px-6 py-2 border-2 border-gray-200 rounded-lg text-gray-700 hover:border-primary hover:text-primary transition font-medium text-sm">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('styles')
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #ffffff;
            /* Track scrollbar jadi putih */
        }

        ::-webkit-scrollbar-thumb {
            background: #3396D3;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #2a78a9;
        }

        .fade-in-up {
            animation: fadeInUp 0.8s ease-out forwards;
            opacity: 0;
            transform: translateY(20px);
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        lucide.createIcons();

        // const facilities = [
        //         {
        //             title: "Mushola Sekolah",
        //             image: "https://images.unsplash.com/photo-1564121211835-e88c852648ab?q=80&w=1000&auto=format&fit=crop",
        //             icon: "fa-mosque",
        //             desc: "Tempat ibadah yang bersih dan nyaman untuk kegiatan keagamaan siswa dan guru."
        //         },
        //         {
        //             title: "Perpustakaan",
        //             image: "https://images.unsplash.com/photo-1568667256549-094345857637?q=80&w=1000&auto=format&fit=crop",
        //             icon: "fa-book-open",
        //             desc: "Koleksi buku lengkap dengan ruang baca yang hening untuk menumbuhkan minat baca siswa."
        //         },
        //         {
        //             title: "Lab. Komputer",
        //             image: "https://images.unsplash.com/photo-1516321318423-f06f85e504b3?q=80&w=1000&auto=format&fit=crop",
        //             icon: "fa-desktop",
        //             desc: "Laboratorium modern dengan perangkat komputer terbaru untuk pembelajaran teknologi."
        //         },
        //         {
        //             title: "Lapangan Olahraga",
        //             image: "https://images.unsplash.com/photo-1534438327276-14e5300c3a48?q=80&w=1000&auto=format&fit=crop",
        //             icon: "fa-futbol",
        //             desc: "Area luas untuk kegiatan olahraga, upacara bendera, dan aktivitas luar ruangan lainnya."
        //         },
        //         {
        //             title: "Kantin Sehat",
        //             image: "https://images.unsplash.com/photo-1588072432836-e10032774350?q=80&w=1000&auto=format&fit=crop",
        //             icon: "fa-utensils",
        //             desc: "Menyediakan makanan dan minuman yang higienis serta sehat untuk seluruh warga sekolah."
        //         },
        //         {
        //             title: "Ruang Kelas",
        //             image: "https://images.unsplash.com/photo-1580582932707-520aed937b7b?q=80&w=1000&auto=format&fit=crop",
        //             icon: "fa-chalkboard-user",
        //             desc: "Ruang belajar yang kondusif, dilengkapi ventilasi udara yang baik dan pencahayaan cukup."
        //         }
        //     ];

        const facilities = @json($fasilitas->items());

        // Render Grid
        const gridContainer = document.getElementById('facility-grid');

        facilities.forEach((item, index) => {
            const cardHTML = `
                <div onclick="openModal(${index})" class="group relative h-72 rounded-xl overflow-hidden cursor-pointer shadow-md hover:shadow-xl transition-all duration-300 hover:-translate-y-1">

                    <img src="{{ Storage::url('${item.image}') }}" alt="${item.name}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">

                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-80 group-hover:opacity-90 transition-opacity"></div>

                    <div class="absolute bottom-0 left-0 w-full p-6 translate-y-2 group-hover:translate-y-0 transition-transform duration-300">
                        <div class="w-12 h-1 bg-secondary mb-3 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

                        <h3 class="text-2xl font-heading font-bold text-white leading-tight drop-shadow-md mb-1">${item.name}</h3>

                        <div class="grid grid-rows-[0fr] group-hover:grid-rows-[1fr] transition-all duration-300">
                            <div class="overflow-hidden">
                                <p class="text-gray-200 text-sm mt-2 font-light opacity-0 group-hover:opacity-100 transition-opacity duration-500 delay-100">
                                    Klik untuk melihat detail
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            gridContainer.innerHTML += cardHTML;
        });

        // Mobile Menu Logic
        function toggleMobileMenu() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        }

        // Modal Logic
        const modal = document.getElementById('image-modal');
        const modalContent = document.getElementById('modal-content');
        const modalImg = document.getElementById('modal-img');
        const modalTitle = document.getElementById('modal-title');
        const modalDesc = document.getElementById('modal-desc');

        function openModal(index) {
            const item = facilities[index];
            const imageUrl = "{{ Storage::url('') }}" + item.image;
            modalImg.src = imageUrl;
            modalTitle.innerText = item.name;
            modalDesc.innerText = item.description;

            modal.classList.remove('hidden');
            // Small timeout to allow CSS transition to work
            setTimeout(() => {
                modalContent.classList.remove('scale-95', 'opacity-0');
                modalContent.classList.add('scale-100', 'opacity-100');
            }, 10);
        }

        function closeModal() {
            modalContent.classList.remove('scale-100', 'opacity-100');
            modalContent.classList.add('scale-95', 'opacity-0');

            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
        }

        // Close modal on clicking outside content
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                closeModal();
            }
        });
    </script>
@endpush
