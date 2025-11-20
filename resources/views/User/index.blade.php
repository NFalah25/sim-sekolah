@extends('app.Template')
@section('title', 'Pengaturan Akun')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Daftar Akun</h1>
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
                        $(notif).on('closed.bs.alert', function () {
                        });
                    }
                });
            </script>
        @endif

        <div class="section-body">
            <div class="card">
                <div class="card-header d-flex flex-wrap justify-content-between align-items-center">
                    <h4 class="mb-3 mb-md-0">Daftar Akun</h4>
                    <div class="d-flex flex-wrap align-items-center gap-2 justify-content-center">
                        <form class="form-inline mr-2" method="GET" action="">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Cari nama" name="search"
                                       value="{{ request('search') }}">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                        <a href="{{ route('user.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus mr-1"></i>Buat Akun Baru
                        </a>
                    </div>
                </div>

                <div class="card-body p-2">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead class="thead-light">
                            <tr>
                                <th>Nama</th>
                                <th>email</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse ($user as $index => $data)
                                <tr>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->email }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('user.edit', $data->id) }}"
                                           class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('user.destroy', $data->id) }}" method="POST"
                                              class="d-inline"
                                              onsubmit="return confirm('Yakin ingin menghapus akun ini?')">
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
                                    <td colspan="5" class="text-center text-muted">Belum ada data.</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                @if ($user->hasPages())
                    <div class="card-footer d-flex justify-content-between align-items-center">
                        <div class="text-muted small">
                            Menampilkan <b>{{ $user->firstItem() }}</b> -
                            <b>{{ $user->lastItem() }}</b> dari
                            <b>{{ $user->total() }}</b> data
                        </div>
                        <div>
                            {{ $user->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection
