@extends('layout.auth')
@section('title', 'Konfirmasi Pendaftaran')
@section('content')
    <div class="error mx-auto mt-2 card card-login">
        {{-- Ucapan --}}
        <i class="bi bi-patch-check-fill text-center" style="font-size: 70px; color: green;"></i>
        <h3 class="login-title text-center mb-4">Konfirmasi.</h3>
        <p class="text-center text-muted">
            Selamat datamu sudah berhasil disimpan dan silakan ikuti proses dibawah ini!
        </p>
        {{-- End --}}

        <div class="alert alert-primary" role="alert">
            Bagi calon murid baru yang sudah mendaftar harap segera mengumpulkan berkas aslinya di sekolah agar status
            <b>"Terdaftar"</b> berubah menjadi <b>"Diterima"</b>!
        </div>

        {{-- Bukti Pendaftaran --}}
        <div class="d-flex bg-light rounded-3">
            <i class="bi bi-file-earmark-post ms-2" style="font-size: 50px;"></i>
            <div class="align-self-center ms-2">
                <h6>Bukti Pendaftaran</h6>
                <div style="font-size: 12px; margin-top: -10px;">
                    Silakan unduh bukti pendaftaran
                </div>
            </div>
            <a href="{{ route('bukti.pendaftaran', $pendaftarId) }}" target="_blank" onclick="unduhBukti()"
                id="unduh-bukti-pendaftaran" class="btn btn-primary bg-gradient align-self-center ms-auto me-3">
                <i class="bi bi-download"></i>
                Unduh
            </a>
        </div>
        {{-- End --}}

        {{-- Grup Whatsapp --}}
        <div class="d-flex bg-light rounded-3 mt-3 d-none" id="grup-wa">
            <i class="bi bi-whatsapp ms-3" style="font-size: 40px; color: green;"></i>
            <div class="align-self-center ms-2">
                <h6>Grup Whatsapp</h6>
                <div style="font-size: 12px; margin-top: -10px;">
                    Silakan gabung grup Whatsapp SPMB
                </div>
            </div>
            <a href="{{ $link_grup }}" target="_blank" onclick="gabungGrup()" id="gabung-grup-wa"
                class="btn btn-success bg-gradient align-self-center ms-auto me-3">
                Gabung
            </a>
        </div>
        {{-- End --}}

        <a href="{{ route('halaman.daftar') }}" id="tombol-selesai" class="d-none btn btn-success mt-4 fw-bold mb-3 py-2">
            <i class="bi bi-check-lg me-1"></i>
            Selesai
        </a>
    </div>

@endsection
@push('scripts')
    <script type="text/javascript">
        const grupWa = document.getElementById("grup-wa");
        const tmbSelesai = document.getElementById("tombol-selesai");

        function unduhBukti() {
            grupWa.classList.remove('d-none');
        }

        function gabungGrup() {
            tmbSelesai.classList.remove('d-none');
        }
    </script>
@endpush
