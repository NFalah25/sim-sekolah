@extends('app.Template')
@section('title', 'Berita Sekolah')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Berita Sekolah</h1>
        </div>

        {{-- Notification --}}
        @if (session('success') || session('error') || session('warning'))
            <div id="notification"
                 class="alert @if(session('success')) {{'alert-success'}} @elseif(session('warning')) {{'alert-warning'}} @else {{'alert-danger'}} @endif alert-dismissible fade show"
                 role="alert">
                {{ session('success') ?? session('error') ?? session('warning') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const notif = document.getElementById('notification');
                    if (notif) {
                        setTimeout(() => {
                            $(notif).alert('close');
                        }, 3000);
                        $(notif).on('closed.bs.alert', function () {
                        });
                    }
                });
            </script>
        @endif

        <div class="section-body">
            <div class="card">
                <div class="card-header d-flex flex-wrap justify-content-between align-items-center">
                    <h4 class="mb-3 mb-md-0">Daftar Berita</h4>
                    <div class="d-flex flex-wrap align-items-center gap-2 justify-content-center">
                        <a href="{{ route('berita.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus mr-1"></i> Tambah Berita
                        </a>
                    </div>
                </div>

                <div class="card-body p-2">
                    <div class="row justify-content-between pl-3 pr-3">
                        <form class="col-md-3" method="GET" action="">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Cari Prestasi..." name="search"
                                       value="{{ request('search') }}">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                        <div class="col-md-3 form-group ">
                            <select class="form-control" id="statusFilter">
                                <option value="1">Semua Status</option>
                                <option value="2">Published</option>
                                <option value="3">Draft</option>
                            </select>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead class="thead-light">
                            <tr>
                                <th>Nama</th>
                                <th>Deskripsi</th>
                                <th>Status</th>
                                <th>Gambar</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse ($news as $index => $data)
                                <tr>
                                    <td>{{ $data->title }}</td>
                                    <td>{{ Str::limit($data->description, 100) }}</td>
                                    <td>
                                        @if ($data->status === 1)
                                            <span class="badge badge-success">Published</span>
                                        @else
                                            <span class="badge badge-secondary" style="color: #616161; font-weight:bolder; font-size: 0.9em; ">Draft</span>
                                        @endif
                                    <td>
                                        @if ($data->image)
                                            <a href="{{ asset('storage/' . $data->image) }}" target="_blank"
                                               rel="noopener">
                                                <img src="{{ asset('storage/' . $data->image) }}"
                                                     alt="{{ $data->title }}" class="img-thumbnail"
                                                     style="width: 100px; height: 100px; object-fit: cover;">
                                            </a>
                                        @else
                                            <span class="text-muted font-italic">Tidak ada</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('berita.edit', $data->id) }}"
                                           class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('berita.destroy', $data->id) }}" method="POST"
                                              class="d-inline"
                                              onsubmit="return confirm('Yakin ingin menghapus berita ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted">Belum ada data Prestasi.</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                @if ($news->hasPages())
                    <div class="card-footer d-flex justify-content-between align-items-center">
                        <div class="text-muted small">
                            Menampilkan <b>{{ $news->firstItem() }}</b> -
                            <b>{{ $news->lastItem() }}</b> dari
                            <b>{{ $news->total() }}</b> data
                        </div>
                        <div>
                            {{ $news->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection

@push('styles')
{{--    <link rel="stylesheet" href="../node_modules/select2/dist/css/select2.min.css">--}}
{{--    <link rel="stylesheet" href="../node_modules/selectric/public/selectric.css">--}}
@endpush

@push('scripts')
    <script src="{{asset('assets/js/page/forms-advanced-forms.js')}}"></script>
    <script>
        $(document).ready(function(){
           const filter = $('#statusFilter');
           const status = new URL(window.location.href).searchParams.get('status');

            filter.on('change', function(){
                const selectedValue = $(this).val();
                let url = new URL(window.location.href);
                if(selectedValue == 1){
                    url.searchParams.delete('status');
                } else if(selectedValue == 2){
                    url.searchParams.set('status', 'published');
                } else if(selectedValue == 3){
                    url.searchParams.set('status', 'draft');
                }
                window.location.href = url.toString();
            })

            if(status === 'published'){
                filter.val(2);
            } else if(status === 'draft'){
                filter.val(3);
            } else {
                filter.val(1);
            }


        });
    </script>
@endpush
