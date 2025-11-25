@extends('app.Template')
@section('title', 'Fasilitas Sekolah')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Prestasi Murid & Sekolah</h1>
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
                document.addEventListener('DOMContentLoaded', function () {
                    const notif = document.getElementById('notification');
                    if (notif) {
                        setTimeout(() => {
                            $(notif).alert('close');
                        }, 3000);
                        $(notif).on('closed.bs.alert', function () {});
                    }
                });
            </script>
        @endif

        <div class="section-body">
            <div class="card">
                <div class="card-header d-flex flex-wrap justify-content-between align-items-center">
                    <h4 class="mb-3 mb-md-0">Daftar Prestasi</h4>
                    <div class="d-flex flex-wrap align-items-center gap-2 justify-content-center">
                        {{-- Search --}}
                        <form class="form-inline mr-2" method="GET" action="">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Cari Prestasi..." name="search"
                                       value="{{ request('search') }}">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </form>

                        <a href="{{ route('prestasi.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus mr-1"></i> Tambah Prestasi
                        </a>
                    </div>
                </div>

                <div class="card-body p-2">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Tipe</th>
                                <th>Tingkat</th>
                                <th>Gambar</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse ($achievements as $index => $data)
                                <tr>
                                    <td>{{ $index + $achievements->firstItem() }}</td>
                                    <td>{{ $data->title }}</td>
                                    <td>{{ $data->type == 'akademik' ? 'Akademik' : 'Non-Akademik' }}</td>
                                    <td>{{ $data->level }}</td>
                                    <td>
                                        @if ($data->image)
                                            <a href="{{ asset('storage/' . $data->image) }}" target="_blank"
                                               rel="noopener">
                                                <img src="{{ asset('storage/' . $data->image) }}"
                                                     alt="{{ $data->title }}" class="img-thumbnail"
                                                     style="width: 60px; height: 60px; object-fit: cover;">
                                            </a>
                                        @else
                                            <span class="text-muted font-italic">Tidak ada</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('prestasi.edit', $data->id) }}"
                                           class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('prestasi.destroy', $data->id) }}" method="POST"
                                              class="d-inline"
                                              onsubmit="return confirm('Yakin ingin menghapus prestasi ini?')">
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

                @if ($achievements->hasPages())
                    <div class="card-footer d-flex justify-content-between align-items-center">
                        <div class="text-muted small">
                            Menampilkan <b>{{ $achievements->firstItem() }}</b> -
                            <b>{{ $achievements->lastItem() }}</b> dari
                            <b>{{ $achievements->total() }}</b> data
                        </div>
                        <div>
                            {{ $achievements->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection
