@extends('app.Template')
@section('title', 'Tambah agenda')

@section('content')
    <div class="section-header">
        <h2 class="h4 font-weight-bold mb-1">Tambah Agenda</h2>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4 class="font-weight-semibold">Form Tambah Agenda</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('acara.store') }}" method="POST">
                    @csrf
                    <div class="form-row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name" class="font-weight-semibold">Nama agenda</label>
                                <input type="text" id="name" name="name"
                                       placeholder="Contoh: Pendaftaran Masuk SD" value="{{old('name')}}"
                                       class="form-control rounded-lg @error('name') is-invalid @enderror">
                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="description" class="font-weight-semibold">Deskripsi Agenda</label>
                                <textarea id="description" name="description"
                                          placeholder="Masukkan deskripsi agenda"
                                          class="form-control rounded-lg @error('description') is-invalid @enderror"
                                          rows="3" style="height: auto">{{ old('description') }}</textarea>

                                @error('description')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="lokasi" class="font-weight-semibold">Lokasi</label>
                                <input id="lokasi" name="lokasi"
                                       placeholder="Masukkan lokasi agenda" value="{{old('lokasi')}}"
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
                                <label for="date" class="font-weight-semibold">Tanggal Agenda</label>
                                <input type="date" id="date" name="date"
                                       value="{{ old('date') }}"
                                       class="form-control rounded-lg daterange-cus @error('date') is-invalid @enderror">
                                @error('date')
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
                                       value="{{ old('start_time') }}"
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
                                       value="{{ old('end_time') }}"
                                       class="form-control rounded-lg @error('end_time') is-invalid @enderror">
                                @error('end_time')
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
    <link rel="stylesheet" href="{{asset('assets/bootstrap-daterangepicker/daterangepicker.css')}}">
@endpush

@push('scripts')
    <script src="{{asset('assets/cleave.js/dist/cleave.min.js')}}"></script>
    <script src="{{asset('assets/cleave.js/dist/addons/cleave-phone.us.js')}}"></script>
    <script src="{{asset('assets/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
    {{--    <script src="{{asset('assets/js/page/forms-advanced-forms.js')}}"></script>--}}
    <script>
        // $('.daterange-cus').daterangepicker({
        //     locale: {format: 'YYYY-MM-DD'},
        //     drops: 'down',
        //     opens: 'right'
        // });

        const color = $('#color');

        color.change(function() {
            const selectedColor = $(this).val();
            color.css('color', selectedColor);
            color.css('border-color', selectedColor);
            color.css('font-weight', 'bold');
        });


    </script>
@endpush

