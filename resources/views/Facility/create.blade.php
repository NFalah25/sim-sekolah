@extends('app.Template')
@section('title', 'Add Facility')

@section('content')
    <div class="section-header">
        <h2 class="h4 font-weight-bold mb-1">Tambah Fasilitas Sekolah</h2>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Isi detail fasilitas yang ingin ditambahkan</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('fasilitas.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-row">
                        <div class="col-md-6 mb-4">
                            <div class="form-group">
                                <label for="facility" class="font-weight-semibold">Nama Fasilitas</label>
                                <input type="text" id="facility" name="facility"
                                       placeholder="Contoh: Laboratorium Komputer" value="{{old('facility')}}"
                                       class="form-control rounded-lg @error('facility') is-invalid @enderror">
                                @error('facility')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="description" class="font-weight-semibold">Deskripsi</label>
                                <textarea id="description" name="description" rows="6"
                                          placeholder="Tuliskan deskripsi fasilitas..."
                                          class="form-control rounded-lg  @error('description') is-invalid @enderror"
                                          style="height: auto">{{old('description')}}</textarea>
                            </div>
                            @error('description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-4">
                            <div class="form-group">
                                <label for="image" class="font-weight-semibold">Gambar</label>

                                <div id="native-dropzone" class="native-dropzone @error('image') border-error @enderror" tabindex="0">
                                    <div id="native-placeholder" class="native-placeholder">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="native-icon" viewBox="0 0 24 24"
                                             fill="none" stroke="{{ $errors->has('image') ? '#ff4d4f' : '#3396D3' }}" stroke-width="1.5" stroke-linecap="round"
                                             stroke-linejoin="round">
                                            <path
                                                d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5"/>
                                            <path d="M7 10.5l5-7 5 7"/>
                                            <path d="M12 3v12"/>
                                        </svg>
                                        <div class="native-text">Klik tombol pilih atau seret file ke sini</div>
                                        <div class="native-sub">Maks 4MB — format: jpg, png, gif</div>
                                        <button type="button" id="native-btn" class="native-btn @error('image') btn-false  @enderror">Pilih Gambar</button>
                                    </div>

                                    <input type="file" id="native-image" name="image" accept="image/*"
                                           class="native-input">

                                    <div id="native-preview-wrapper" class="native-preview-wrapper" aria-hidden="true">
                                        <img id="native-preview" class="native-preview" alt="Preview gambar"/>
                                        <button type="button" id="native-remove" class="native-remove"
                                                title="Hapus gambar">Hapus
                                        </button>
                                    </div>
                                </div>
                            </div>
                            @error('image')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center pt-3">
                        <a href="{{ route('fasilitas.index') }}"
                           class="btn btn-danger font-weight-semibold shadow-sm btn-hover-rise">
                            Batal
                        </a>
                        <button type="submit" class="btn btn-primary font-weight-semibold shadow-sm btn-hover-rise"
                                style="background-color: #3396D3; border-color: #3396D3;">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        .native-dropzone {
            border: 2px dashed #d4d7db;
            border-radius: 10px;
            background: #fafafa;
            min-height: 250px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 18px;
            position: relative;
            overflow: hidden;
            transition: border-color .15s ease, background .15s ease, box-shadow .15s ease;
            outline: none;
        }

        .native-dropzone.border-error {
            border-color: #ff4d4f; /* Warna merah yang jelas untuk error */
            box-shadow: 0 0 0 3px rgba(255, 77, 79, 0.1); /* Opsional: memberikan sedikit bayangan */
        }

        .native-dropzone:focus,
        .native-dropzone.dragover {
            border-color: #3396D3;
            background: #f0f9ff;
            box-shadow: 0 6px 18px rgba(51, 150, 211, .08);
        }

        .native-placeholder {
            text-align: center;
            color: #6b7280;
            pointer-events: none;
        }

        .native-icon {
            width: 48px;
            height: 48px;
            margin: 0 auto 8px;
            opacity: 0.9;
        }

        .native-text {
            font-size: 14px;
            margin-bottom: 4px;
        }

        .native-sub {
            font-size: 12px;
            color: #9aa0a6;
            margin-bottom: 10px;
        }

        .native-btn {
            pointer-events: auto;
            display: inline-block;
            padding: 8px 14px;
            border-radius: 6px;
            background: #e6f4ff;
            color: #1673b8;
            border: 1px solid rgba(22, 115, 184, 0.12);
            cursor: pointer;
            font-weight: 600;
            font-size: 14px;
        }

        .native-input {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
            z-index: 2;
        }

        /* preview */
        .native-preview-wrapper {
            display: none;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100%;
            position: relative;
            padding: 12px;
            box-sizing: border-box;
        }

        .native-preview {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
            border-radius: 8px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.06);
            display: block;
            margin: 0 auto;
        }

        /* remove button */
        .native-remove {
            position: absolute;
            right: 12px;
            top: 12px;
            background: rgba(0, 0, 0, 0.6);
            color: #fff;
            border: none;
            padding: 6px 8px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 13px;
            display: inline-block;
        }

        .btn-false {
            pointer-events: none;
            background: #ffe2e2 ;
            color: #d12e2e ;
            border: 1px solid rgba(209, 46, 46, 0.12);
        }

        /* small screens */
        @media (max-width: 576px) {
            .native-dropzone {
                min-height: 200px;
                padding: 12px;
            }

            .native-icon {
                width: 40px;
                height: 40px;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const dropzone = document.getElementById('native-dropzone');
            const fileInput = document.getElementById('native-image');
            const previewWrapper = document.getElementById('native-preview-wrapper');
            const previewImg = document.getElementById('native-preview');
            const placeholder = document.getElementById('native-placeholder');
            const removeBtn = document.getElementById('native-remove');
            const btn = document.getElementById('native-btn');

            btn.addEventListener('click', (e) => {
                e.preventDefault();
                fileInput.click();
            });

            function handleFile(file) {
                if (!file) {
                    resetPreview();
                    return;
                }

                const maxSize = 4 * 1024 * 1024; // 4MB
                if (file.size > maxSize) {
                    alert('Ukuran file terlalu besar. Maks: 4MB.');
                    fileInput.value = '';
                    resetPreview();
                    return;
                }

                if (!file.type.startsWith('image/')) {
                    alert('Tipe file tidak valid. Harap pilih gambar (jpg, png, gif).');
                    fileInput.value = '';
                    resetPreview();
                    return;
                }

                const reader = new FileReader();
                reader.onload = function (ev) {
                    previewImg.src = ev.target.result;
                    placeholder.style.display = 'none';
                    previewWrapper.style.display = 'flex';
                    previewWrapper.setAttribute('aria-hidden', 'false');
                };
                reader.readAsDataURL(file);
            }

            fileInput.addEventListener('change', function (e) {
                const file = e.target.files[0];
                handleFile(file);
            });

            ['dragenter', 'dragover'].forEach(evt => {
                dropzone.addEventListener(evt, function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                    dropzone.classList.add('dragover');
                });
            });

            ['dragleave', 'drop'].forEach(evt => {
                dropzone.addEventListener(evt, function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                    dropzone.classList.remove('dragover');
                });
            });

            dropzone.addEventListener('drop', function (e) {
                const dt = e.dataTransfer;
                if (!dt) return;
                const file = dt.files[0];
                if (file) {
                    fileInput.files = dt.files;
                    handleFile(file);
                }
            });

            removeBtn.addEventListener('click', function () {
                fileInput.value = '';
                resetPreview();
            });

            function resetPreview() {
                previewImg.src = '';
                previewWrapper.style.display = 'none';
                previewWrapper.setAttribute('aria-hidden', 'true');
                placeholder.style.display = 'block';
            }

            dropzone.addEventListener('keydown', function (e) {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    fileInput.click();
                }
            });
        });
    </script>
@endsection
