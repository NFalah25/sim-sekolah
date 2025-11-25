@extends('Layout.app')

@section('content')
    <div class="bg-white border-b mt-4 border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3">
            <p class="text-sm text-gray-500">
                <a href="#" class="hover:text-primary">Beranda</a>
                <span class="mx-2 text-secondary">/</span>
                <span class="font-semibold text-gray-800">Ekstrakurikuler</span>
            </p>
        </div>
    </div>
    <main class="flex-grow w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16 pt-4">
        <!-- Breadcrumb & Header -->
        <div class="text-center mb-12">
            <h1 class="text-3xl md:text-4xl font-bold text-slate-900 mb-4">
                Ekstrakurikuler <span class="text-primary border-b-4 border-blue-100 pb-1">Sekolah</span>
            </h1>
            <p class="text-slate-500 max-w-2xl mx-auto text-base md:text-lg leading-relaxed">
                Daftar kegiatan pengembangan diri di SD Negeri Juwetkenongo yang dapat diikuti oleh siswa.
            </p>
        </div>

        <!-- Grid Ekstrakurikuler -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">

            @forelse ($ekstrakurikuler as $data)
                <div class="ekstra-card bg-white rounded-xl border border-gray-200 overflow-hidden flex flex-col shadow-sm">
                    <div class="bg-slate-50 px-6 py-4 border-b border-gray-100">
                        <h2 class="text-lg font-bold text-slate-800 uppercase tracking-wide border-l-4 border-primary pl-3">
                            {{ $data->name }}
                        </h2>
                    </div>

                    <div class="img-wrapper relative h-72 w-full bg-gray-200">
                        <img src="{{ Storage::url($data->image) }}" alt="Kegiatan Pramuka"
                            class="w-full h-full object-cover">

                        <div
                            class="absolute inset-0 bg-gradient-to-t from-blue-900/90 via-blue-900/40 to-transparent opacity-0 hover:opacity-100 transition-opacity duration-300 flex items-center justify-center p-6">
                            <p
                                class="text-white text-center font-medium leading-relaxed translate-y-4 hover:translate-y-0 transition-transform duration-300">
                                {{ $data->description }}
                            </p>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center col-span-2 text-gray-500">Tidak ada data ekstrakurikuler tersedia.</p>
            @endforelse

        </div>


    </main>
@endsection

@push('styles')
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        .text-highlight {
            color: #2563eb;
            /* Blue-600 */
        }

        .bg-highlight {
            background-color: #2563eb;
        }

        /* Card Hover Effects */
        .ekstra-card {
            transition: all 0.3s ease;
        }

        .ekstra-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        /* Image Zoom Effect */
        .img-wrapper {
            overflow: hidden;
        }

        .img-wrapper img {
            transition: transform 0.7s cubic-bezier(0.25, 1, 0.5, 1);
        }

        .ekstra-card:hover .img-wrapper img {
            transform: scale(1.1);
        }
    </style>
@endpush

@push('scripts')
    <script>
        lucide.createIcons();

        // Mobile Menu Logic
        const btn = document.getElementById('mobile-menu-btn');
        const menu = document.getElementById('mobile-menu');

        btn.addEventListener('click', () => {
            menu.classList.toggle('hidden');
        });
    </script>
@endpush
