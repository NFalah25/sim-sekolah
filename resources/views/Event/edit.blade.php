@extends('app.Template')
@section('title', 'Edit Acara/kegiatan')

@section('content')
    <div class="section-header">
        <h2 class="h4 font-weight-bold mb-1">Ubah Kegiatan</h2>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4 class="font-weight-semibold">Form Edit Kegiatan</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('acara.update', $acara->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name" class="font-weight-semibold">Nama Acara</label>
                                <input type="text" id="name" name="name"
                                       placeholder="Contoh: Pendaftaran Masuk SD" value="{{$acara->title}}"
                                       class="form-control rounded-lg @error('name') is-invalid @enderror">
                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="description" class="font-weight-semibold">Deskripsi Kegiatan</label>
                                <textarea id="description" name="description"
                                          placeholder="Masukkan deskripsi kegiatan"
                                          class="form-control rounded-lg @error('description') is-invalid @enderror"
                                          rows="3" style="height: auto">{{ $acara->description }}</textarea>

                                @error('description')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="lokasi" class="font-weight-semibold">Lokasi</label>
                                <input id="lokasi" name="lokasi"
                                       placeholder="Masukkan lokasi kegiatan" value="{{$acara->location}}"
                                       class="form-control rounded-lg @error('lokasi') is-invalid @enderror">
                                @error('lokasi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                        </div>

                        <div class="col-md-6 mb-4">
                            <div class="form-group">
                                <label for="date_range" class="font-weight-semibold">Tanggal Kegiatan</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-calendar"></i>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control daterange-cus @error('date_range') is-invalid @enderror" id="date_range"
                                           name="date_range"
                                           placeholder="Pilih rentang tanggal kegiatan">
                                </div>
                                @error('date_range')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3 mb-4">
                            <div class="form-group">
                                <label for="start_time" class="font-weight-semibold">Waktu Mulai</label>
                                <input type="time" id="start_time" name="start_time"
                                       value="{{ \Carbon\Carbon::parse($acara->start_date)->format('H:i') }}"
                                       class="form-control rounded-lg @error('start_time') is-invalid @enderror">
                                @error('start_time')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="end_time" class="font-weight-semibold">Waktu Selesai</label>
                                <input type="time" id="end_time" name="end_time"
                                       value="{{ \Carbon\Carbon::parse($acara->end_date)->format('H:i')  }}"
                                       class="form-control rounded-lg @error('end_time') is-invalid @enderror">
                                @error('end_time')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="block font-semibold">Kategori</label>
                                <select name="category" id="category" class="form-control @error('category') is-invalid @enderror">
                                    <option value="">Pilih Kategori</option>
                                    <option value="Lomba">Lomba</option>
                                    <option value="Praktek Sains">Praktek Sains</option>
                                    <option value="Webinar">Webinar</option>
                                </select>
                                @error('category')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="block font-semibold">Warna Penanda</label>
                                <select name="color" id="color" class="form-control @error('color') is-invalid @enderror">
                                    <option value="">Pilih Warna</option>
                                    <option value="red">Merah</option>
                                    <option value="blue">Biru</option>
                                    <option value="green">Hijau</option>
                                    <option value="purple">Ungu</option>
                                </select>
                                @error('color')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center pt-3">
                        <a href="{{ route('user.index') }}"
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
    <link rel="stylesheet" href="{{asset('assets/bootstrap-daterangepicker/daterangepicker.css')}}">
@endpush

@push('scripts')
    <script src="{{asset('assets/cleave.js/dist/cleave.min.js')}}"></script>
    <script src="{{asset('assets/cleave.js/dist/addons/cleave-phone.us.js')}}"></script>
    <script src="{{asset('assets/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
    {{--    <script src="{{asset('assets/js/page/forms-advanced-forms.js')}}"></script>--}}
    <script>
        $('.daterange-cus').daterangepicker({
            locale: {format: 'YYYY-MM-DD'},
            drops: 'down',
            opens: 'right',
            startDate: '{{ $acara->start_date }}',
            endDate: '{{ $acara->end_date }}',
        });

        const color = $('#color');
        const category = $('#category');

        color.change(function() {
            const selectedColor = $(this).val();
            color.css('color', selectedColor);
            color.css('border-color', selectedColor);
            color.css('font-weight', 'bold');
        });

        color.val('{{ $acara->color }}').trigger('change');
        category.val('{{ $acara->category }}').trigger('change');

    </script>
@endpush

