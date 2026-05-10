<!-- Content -->
@extends('layout.app')
@section('title', 'Profil Pengguna')
@section('content')
    <div class="content">

        <div class="container">

            <!-- Breadcrumb -->
            <div class="breadcrumb">
                Profil
            </div>

            {{-- Profil --}}
            <div class="row mt-4">
                <div class="col mx-auto">


                    <!-- General -->
                    <div class="row">
                        <div class="col col-lg-9 mx-auto">
                            <div class="card py-3 card-content">
                                <form action="">
                                    <div class="container">
                                        <div class="row text-center text-lg-start">
                                            <div class="col-12 col-md-2 col-lg-2">
                                                <img src="{{ $user?->foto_profil ? asset('storage/' . $user->foto_profil) : 'img/logo/profile.jpg' }}"
                                                    width="100" class="img-fluid rounded-pill" alt="foto-profil">
                                            </div>
                                            <div class="col-12 col-md-5 col-lg-5 my-lg-auto mt-2">
                                                <h5 class="d-block fw-bold name-profile">
                                                    {{ $user->name }}
                                                </h5>
                                                <span class="d-block role-profile">
                                                    {{ $user->role }}
                                                </span>
                                            </div>
                                            <div class="col-12 col-md-5 col-lg-5 my-lg-auto d-lg-flex mt-2">
                                                <a href="javascipt:void(0);" onclick="ubahFoto()"
                                                    class="btn btn-default ms-auto">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-pencil-square me-2"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                        <path fill-rule="evenodd"
                                                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                                    </svg>
                                                    Ubah Foto
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    {{-- Form Data --}}
                    <form action="{{ route('profil.update') }}" method="post">
                        @csrf
                        @method('put')
                        <!-- General -->
                        <div class="row mt-3">
                            <div class="col col-lg-9 mx-auto">
                                <div class="card p-3 pb-4 card-content card-profile">
                                    <h5>Profil</h5>
                                    <div class="row">
                                        <div class="col-12 col-lg-6 mt-4">
                                            <label for="" class="">Nama Lengkap</label>
                                            <input type="text"
                                                class="form-control form-borderless @error('name') is-invalid @enderror"
                                                id="
                                            name"
                                                placeholder="Masukan nama lengkap!" name="name"
                                                value="{{ old('name') ? old('name') : $user->name }}">
                                            @error('name')
                                                <div id=" validationServer03Feedback" class="invalid-feedback">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-12 col-lg-6 mt-4">
                                            <label for="" class="">Username</label>
                                            <input type="text"
                                                class="form-control form-borderless @error('username') is-invalid @enderror"
                                                id="username" placeholder="Masukan username!" name="username"
                                                value="{{ old('username') ? old('username') : $user->username }}">
                                            @error('username')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-lg-6 mt-4">
                                            <label for="" class="">Email</label>
                                            <input type="text"
                                                class="form-control form-borderless @error('email') is-invalid @enderror"
                                                id="email" placeholder="Masukan email!" name="email"
                                                value="{{ old('email') ? old('email') : $user->email }}">
                                            @error('email')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-12 col-lg-6 mt-4">
                                            <label for="" class="">New Password</label><br>
                                            <a href="javascript:void(0);" class="btn btn-primary" onclick="konfirPass()">
                                                <i class="bi bi-arrow-repeat"></i>
                                                Ganti Password
                                            </a>
                                        </div>
                                    </div>
                                    <div class="d-flex mt-5">
                                        <button type="reset" class="btn btn-default-2 mt-3 ms-auto me-2">
                                            Reset
                                        </button>
                                        <button type="submit" class="btn btn-primary mt-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-pencil-square me-2" viewBox="0 0 16 16">
                                                <path
                                                    d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                <path fill-rule="evenodd"
                                                    d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                            </svg>
                                            Ubah
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    {{-- End --}}


                </div>
            </div>

        </div>

    </div>

    {{-- Modal Ubah Foto --}}
    <div class="modal fade" id="ubahFoto" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="ubahFotoLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom">
                    <h6 class="modal-title fw-bold" id="ubahFotoLabel">Ubah Foto Profil</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{-- Foto Profil --}}
                    <form action="{{ route('ubahFotoProfil') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mx-auto">
                            <div class="@error('foto_profil') dropify-invalid @enderror foto-profil">
                                <input type="file" name="foto_profil" class="foto_profil rounded-pill"
                                    data-default-file="{{ $user?->foto_profil ? asset('storage/' . $user->foto_profil) : '' }}"
                                    data-allowed-file-extensions="jpg png jpeg" />
                            </div>
                            @error('foto_profil')
                                <div id="validationServer03Feedback" class="text-danger mt-1">{{ ucwords($message) }}
                                </div>
                            @enderror
                            <ul class="text-secondary mt-2" style="font-size: 12px;">
                                <li>Format file yang di dukung (JPEG, JPG, PNG)</li>
                                <li>Maksimum kapasitas file ( 1024 Kb / 1 Mb)</li>
                                <li>Dimensi yang disarankan ( 479 x 709 Pixel)</li>
                            </ul>
                        </div>
                        <button type="submit" class="btn btn-primary float-end">
                            <i class="bi bi-send-fill me-1"></i>
                            Simpan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- End --}}

    {{-- Modal Konfirmasi Reset Password --}}
    <div class="modal fade" id="konfirPass" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="konfirPassLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom">
                    <h6 class="modal-title fw-bold" id="konfirPassLabel">Konfirmasi</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="text-center peringatan-modal">Anda yakin ingin mengganti password?</p>
                    <div class="button-modal d-flex justify-content-center">
                        <button type="button" class="btn btn-default-2 me-2" data-bs-dismiss="modal">Batal</button>
                        <a href="javascript:void(0);" onclick="gantiPass()" class="btn btn-primary">
                            <i class="bi bi-arrow-repeat"></i>
                            Ganti
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- End --}}

    {{-- Modal Ganti Password --}}
    <div class="modal fade" id="gantiPassword" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="gantiPasswordLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom">
                    <h6 class="modal-title fw-bold" id="gantiPasswordLabel">Ganti Password</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('profil.respas') }}" method="post">
                        @csrf
                        <p class="text-center peringatan-modal">Silakan tulis password baru anda!</p>
                        <div class="col-9 mx-auto">
                            <input type="text" name="password" class="form-control mb-3"
                                placeholder="Masukan password baru anda!">
                        </div>
                        <div class="button-modal d-flex justify-content-center">
                            <button type="button" class="btn btn-default-2 me-2" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-key-fill"></i>
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- End --}}

@endsection
@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            // Notif untuk data yang berhasil diproses
            @if (session('sukses'))
                let pesan = "{{ session('sukses') }}"
                toastr.success(pesan)
            @endif

            // Notif untuk password yang salah
            @error('password')
                let pesan = "{{ ucwords($message) }}"
                toastr.error(pesan)
            @enderror

            // Konfigurasi gambar dropify
            $('.foto_profil').dropify({
                messages: {
                    default: 'Pilih gambar anda! <br> Format gambar yang diwajibkan <br> adalah .JPG, .JPEG, .PNG!',
                    replace: 'Mau ganti gambar anda?',
                    remove: 'Hapus',
                    error: 'Ada kesalahan pada proses upload gambar!'
                }
            });

            // Lihat dan sembunyikan password
            $('#show-password').click(function() {
                const pass = $('#password_user').attr('type');
                if (pass === "password") {
                    $('#password_user').attr('type', 'text');
                } else {
                    $('#password_user').attr('type', 'password');
                }
            });

        });

        // Modal Ubah Foto Profil
        function ubahFoto() {
            $('#ubahFoto').modal('show');
        }

        // Modal konfirmasi ubah password
        function konfirPass() {
            $('#konfirPass').modal('show');
        }

        // Modal ganti password
        function gantiPass() {
            $('#konfirPass').modal('hide');
            $('#gantiPassword').modal('show');
        }
    </script>
@endpush
