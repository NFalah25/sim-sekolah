@extends('app.Template')
@section('title', 'Edit Pengumuman')

@section('content')
    <div class="section-header">
        <h2 class="h4 font-weight-bold mb-1">Ubah Pengumuman</h2>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4 class="font-weight-semibold">Form Edit Pengumuman</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('pengumuman.update', $pengumuman->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="title" class="font-weight-semibold">Nama Pengumuman</label>
                                <input type="text" id="title" name="title"
                                    placeholder="Contoh: Pendaftaran Masuk SD" value="{{ $pengumuman->title }}"
                                    class="form-control rounded-lg @error('title') is-invalid @enderror">
                                @error('title')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="description" class="font-weight-semibold">Deskripsi Pengumuman</label>
                                <textarea id="description" name="description" placeholder="Masukkan deskripsi pengumuman"
                                    class="form-control rounded-lg @error('description') is-invalid @enderror" rows="3" style="height: auto">{{ $pengumuman->description }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                        </div>

                        <div class="col-md-6 mb-4">
                            <div class="form-group">
                                <label for="date_published" class="font-weight-semibold">Tanggal Agenda</label>
                                <input type="date" id="date_published" name="date_published"
                                    value="{{ \Carbon\Carbon::parse($pengumuman->date_published)->format('Y-m-d') }}"
                                    class="form-control rounded-lg @error('date_published') is-invalid @enderror">
                                @error('date_published')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3 mb-4">
                            <div class="form-group">
                                <label for="category" class="font-weight-semibold">Kategori</label>
                                <select id="category" name="category"
                                    class="form-control rounded-lg @error('category') is-invalid @enderror">
                                    <option value="" disabled selected>Pilih Kategori</option>
                                    <option value="akademik" {{ $pengumuman->category == 'akademik' ? 'selected' : '' }}>
                                        Akademik
                                    </option>
                                    <option value="kesiswaan" {{ $pengumuman->category == 'kesiswaan' ? 'selected' : '' }}>
                                        Kesiswaan
                                    </option>
                                    <option value="humas" {{ $pengumuman->category == 'humas' ? 'selected' : '' }}>
                                        Humas
                                    </option>
                                    <option value="umum" {{ $pengumuman->category == 'umum' ? 'selected' : '' }}>
                                        Umum
                                    </option>
                                    <option value="lainnya" {{ $pengumuman->category == 'lainnya' ? 'selected' : '' }}>
                                        Lainnya
                                    </option>
                                </select>
                                @error('category')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="is_pinned" class="font-weight-semibold">Status</label>
                                <select id="is_pinned" name="is_pinned"
                                    class="form-control rounded-lg @error('is_pinned') is-invalid @enderror">
                                    <option value="" disabled selected>Pilih Status</option>
                                    <option value="1" {{ $pengumuman->is_pinned == true ? 'selected' : '' }}>Penting
                                    </option>
                                    <option value="0" {{ $pengumuman->is_pinned == false ? 'selected' : '' }}>Biasa
                                    </option>
                                </select>
                                @error('is_pinned')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center pt-3">
                        <a href="{{ route('acara.index') }}"
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

@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/bootstrap-daterangepicker/daterangepicker.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('assets/cleave.js/dist/cleave.min.js') }}"></script>
    <script src="{{ asset('assets/cleave.js/dist/addons/cleave-phone.us.js') }}"></script>
    <script src="{{ asset('assets/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    {{--    <script src="{{asset('assets/js/page/forms-advanced-forms.js')}}"></script> --}}
    <script>
        $('#is_pinned').on('change', function() {
            if (this.value == '1') {
                $('#is_pinned').css('background-color', '#28a745');
                $('#is_pinned').css('color', '#ffffff');
            } else if (this.value == '0') {
                $('#is_pinned').css('background-color', '#6c757d');
                $('#is_pinned').css('color', '#ffffff');
            } else {
                $('#is_pinned').css('background-color', '');
                $('#is_pinned').css('color', '');
            }
        });
        $('#is_pinned').trigger('change');
    </script>
@endpush
