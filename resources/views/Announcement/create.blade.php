@extends('app.Template')
@section('title', 'Tambah pengumuman')

@section('content')
    <div class="section-header">
        <h2 class="h4 font-weight-bold mb-1">Tambah Pengumuman</h2>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4 class="font-weight-semibold">Form Tambah Pengumuman</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('pengumuman.store') }}" method="POST">
                    @csrf
                    <div class="form-row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="title" class="font-weight-semibold">Nama pengumuman</label>
                                <input type="text" id="title" name="title"
                                    placeholder="Contoh: Pendaftaran Masuk SD" value="{{ old('title') }}"
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
                                    class="form-control rounded-lg @error('description') is-invalid @enderror" rows="3" style="height: auto">{{ old('description') }}</textarea>

                                @error('description')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <div class="form-group">
                                <label for="date_published" class="font-weight-semibold">Tanggal Pengumuman</label>
                                <input type="date" id="date_published" name="date_published"
                                    value="{{ old('date_published') }}"
                                    class="form-control rounded-lg daterange-cus @error('date_published') is-invalid @enderror">
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
                                    <option value="akademik" {{ old('category') == 'akademik' ? 'selected' : '' }}>Akademik
                                    </option>
                                    <option value="kesiswaan" {{ old('category') == 'kesiswaan' ? 'selected' : '' }}>
                                        Kesiswaan
                                    </option>
                                    <option value="humas" {{ old('category') == 'humas' ? 'selected' : '' }}>Humas
                                    </option>
                                    <option value="umum" {{ old('category') == 'umum' ? 'selected' : '' }}>Umum
                                    </option>
                                    <option value="lainnya" {{ old('category') == 'lainnya' ? 'selected' : '' }}>Lainnya
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
                                <label for="is_pinned" class="font-weight-semibold">Status
                                    <span class="ml-2 text-info" data-toggle="tooltip" data-placement="top"
                                        style="cursor: pointer;"
                                        title="Jika status dipilih 'Penting', data ini akan ditampilkan di halaman utama (Landing Page).">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" viewBox="0 0 16 16">
                                            <path
                                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.496 6.033h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286a.237.237 0 0 0 .241.247zm2.325 6.443c.61 0 1.029-.394 1.029-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94 0 .533.425.927 1.01.927z" />
                                        </svg>
                                    </span></label>
                                <select id="is_pinned" name="is_pinned"
                                    class="form-control rounded-lg @error('is_pinned') is-invalid @enderror">
                                    <option value="" disabled selected>Pilih Status</option>
                                    <option value="1" {{ old('is_pinned') == '1' ? 'selected' : '' }}>Penting
                                    </option>
                                    <option value="0" {{ old('is_pinned') == '0' ? 'selected' : '' }}>Biasa
                                    </option>
                                </select>
                                @error('end_time')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                    </div>
                    <div class="d-flex justify-content-between align-items-center pt-3">
                        <a href="{{ route('pengumuman.index') }}"
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
        $(document).ready(function() {
            $('#is_pinned').on('change', function() {
                if (this.value == '1') {
                    $('#is_pinned').addClass('bg-success');
                    $('#is_pinned').css('color', 'white');
                    $('#is_pinned').removeClass('bg-secondary ');
                } else if (this.value == '0') {
                    {
                        $('#is_pinned').addClass('bg-secondary');
                        $('#is_pinned').css('color', 'black');
                        $('#is_pinned').removeClass('bg-success');
                    }
                }
            });

            $('#is_pinned').trigger('change');
        });
    </script>
@endpush
