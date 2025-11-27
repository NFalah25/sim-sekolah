@extends('app.Template')

@section('title', 'Daftar Struktur Organisasi')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Struktur Organisasi</h1>
        </div>

        @if (session('success') || session('error'))
            <div id="notification"
                class="alert {{ session('success') ? 'alert-success' : 'alert-danger' }} alert-dismissible fade show"
                role="alert">
                {{ session('success') ?? session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const notif = document.getElementById('notification');
                    if (notif) {
                        setTimeout(() => {
                            $(notif).alert('close');
                        }, 3000);
                        $(notif).on('closed.bs.alert', function() {});
                    }
                });
            </script>
        @endif

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex flex-wrap justify-content-between align-items-center">
                            <h4>Daftar Struktur</h4>
                            <div class="d-flex flex-wrap align-items-center gap-2 justify-content-center">
                                <form class="form-inline mr-2" method="GET" action="">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Cari Struktur"
                                            name="search" value="{{ request('search') }}">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="submit"><i
                                                    class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                                <a href="{{ route('struktur.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus mr-1"></i>Buat Struktur Baru
                                </a>
                            </div>
                        </div>
                        <div class="card-body p-2">
                            <div class="table-responsive">
                                <table class="table table-striped table-md">
                                    <thead>
                                        <tr>
                                            <th>Nama Struktur</th>
                                            <th>Gambar</th>
                                            <th>Ikon Menu</th>
                                            <th>Deskripsi</th>
                                            <th class="text-center" style="width: 150px;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($struktur as $index => $item)
                                            <tr>

                                                <td>
                                                    <span class="">{{ $item->name }}</span>
                                                </td>
                                                <td>
                                                    <div class="badge badge-light">
                                                        <i data-lucide="{{ $item->icon }}"
                                                            style="width: 20px; height: 20px;"></i>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="gallery">
                                                        <!-- Lightbox preview (Opsional, pakai chocolat.js bawaan Stisla jika ada) -->
                                                        <div class="gallery-item" style="cursor: pointer;"
                                                            onclick="showCustomModal('{{ asset('storage/' . $item->images) }}', '{{ $item->title }}')">
                                                            <img alt="{{ $item->title }}"
                                                                src="{{ asset('storage/' . $item->images) }}"
                                                                class="img-thumbnail" data-toggle="tooltip"
                                                                title="Klik untuk memperbesar"
                                                                style="width: 80px; height: 60px; object-fit: cover;">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{ Str::limit($item->description, 50) }}
                                                </td>
                                                <td class="text-center">
                                                    <div class="d-flex justify-content-center">
                                                        <a href="{{ route('struktur.edit', $item->id) }}"
                                                            class="btn btn-warning btn-sm mr-2" data-toggle="tooltip"
                                                            title="Edit">
                                                            <i class="fas fa-pencil-alt"></i>
                                                        </a>

                                                        <form action="{{ route('struktur.destroy', $item->id) }}"
                                                            method="POST" class="delete-form">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm"
                                                                data-toggle="tooltip" title="Hapus"
                                                                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center py-5">
                                                    <div class="empty-state" data-height="200">
                                                        <div class="empty-state-icon">
                                                            <i class="fas fa-sitemap"></i>
                                                        </div>
                                                        <h2>Belum ada data</h2>
                                                        <p class="lead">
                                                            Belum ada struktur organisasi yang ditambahkan. Silakan buat
                                                            yang baru.
                                                        </p>
                                                        <a href="{{ route('struktur.create') }}"
                                                            class="btn btn-primary mt-4">Tambah Sekarang</a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <!-- Pagination Laravel -->
                            {{ $struktur->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div id="customImageModal" class="custom-modal-overlay" onclick="closeCustomModal(event)">
        <div class="custom-modal-content">
            <div class="custom-modal-header">
                <h5 class="mb-0">Preview Gambar</h5>
                <button type="button" class="custom-close-btn" onclick="closeCustomModal(event, true)">&times;</button>
            </div>
            <div class="custom-modal-body">
                <img id="customModalImage" src="" alt="Preview">
                <h5 id="customModalCaption"></h5>
            </div>
        </div>
    </div>

@endsection

@push('styles')
    <style>
        /* CSS Khusus untuk Modal Custom agar pasti di atas (z-index tinggi) */
        .custom-modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            /* Background gelap transparan */
            z-index: 99999;
            /* Pastikan di atas navbar/sidebar Stisla */
            display: none;
            /* Default hidden */
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
            backdrop-filter: blur(2px);
            /* Efek blur di belakang */
        }

        .custom-modal-overlay.show {
            display: flex;
            opacity: 1;
        }

        .custom-modal-content {
            background: #fff;
            width: 90%;
            max-width: 800px;
            border-radius: 8px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            transform: scale(0.9);
            transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
            overflow: hidden;
            position: relative;
        }

        .custom-modal-overlay.show .custom-modal-content {
            transform: scale(1);
        }

        .custom-modal-header {
            padding: 15px 20px;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #f9f9f9;
        }

        .custom-modal-header h5 {
            margin: 0;
            color: #333;
            font-weight: 600;
        }

        .custom-close-btn {
            background: none;
            border: none;
            font-size: 28px;
            line-height: 1;
            color: #999;
            cursor: pointer;
            transition: color 0.2s;
        }

        .custom-close-btn:hover {
            color: #ff5b57;
        }

        .custom-modal-body {
            padding: 20px;
            text-align: center;
            max-height: 80vh;
            overflow-y: auto;
        }

        #customModalImage {
            max-width: 100%;
            max-height: 60vh;
            border-radius: 4px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        #customModalCaption {
            margin-top: 15px;
            color: #333;
            font-weight: 600;
            font-size: 16px;
        }
    </style>
@endpush

@push('scripts')
    <!-- Script Ikon -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        lucide.createIcons();

        function showCustomModal(imageUrl, title) {
            const modal = document.getElementById('customImageModal');
            document.getElementById('customModalImage').src = imageUrl;
            document.getElementById('customModalCaption').innerText = title;

            // Tampilkan dengan efek fade-in
            modal.style.display = 'flex';
            // Sedikit delay agar transisi opacity berjalan
            setTimeout(() => {
                modal.classList.add('show');
            }, 10);

            // Matikan scroll body
            document.body.style.overflow = 'hidden';
        }

        // Fungsi Menutup Modal Custom
        function closeCustomModal(event, force = false) {
            // Tutup jika klik tombol close ATAU klik area gelap (overlay)
            if (force || event.target === document.getElementById('customImageModal')) {
                const modal = document.getElementById('customImageModal');
                modal.classList.remove('show');

                // Tunggu animasi selesai baru display none
                setTimeout(() => {
                    modal.style.display = 'none';
                    document.getElementById('customModalImage').src = ''; // Reset gambar
                }, 300);

                // Hidupkan scroll body
                document.body.style.overflow = '';
            }
        }

        // Tutup dengan tombol ESC
        document.addEventListener('keydown', function(event) {
            if (event.key === "Escape") {
                const modal = document.getElementById('customImageModal');
                if (modal.style.display === 'flex') {
                    closeCustomModal(event, true);
                }
            }
        });
    </script>
@endpush
