@extends('app.Template')

@section('title', 'Edit Struktur Organisasi')

@push('style')
    <style>
        /* Sembunyikan radio button asli */
        .icon-radio-input {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
        }

        /* Style dasar kotak icon */
        .icon-radio-label {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 15px;
            border: 2px solid #e4e6fc;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            height: 100%;
            color: #6c757d;
        }

        .icon-radio-label:hover {
            background-color: #f9fafe;
            border-color: #6777ef;
        }

        /* State Checked */
        .icon-radio-input:checked+.icon-radio-label {
            border-color: #6777ef;
            background-color: rgba(103, 119, 239, 0.1);
            color: #6777ef;
            font-weight: bold;
        }

        .icon-preview {
            width: 28px;
            height: 28px;
            margin-bottom: 8px;
        }

        /* Preview Image Container */
        .img-preview-container {
            min-height: 200px;
            border: 2px dashed #e4e6fc;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            background: #f9fafe;
            overflow: hidden;
        }

        /* --- PERBAIKAN CSS FILE INPUT --- */

        /* 1. Pastikan wrapper pembungkusnya punya overflow hidden */
        .custom-file {
            position: relative;
            display: inline-block;
            width: 100%;
            height: calc(2.25rem + 2px);
            margin-bottom: 0;
            overflow: hidden !important;
            /* Mencegah elemen keluar dari kotak */
        }

        /* 2. Paksa label agar teks terpotong rapi */
        .custom-file-label {
            position: absolute;
            top: 0;
            right: 0;
            left: 0;
            z-index: 1;
            height: calc(2.25rem + 2px);
            padding: 0.375rem 0.75rem;
            font-weight: 400;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;

            /* KUNCI AGAR TEKS TIDAK KE BAWAH */
            white-space: nowrap !important;
            overflow: hidden !important;
            text-overflow: ellipsis !important;
            padding-right: 90px !important;
            /* Ruang untuk tombol Browse */
            display: block !important;
            width: 100% !important;
        }

        /* 3. Style untuk tombol Browse */
        .custom-file-label::after {
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            z-index: 3;
            display: block;
            height: calc(2.25rem + 2px) !important;
            /* Samakan tinggi */
            padding: 0.375rem 0.75rem;
            line-height: 1.5;
            color: #495057;
            content: "Browse";
            background-color: #e9ecef;
            border-left: 1px solid #ced4da;
            border-radius: 0 0.25rem 0.25rem 0;
        }
    </style>
@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Struktur Organisasi</h1>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>Formulir Struktur Organisasi</h4>
                </div>
                <div class="card-body">
                    <!-- Pastikan enctype="multipart/form-data" ada untuk upload file -->
                    <form action="{{ route('struktur.update', $struktur->id) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf

                        <div class="row">
                            <!-- Kolom Kiri: Input Teks -->
                            <div class="col-md-6">
                                <!-- 1. Nama Struktur -->
                                <div class="form-group">
                                    <label>Nama Struktur Organisasi <span class="text-danger">*</span></label>
                                    <input type="text" name="title"
                                        class="form-control @error('title') is-invalid @enderror"
                                        value="{{ old('title', $struktur->name) }}"
                                        placeholder="Contoh: Manajemen Sekolah, Komite, atau Tata Usaha">
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- 2. Deskripsi Singkat -->
                                <div class="form-group">
                                    <label>Deskripsi Singkat</label>
                                    <textarea name="description" class="form-control" style="height: 130px;"
                                        placeholder="Contoh: Meliputi Kepala Sekolah, Wakil, dan Bendahara.">{{ old('description', $struktur->description) }}</textarea>
                                    <small class="form-text text-muted">Deskripsi ini akan tampil di bagian atas gambar
                                        bagan.</small>
                                </div>
                            </div>

                            <!-- Kolom Kanan: Upload Gambar -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Gambar Bagan Struktur <span class="text-danger">*</span></label>

                                    <!-- Preview -->
                                    <div class="img-preview-container mb-3">
                                        <img id="image-preview" src="{{ asset('storage/' . $struktur->images) }}" alt="Preview Gambar"
                                            style="display: none; max-width: 100%; max-height: 200px;">
                                        <span id="placeholder-text" class="text-muted small">Preview Gambar akan muncul di
                                            sini</span>
                                    </div>

                                    <!-- Input File -->
                                    <!-- Menambahkan class custom-file pada wrapper -->
                                    <div class="custom-file">
                                        <input type="file" name="image"
                                            class="custom-file-input @error('image') is-invalid @enderror" id="customFile"
                                            onchange="previewImage(this)">
                                        <label class="custom-file-label" for="customFile">Pilih File Gambar</label>
                                    </div>

                                    <small class="form-text text-muted mt-2">
                                        Format: JPG, PNG, JPEG. Maksimal 4MB. Pastikan gambar jelas dan beresolusi tinggi.
                                    </small>

                                    @error('image')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- 4. Pilihan Ikon (Untuk Menu Tab) -->
                        <div class="form-group">
                            <label class="d-block">Pilih Ikon Menu</label>
                            <small class="form-text text-muted mb-3">Ikon ini akan muncul di tombol menu sebelah kiri
                                halaman landing page.</small>

                            <div class="row gutters-xs">
                                <!-- Users (Manajemen/Umum) -->
                                <div class="col-4 col-sm-3 col-md-2 mb-3">
                                    <label class="w-100">
                                        <input type="radio" name="icon" value="users" class="icon-radio-input"
                                            {{ old('icon', $struktur->icon) == 'users' ? 'checked' : '' }}>
                                        <div class="icon-radio-label text-center">
                                            <i data-lucide="users" class="icon-preview"></i>
                                            <span class="small">Users</span>
                                        </div>
                                    </label>
                                </div>

                                <!-- File Text (Administrasi/TU) -->
                                <div class="col-4 col-sm-3 col-md-2 mb-3">
                                    <label class="w-100">
                                        <input type="radio" name="icon" value="file-text" class="icon-radio-input"
                                            {{ old('icon', $struktur->icon) == 'file-text' ? 'checked' : '' }}>
                                        <div class="icon-radio-label text-center">
                                            <i data-lucide="file-text" class="icon-preview"></i>
                                            <span class="small">Admin</span>
                                        </div>
                                    </label>
                                </div>

                                <!-- Heart Handshake (Komite/Kerjasama) -->
                                <div class="col-4 col-sm-3 col-md-2 mb-3">
                                    <label class="w-100">
                                        <input type="radio" name="icon" value="heart-handshake"
                                            class="icon-radio-input" {{ old('icon', $struktur->icon) == 'heart-handshake' ? 'checked' : '' }}>
                                        <div class="icon-radio-label text-center">
                                            <i data-lucide="heart-handshake" class="icon-preview"></i>
                                            <span class="small">Komite</span>
                                        </div>
                                    </label>
                                </div>

                                <!-- Building (Yayasan/Fasilitas) -->
                                <div class="col-4 col-sm-3 col-md-2 mb-3">
                                    <label class="w-100">
                                        <input type="radio" name="icon" value="building" class="icon-radio-input"
                                            {{ old('icon', $struktur->icon) == 'building' ? 'checked' : '' }}>
                                        <div class="icon-radio-label text-center">
                                            <i data-lucide="building" class="icon-preview"></i>
                                            <span class="small">Gedung</span>
                                        </div>
                                    </label>
                                </div>

                                <!-- Graduation Cap (Siswa/Osis) -->
                                <div class="col-4 col-sm-3 col-md-2 mb-3">
                                    <label class="w-100">
                                        <input type="radio" name="icon" value="graduation-cap"
                                            class="icon-radio-input" {{ old('icon', $struktur->icon) == 'graduation-cap' ? 'checked' : '' }}>
                                        <div class="icon-radio-label text-center">
                                            <i data-lucide="graduation-cap" class="icon-preview"></i>
                                            <span class="small">Siswa</span>
                                        </div>
                                    </label>
                                </div>

                                <!-- Network (Struktur Cabang) -->
                                <div class="col-4 col-sm-3 col-md-2 mb-3">
                                    <label class="w-100">
                                        <input type="radio" name="icon" value="network" class="icon-radio-input" {{ old('icon', $struktur->icon) == 'network' ? 'checked' : '' }}>
                                        <div class="icon-radio-label text-center">
                                            <i data-lucide="network" class="icon-preview"></i>
                                            <span class="small">Jaringan</span>
                                        </div>
                                    </label>
                                </div>
                            </div>
                            @error('icon')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between align-items-center pt-4 border-top mt-4">
                            <a href="{{ route('struktur.index') }}" class="btn btn-danger font-weight-semibold shadow-sm">
                                Batal
                            </a>
                            <button type="submit" class="btn btn-primary font-weight-semibold shadow-sm btn-lg">
                                Simpan Struktur
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        // Init Icons
        lucide.createIcons();

        // Preview Image Script
        function previewImage(input) {
            const preview = document.getElementById('image-preview');
            const placeholder = document.getElementById('placeholder-text');
            // Mengambil label (sibling selanjutnya dari input file)
            const label = input.nextElementSibling;

            if (input.files && input.files[0]) {
                const file = input.files[0];
                const reader = new FileReader();

                // Update teks label dengan nama file
                label.innerText = file.name;

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                    placeholder.style.display = 'none';
                }

                reader.readAsDataURL(file);
            } else {
                // Reset jika tidak ada file
                label.innerText = 'Pilih File Gambar';
                preview.style.display = 'none';
                placeholder.style.display = 'block';
            }
        }

        $(document).ready(function() {
            // Jika ada gambar yang sudah diupload sebelumnya, tampilkan previewnya
            const existingImageUrl = "{{ asset('storage/' . $struktur->images) }}";
            if (existingImageUrl) {
                const preview = document.getElementById('image-preview');
                const placeholder = document.getElementById('placeholder-text');
                preview.src = existingImageUrl;
                preview.style.display = 'block';
                placeholder.style.display = 'none';
            }
        });
    </script>
@endpush
