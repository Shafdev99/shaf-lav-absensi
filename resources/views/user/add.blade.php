<!-- Content -->
@extends('layout.app')
@section('title', 'Tambah Data Pengguna')
@section('content')
    <div class="content">

        <div class="container ">

            <!-- Breadcrumb -->
            <div class="breadcrumb">
                <a href="{{ route('user') }}">Data User </a> / Tambah Data Admin
            </div>
            {{-- <h5>Tambah Data</h5> --}}
            <div class="row mt-4">
                <div class="col-12 col-lg-9 mx-auto">
                    <div class="card p-lg-3 py-3 card-content">
                        {{-- Head Button --}}
                        <div class="d-flex mt-2 mb-3 px-2 justify-content-between">
                            <a href="{{ route('user') }}" class="btn btn-primary ms-2">
                                <i class="bi bi-arrow-left"></i>
                                Kembali
                            </a>
                            <h6 class="fw-bold align-self-center me-2">Tambah Data</h6>
                        </div>
                        {{-- End --}}

                        {{-- Form Data --}}
                        <form action="{{ route('user.store') }}" method="post">
                            @csrf

                            {{-- Data User --}}
                            <div class="container-fluid mt-4">
                                <h5 class="fw-bold">Data User</h5>
                                <hr>
                                <div class="row">
                                    <div class="col">

                                        {{-- Nama Lengkap --}}
                                        <div class="mb-4 mt-2">
                                            <label for="name" class="form-label">Nama Lengkap
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                id="name" placeholder="Masukan nama lengkap!" name="name"
                                                value="{{ old('name') }}">
                                            @error('name')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                        </div>

                                        {{-- Username --}}
                                        <div class="mb-4 mt-2">
                                            <label for="username" class="form-label">Username
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text"
                                                class="form-control @error('username') is-invalid @enderror" id="username"
                                                placeholder="Masukan Username!" name="username"
                                                value="{{ old('username') }}">
                                            @error('username')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                            <div class="form-check mt-2">
                                                <input class="form-check-input" type="checkbox" id="by-name">
                                                <label class="form-check-label" for="flexCheckChecked">
                                                    By name
                                                </label>
                                            </div>
                                        </div>

                                        {{-- Email --}}
                                        <div class="mb-4 mt-2">
                                            <label for="email" class="form-label">Email
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                                id="email" placeholder="Masukan email!" name="email"
                                                value="{{ old('email') }}">
                                            @error('email')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                        </div>

                                        {{-- password --}}
                                        <div class="mb-4 mt-2">
                                            <label for="password" class="form-label">Password
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text"
                                                class="form-control @error('password') is-invalid @enderror" id="password"
                                                placeholder="Masukan password!" name="password"
                                                value="{{ old('password') }}">
                                            @error('password')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                            <div class="form-check mt-2">
                                                <input class="form-check-input" type="checkbox" id="isi-password">
                                                <label class="form-check-label" for="flexCheckChecked">
                                                    By default
                                                </label>
                                            </div>
                                        </div>

                                        {{-- role --}}
                                        {{-- <input type="hidden" name="role" value="{{ $role }}"> --}}
                                        {{-- <div class="mb-3 mt-2">
                                            <label for="role" class="form-label">Role
                                                <span class="text-danger">*</span>
                                            </label>
                                            <select name="role" class="form-control @error('role') is-invalid @enderror"
                                                id="role">
                                                <option value="">Pilih Role</option>
                                                @foreach ($role as $Role)
                                                    <option value="{{ $Role }}"
                                                        {{ old('role') == $Role ? 'selected' : '' }}>
                                                        {{ Str::ucfirst($Role) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('role')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror

                                        </div> --}}

                                    </div>
                                </div>
                            </div>

                            {{-- Tombol Simpan --}}
                            <div class="container-fluid mt-5">
                                <div class="row col">
                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-primary float-end">
                                            <i class="bi bi-send-fill me-1"></i>
                                            Simpan
                                        </button>
                                        <button type="Reset" class="btn btn-default-2 float-end me-2">Reset</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        {{-- End --}}

                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {

            // Gunakan username berdasarkan nama
            $('#by-name').click(function() {
                const name = $('#name').val().replaceAll(/\./g, '').replaceAll(/\s/g, '').toLowerCase();
                if ($(this).is(":checked")) {
                    $('#username').val(name);
                } else {
                    $('#username').val('');
                }
            });

            // Gunakan password dari sistem
            $('#isi-password').click(function() {
                if ($(this).is(':checked')) {
                    $('#password').val('{{ $passDefault->password_user }}');
                } else {
                    $('#password').val('');
                }
            });
        });
    </script>
@endpush
