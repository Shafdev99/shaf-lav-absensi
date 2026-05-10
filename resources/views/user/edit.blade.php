<!-- Content -->
@extends('layout.app')
@section('title', 'Ubah Data Pengguna')
@section('content')
    <div class="content">

        <div class="container ">

            <!-- Breadcrumb -->
            <div class="breadcrumb">
                <a href="{{ route('user') }}">Data User </a> / Ubah Data
            </div>
            {{-- <h5>Ubah Data</h5> --}}
            <div class="row mt-4">
                <div class="col col-lg-9 mx-auto">
                    <div class="card p-lg-3 py-3 px-0 card-content">
                        {{-- Head Button --}}
                        <div class="d-flex mt-2 mb-3 px-2 justify-content-between">
                            <a href="{{ route('user') }}" class="btn btn-primary ms-2">
                                <i class="bi bi-arrow-left"></i>
                                Kembali
                            </a>
                            <h6 class="fw-bold align-self-center me-2">Ubah Data</h6>
                        </div>
                        {{-- End --}}

                        {{-- Form Data --}}
                        <form action="{{ route('user.update', $user->id) }}" method="post">
                            @csrf
                            @method('put')
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
                                                value="{{ old('name') ? old('name') : $user->name }}">
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
                                                value="{{ old('username') ? old('username') : $user->username }}">
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
                                                value="{{ old('email') ? old('email') : $user->email }}">
                                            @error('email')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                        </div>

                                        {{-- Role --}}
                                        {{-- <div class="mb-3 mt-2">
                                            <label for="role" class="form-label">Role
                                                <span class="text-danger">*</span>
                                            </label>
                                            <select name="role" class="form-control @error('role') is-invalid @enderror"
                                                id="role">
                                                <option value="">Pilih Role</option>
                                                <option value="admin"
                                                    {{ $user->role == 'admin' || old('role') == 'admin' ? 'selected' : '' }}>
                                                    Admin
                                                </option>
                                                <option value="user"
                                                    {{ $user->role == 'user' || old('role') == 'user' ? 'selected' : '' }}>
                                                    User
                                                </option>
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
                                            Update
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
                const asli = '{{ $user->username }}';
                if ($(this).is(":checked")) {
                    $('#username').val(name);
                } else {
                    $('#username').val(asli);
                }
            });

        });
    </script>
@endpush
