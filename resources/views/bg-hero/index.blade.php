@extends('app.Template')

@section('title', 'Kelola Gambar Hero')

@section('content')
<!-- STYLE CSS LANGSUNG DI SINI -->
<style>
    /* --- CUSTOM CARD STYLE --- */
    .article-style-b .article-image {
        border-radius: 5px 5px 0 0;
        background-size: cover;
        background-position: center;
        transition: transform 0.3s ease;
    }
    .article-style-b:hover .article-image { transform: scale(1.02); }
    .article-style-b {
        box-shadow: 0 4px 8px rgba(0,0,0,0.03);
        border: 1px solid #f2f2f2;
        transition: all 0.3s;
        border-radius: 5px;
        background-color: #fff;
    }
    .article-style-b:hover {
        box-shadow: 0 15px 30px rgba(0,0,0,0.1);
        transform: translateY(-5px);
        z-index: 10;
    }

    /* --- GLOBAL CUSTOM MODAL STYLES --- */
    .custom-overlay {
        position: fixed;
        top: 0; left: 0; width: 100%; height: 100%;
        background: rgba(0, 0, 0, 0.7); /* Backdrop lebih gelap agar fokus */
        z-index: 100000 !important; /* Pastikan di atas segalanya, termasuk sidebar Stisla (biasanya 890) */
        display: none; /* Default hidden */
        align-items: center; justify-content: center;
        opacity: 0; transition: opacity 0.3s ease;
        backdrop-filter: blur(5px);
    }

    .custom-overlay.active {
        display: flex;
        opacity: 1;
    }

    .custom-popup {
        background: #fff;
        width: 100%; max-width: 500px;
        border-radius: 12px;
        box-shadow: 0 20px 50px rgba(0,0,0,0.4);
        transform: scale(0.9);
        transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        overflow: hidden;
        display: flex; flex-direction: column;
        max-height: 90vh;
    }

    .custom-popup.preview-mode {
        max-width: 90%;
        background: transparent;
        box-shadow: none;
    }

    .custom-overlay.active .custom-popup {
        transform: scale(1);
    }

    /* Elemen Modal */
    .popup-header {
        padding: 15px 20px;
        border-bottom: 1px solid #eee;
        display: flex; justify-content: space-between; align-items: center;
        background: #fbfbfb;
    }
    .popup-title { font-size: 16px; font-weight: 700; color: #333; margin: 0; }
    .popup-close { background: none; border: none; font-size: 24px; color: #999; cursor: pointer; line-height: 1; }
    .popup-close:hover { color: #ff5b57; }

    .popup-body {
        padding: 20px;
        overflow-y: auto;
    }

    .popup-footer {
        padding: 15px 20px;
        border-top: 1px solid #eee;
        background: #fbfbfb;
        text-align: right;
    }

    /* Input File Custom */
    .file-upload-wrapper {
        position: relative;
        height: 180px;
        border: 2px dashed #e4e6fc;
        border-radius: 8px;
        background: #f9fafe;
        display: flex; align-items: center; justify-content: center; flex-direction: column;
        overflow: hidden;
        transition: border-color 0.3s;
        cursor: pointer;
    }
    .file-upload-wrapper:hover { border-color: #6777ef; }
    .file-upload-wrapper.is-invalid { border-color: #dc3545; background-color: #fdf2f2; }

    .file-upload-input {
        position: absolute; width: 100%; height: 100%; opacity: 0; cursor: pointer; z-index: 5;
    }

    .file-upload-label {
        color: #6c757d; font-size: 14px; text-align: center; pointer-events: none;
        display: flex; flex-direction: column; align-items: center; justify-content: center;
        width: 100%; height: 100%;
    }

    /* Preview Image di Form */
    #formImgPreview {
        max-height: 100%; max-width: 100%; object-fit: contain;
        display: none;
        position: absolute; top: 0; left: 0; right: 0; bottom: 0; margin: auto; z-index: 1;
    }

    /* Preview Image Full */
    #fullImgPreview {
        max-width: 100%; max-height: 85vh; border-radius: 8px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.5);
    }
</style>

<section class="section">
    <div class="section-header">
        <h1>Hero Slider</h1>
        <div class="section-header-button">
            <button class="btn btn-primary" onclick="openFormModal('create')">
                <i class="fas fa-plus"></i> Tambah Gambar
            </button>
        </div>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Hero</a></div>
            <div class="breadcrumb-item">Galeri</div>
        </div>
    </div>

    <!-- FLASH MESSAGE -->
    @if (session('success') || session('error') || session('warning') || $errors->any())
        <div id="notification"
             class="alert @if(session('success')) {{'alert-success'}} @elseif(session('warning')) {{'alert-warning'}} @else {{'alert-danger'}} @endif alert-dismissible fade show"
             role="alert">
            {{ session('success') ?? session('error') ?? session('warning') ?? $errors->first() }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const notif = document.getElementById('notification');
                if (notif) {
                    setTimeout(() => { $(notif).alert('close'); }, 3000);
                }
            });
        </script>
    @endif

    <div class="section-body">
        <h2 class="section-title">Galeri Hero Landing Page</h2>
        <p class="section-lead">
            Kelola gambar slider utama. Gambar ini akan ditampilkan secara bergantian di halaman depan.
        </p>

        <!-- Gallery Container -->
        <div class="row">
            @forelse ($heroes as $hero)
                <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-4">
                    <article class="article article-style-b h-100 d-flex flex-column shadow-sm border-0">
                        <div class="article-header">
                            <div class="article-image"
                                 data-background="{{ asset('storage/' . $hero->image) }}"
                                 style="background-image: url('{{ asset('storage/' . $hero->image) }}'); height: 250px;">
                            </div>
                            <div class="article-badge">
                                <div class="article-badge-item bg-primary">
                                    <i class="fas fa-image"></i> Slide {{ $loop->iteration }}
                                </div>
                            </div>
                        </div>

                        <div class="article-details d-flex align-items-center justify-content-between py-3 px-4">
                            <!-- Preview Button -->
                            <button class="btn btn-icon btn-light btn-sm shadow-sm"
                                    onclick="openImageModal('{{ asset('storage/' . $hero->image) }}')"
                                    data-toggle="tooltip"
                                    title="Lihat Full">
                                <i class="fas fa-eye"></i>
                            </button>

                            <div class="buttons">
                                <!-- Edit Button -->
                                <button class="btn btn-warning btn-sm shadow-sm"
                                        onclick="openFormModal('edit', '{{ $hero->id }}', '{{ asset('storage/' . $hero->image) }}')"
                                        data-toggle="tooltip"
                                        title="Ganti Gambar">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>

                                <!-- Delete Form -->
                                <form action="{{ route('hero.destroy', $hero->id) }}" method="POST" class="d-inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger btn-sm btn-delete shadow-sm" data-toggle="tooltip" title="Hapus Gambar">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </article>
                </div>
            @empty
                <div class="col-12">
                    <div class="card">
                        <div class="card-body text-center py-5">
                            <div class="empty-state" data-height="400">
                                <div class="empty-state-icon bg-primary">
                                    <i class="fas fa-images text-white" style="font-size: 30px;"></i>
                                </div>
                                <h2>Belum ada Gambar Hero</h2>
                                <p class="lead">
                                    Halaman depan Anda masih kosong. Yuk, upload gambar slide show pertama Anda!
                                </p>
                                <button class="btn btn-primary mt-4" onclick="openFormModal('create')">Upload Gambar</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $heroes->links() }}
        </div>
    </div>
</section>

<!-- 1. CUSTOM MODAL: FORM INPUT/EDIT -->
<div id="modalFormOverlay" class="custom-overlay" style="display: none;">
    <div class="custom-popup">
        <div class="popup-header">
            <h3 class="popup-title" id="formModalTitle">Tambah Gambar</h3>
            <button type="button" class="popup-close" onclick="closeModal('modalFormOverlay')">&times;</button>
        </div>

        <form id="heroForm" action="" method="POST" enctype="multipart/form-data">
            @csrf
            <div id="methodField"></div>

            <div class="popup-body">
                <div class="form-group">
                    <label class="font-weight-bold">Upload Gambar <span class="text-danger">*</span></label>

                    <div class="file-upload-wrapper @error('image') is-invalid @enderror">
                        <input type="file" name="image" id="fileInput" class="file-upload-input" onchange="previewFile(this)">

                        <div id="uploadPlaceholder" class="file-upload-label">
                            <i class="fas fa-cloud-upload-alt text-primary mb-2" style="font-size: 32px;"></i>
                            <div>Klik atau Seret Gambar di sini</div>
                            <span class="text-muted small mt-1">(JPG, PNG, JPEG. Max 2MB)</span>
                        </div>

                        <img id="formImgPreview" src="" alt="Preview">
                    </div>

                    @error('image')
                        <div class="text-danger small mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="popup-footer">
                <button type="button" class="btn btn-secondary mr-2" onclick="closeModal('modalFormOverlay')">Batal</button>
                <button type="submit" class="btn btn-primary" id="btnSubmit">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- 2. CUSTOM MODAL: IMAGE PREVIEW FULL -->
<div id="modalImageOverlay" class="custom-overlay" onclick="closeModal('modalImageOverlay')" style="display: none;">
    <div class="custom-popup preview-mode">
        <div style="position: relative; width: 100%; text-align: center;">
            <button type="button" class="popup-close"
                    onclick="closeModal('modalImageOverlay')"
                    style="position: absolute; top: -40px; right: 0; color: #fff; font-size: 30px; opacity: 0.8;">&times;</button>

            <img id="fullImgPreview" src="" alt="Full Preview">
        </div>
    </div>
</div>

<!-- --- SCRIPT UTAMA --- -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // PERBAIKAN UTAMA: Pindahkan Modal ke Body saat Load
    // Ini menjamin modal berada di atas sidebar/navbar (stacking context root)
    document.addEventListener('DOMContentLoaded', function() {
        const formModal = document.getElementById('modalFormOverlay');
        const imgModal = document.getElementById('modalImageOverlay');

        if (formModal) document.body.appendChild(formModal);
        if (imgModal) document.body.appendChild(imgModal);

        // Cek jika ada error setelah reload, buka modal lagi
        @if ($errors->any())
            openFormModal('create');
        @endif
    });

    // --- 1. MODAL SYSTEM LOGIC ---
    function openFormModal(mode, id = null, imageUrl = null) {
        const overlay = document.getElementById('modalFormOverlay');
        const form = document.getElementById('heroForm');
        const title = document.getElementById('formModalTitle');
        const submitBtn = document.getElementById('btnSubmit');
        const methodField = document.getElementById('methodField');
        const preview = document.getElementById('formImgPreview');
        const placeholder = document.getElementById('uploadPlaceholder');
        const fileInput = document.getElementById('fileInput');

        form.reset();
        methodField.innerHTML = '';

        // Reset Validasi UI
        document.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
        document.querySelectorAll('.text-danger.small').forEach(el => el.remove());

        if (mode === 'create') {
            title.innerText = 'Tambah Gambar Hero';
            form.action = "{{ route('hero.store') }}";
            submitBtn.innerText = 'Simpan';
            preview.style.display = 'none';
            preview.src = '';
            placeholder.style.display = 'flex';
            fileInput.required = true;
        }
        else if (mode === 'edit') {
            title.innerText = 'Ganti Gambar Hero';
            let updateUrl = "{{ route('hero.update', ':id') }}";
            form.action = updateUrl.replace(':id', id);
            methodField.innerHTML = '<input type="hidden" name="_method" value="PUT">';
            submitBtn.innerText = 'Update';
            preview.src = imageUrl;
            preview.style.display = 'block';
            placeholder.style.display = 'none';
            fileInput.required = false;
        }

        overlay.style.display = 'flex';
        setTimeout(() => overlay.classList.add('active'), 10);
        document.body.style.overflow = 'hidden';
    }

    function openImageModal(imageUrl) {
        const overlay = document.getElementById('modalImageOverlay');
        const img = document.getElementById('fullImgPreview');
        img.src = imageUrl;
        overlay.style.display = 'flex';
        setTimeout(() => overlay.classList.add('active'), 10);
        document.body.style.overflow = 'hidden';
    }

    function closeModal(modalId) {
        let targetId = modalId;

        // Handle event object
        if (typeof modalId === 'object' && modalId.target) {
             const activeOverlay = document.querySelector('.custom-overlay[style*="display: flex"]');
             if(activeOverlay) targetId = activeOverlay.id;
             else return;
        }

        const overlay = document.getElementById(targetId);
        if(!overlay) return;

        overlay.classList.remove('active');

        setTimeout(() => {
            overlay.style.display = 'none';
            if(targetId === 'modalImageOverlay') {
                document.getElementById('fullImgPreview').src = '';
            }
        }, 300);

        document.body.style.overflow = '';
    }

    // --- 2. IMAGE PREVIEW LOGIC ---
    function previewFile(input) {
        const preview = document.getElementById('formImgPreview');
        const placeholder = document.getElementById('uploadPlaceholder');

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
                placeholder.style.display = 'none';
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    // --- 3. SWEETALERT DELETE ---
    document.addEventListener('click', function(e) {
        const btnDelete = e.target.closest('.btn-delete');
        if (btnDelete) {
            e.preventDefault();
            const form = btnDelete.closest('form');

            Swal.fire({
                title: 'Hapus Gambar Ini?',
                text: "Gambar akan dihapus permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) form.submit();
            });
        }
    });
</script>

@endsection
