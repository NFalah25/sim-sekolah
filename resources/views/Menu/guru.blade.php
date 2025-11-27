@extends('Layout.app')

@section('content')

    <div class="bg-white border-b mt-4 border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3">
            <p class="text-sm text-gray-500">
                <a href="{{route('home')}}" class="hover:text-primary">Beranda</a>
                <span class="mx-2 text-secondary">/</span>
                <span class="font-semibold text-gray-800">Guru & Staff</span>
            </p>
        </div>
    </div>
    <main class="flex-grow w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16 pt-4">

        <!-- Section Header -->
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-heading font-bold text-gray-900 mb-4">
                Daftar <span class="text-primary">Pengajar</span> Kami
            </h2>
            <div class="h-1.5 w-24 bg-secondary mx-auto rounded-full mb-6"></div>
            <p class="text-slate-500 max-w-2xl mx-auto text-base md:text-lg leading-relaxed">
                SD Negeri JuwetKenongo didukung oleh tenaga pendidik profesional. Klik tombol untuk mengakses materi
                pembelajaran.
            </p>
        </div>

        <!-- Grid Guru -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

            @foreach ($guru as $data)
                <div class="teacher-card bg-white shadow-md overflow-hidden flex flex-col h-full border border-slate-100">
                    <div class="image-wrapper h-64 relative bg-gray-200">
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent z-10 pointer-events-none">
                        </div>
                        <img src="{{ \Illuminate\Support\Facades\Storage::url($data->image) }}" alt="Foto Guru"
                            class="w-full h-full object-cover object-top">
                    </div>
                    <div class="p-6 flex flex-col flex-grow">
                        <div class="w-10 h-1 bg-yellow-400 rounded-full mb-4"></div>
                        <h3 class="text-xl font-bold text-slate-900 mb-3">{{ $data->name }}</h3>
                        <div class="mb-6 relative flex-grow">
                            <i data-lucide="quote"
                                class="absolute -top-1 -left-1 w-5 h-5 text-blue-100 fill-current transform -scale-x-100"></i>
                            <p class="font-serif italic text-slate-600 text-sm leading-relaxed pl-5 relative z-10">
                                "{{ $data->motivation }}"
                            </p>
                        </div>
                        <a href="https://drive.google.com" target="_blank"
                            class="drive-btn mt-auto inline-flex items-center justify-center w-full px-4 py-2.5 bg-slate-50 text-slate-600 border border-slate-200 rounded-lg font-semibold transition-colors group">
                            <i data-lucide="hard-drive" class="w-4 h-4 mr-2"></i>
                            Buka Drive Materi
                        </a>
                    </div>
                </div>
            @endforeach

            @if ($guru->isEmpty())
                <p class="text-center text-gray-500 col-span-full">Tidak ada guru yang ditemukan.</p>
            @endif
        </div>
        @if ($guru->count() > 0)
            <div class="flex flex-col items-center justify-center space-y-4">

                <div
                    class="bg-white rounded-full shadow-lg shadow-slate-200/50 px-2 py-2 flex items-center space-x-1 border border-slate-50">

                    <!-- Tombol Previous -->
                    <a href="{{ $guru->previousPageUrl() }}"
                        class="w-10 h-10 flex items-center justify-center rounded-full text-slate-400 hover:text-primary hover:bg-slate-50 transition-all duration-200 group">
                        <i data-lucide="chevron-left" class="w-5 h-5 group-hover:-translate-x-0.5 transition-transform"></i>
                    </a>

                    @php
                        $currentPage = $guru->currentPage();
                        $lastPage = $guru->lastPage();
                        $pagesToShow = 5;
                    @endphp

                    @if ($lastPage > $pagesToShow)
                        <a href="{{ $guru->url(1) }}"
                            class="w-10 h-10 flex items-center justify-center rounded-full {{ $currentPage == 1 ? 'bg-primary text-white shadow-md shadow-blue-200 font-semibold hover:bg-primary-dark' : 'text-slate-400 hover:text-primary hover:bg-slate-50 transition-all duration-200 group' }}">
                            1
                        </a>

                        @if ($currentPage > 3)
                            <span class="text-slate-400">...</span>
                        @endif

                        @foreach (range(max(2, $currentPage - 2), min($lastPage - 1, $currentPage + 2)) as $page)
                            <a href="{{ $guru->url($page) }}"
                                class="w-10 h-10 flex items-center justify-center rounded-full {{ $page == $currentPage ? 'bg-primary text-white shadow-md shadow-blue-200 font-semibold hover:bg-primary-dark' : 'text-slate-400 hover:text-primary hover:bg-slate-50 transition-all duration-200 group' }}">
                                {{ $page }}
                            </a>
                        @endforeach

                        @if ($currentPage < $lastPage - 2)
                            <span class="text-slate-400">...</span>
                        @endif

                        <a href="{{ $guru->url($lastPage) }}"
                            class="w-10 h-10 flex items-center justify-center rounded-full {{ $currentPage == $lastPage ? 'bg-primary text-white shadow-md shadow-blue-200 font-semibold hover:bg-primary-dark' : 'text-slate-400 hover:text-primary hover:bg-slate-50 transition-all duration-200 group' }}">
                            {{ $lastPage }}
                        </a>
                    @else
                        @foreach (range(1, $lastPage) as $page)
                            <a href="{{ $guru->url($page) }}"
                                class="w-10 h-10 flex items-center justify-center rounded-full {{ $page == $currentPage ? 'bg-primary text-white shadow-md shadow-blue-200 font-semibold hover:bg-primary-dark' : 'text-slate-400 hover:text-primary hover:bg-slate-50 transition-all duration-200 group' }}">
                                {{ $page }}
                            </a>
                        @endforeach
                    @endif

                    <a href="{{ $guru->nextPageUrl() }}"
                        class="w-10 h-10 flex items-center justify-center rounded-full text-slate-400 hover:text-primary hover:bg-slate-50 transition-all duration-200 group">
                        <i data-lucide="chevron-right" class="w-5 h-5 group-hover:translate-x-0.5 transition-transform"></i>
                    </a>
                </div>

                <p class="text-xs text-slate-400 font-medium">
                    Menampilkan {{ $guru->firstItem() }} - {{ $guru->lastItem() }} dari total
                    {{ $guru->total() }} guru
                </p>
            </div>
        @endif

    </main>

@endsection

@push('styles')
    <style>
        .text-highlight {
            color: #3b82f6;
        }

        /* Card Container */
        .teacher-card {
            transition: all 0.3s ease;
            border-radius: 1rem;
            /* Sudut membulat seperti fasilitas */
        }

        .teacher-card:hover {
            transform: translateY(-8px);
            /* Kartu naik sedikit saat hover */
            box-shadow: 0 20px 30px -5px rgba(0, 0, 0, 0.15);
        }

        /* Image Wrapper & Zoom Effect */
        .image-wrapper {
            overflow: hidden;
        }

        .image-wrapper img {
            transition: transform 0.6s cubic-bezier(0.25, 1, 0.5, 1);
        }

        .teacher-card:hover .image-wrapper img {
            transform: scale(1.1);
            /* Efek Zoom gambar seperti fasilitas */
        }

        /* Button Hover Transition */
        .drive-btn {
            transition: all 0.3s ease;
        }

        .teacher-card:hover .drive-btn {
            background-color: #2563eb;
            /* primary */
            color: white;
            border-color: transparent;
        }
    </style>

    <script src="https://unpkg.com/lucide@latest"></script>
@endpush

@push('scripts')
    <script>
        lucide.createIcons();

        $('#search').on('keydown', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                const searchInput = this.value;
                searchTeachers(searchInput);
            }
        });

        function searchTeachers(searchKey) {
            const link = "{{ route('landing.guru') }}";

            window.location.href = `${link}?search=${searchKey}`;
        }
    </script>
@endpush
