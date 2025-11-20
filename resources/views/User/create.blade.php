@extends('app.template')
@section('title', 'Add User')

@section('content')
    <div class="section-header">
        <h2 class="h4 font-weight-bold mb-1">Tambah User</h2>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4 class="font-weight-semibold">Form Tambah User</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('user.store') }}" method="POST" >
                    @csrf
                    <div class="form-row">
                        <div class="col-md-12 mb-4">
                            <div class="form-group">
                                <label for="name" class="font-weight-semibold">Nama</label>
                                <input type="text" id="name" name="name"
                                       placeholder="Contoh: User Admin" value="{{old('name')}}"
                                       class="form-control rounded-lg @error('name') is-invalid @enderror">
                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="email" class="font-weight-semibold">Email</label>
                                <input type="email" id="email" name="email"
                                       placeholder="Masukkan email" value="{{old('email')}}"
                                       class="form-control rounded-lg @error('email') is-invalid @enderror">
                                @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <div class="form-group">
                                <label for="password" class="font-weight-semibold">Password</label>
                                <input type="password" id="password" name="password"
                                       placeholder="Masukkan password"
                                       class="form-control rounded-lg @error('password') is-invalid @enderror">
                                @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="form-group">
                                <label for="password_confirmation" class="font-weight-semibold">Konfirmasi Password</label>
                                <input type="password" id="password_confirmation" name="password_confirmation"
                                       placeholder="Konfirmasi password"
                                       class="form-control rounded-lg @error('password_confirmation') is-invalid @enderror">
                                @error('password_confirmation')
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
