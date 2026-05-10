@extends('layout.auth')
@section('title', 'Cek Status')
@section('content')
    <div class="row">
        <div class="col-lg-8 col-md-8 col mx-auto">
            <div class="error p-3 mt-2 card card-content">
                {{-- Back Button --}}
                <div>
                    <a href="{{ route('halaman.daftar') }}" class="btn btn-primary rounded-pill mb-3 px-3 py-2">
                        <i class="bi bi-chevron-left me-1"></i>
                        Kembali
                    </a>
                </div>
                {{-- End --}}

                {{-- Ucapan --}}
                <i class="bi bi-person-bounding-box text-center" style="font-size: 70px; color: green;"></i>
                <h3 class="login-title text-center mb-3">Cek Status.</h3>
                <p class="text-center text-muted">
                    Cek Status pendaftaran kalian!
                </p>
                {{-- End --}}

                {{-- Alert --}}
                <div class="alert alert-primary fw-bold" role="alert">
                    Apakah anda sudah berstatus <b>"Diterima"</b> atau masih
                    <b>"Terdaftar"</b>!
                </div>
                {{-- End --}}

                {{-- Form Check Status --}}
                <div class="mt-4">
                    <h5 class="ms-2">Cek Status Kalian</h5>
                    <form action="{{ route('cek.status') }}" method="POST">
                        @csrf
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Masukan NIK / NISN / Nomor Pendaftaran"
                                name="identitas" value="{{ request('identitas') }}">
                            <button class="btn btn-primary" type="submit" id="button-addon2">
                                <i class="bi bi-person-bounding-box me-1"></i>
                                Cek Status
                            </button>
                        </div>
                    </form>
                </div>
                {{-- End --}}

                @if ($pendaftar)
                    {{-- Data Calon Murid Baru --}}
                    <div class="card card-content spmb-card-cmb">
                        <div class="container-fluid">
                            <div class="row">
                                <h6 class="mt-3">Status :
                                    <div class="badge {{ $pendaftar->status == 'diterima' ? 'badge-globe' : 'badge-blobe' }} py-2 px-3"
                                        style="font-size: 16px !important;">
                                        {{ Str::ucfirst($pendaftar->status) }}
                                    </div>
                                </h6>
                                <div class="col-lg-12 col-12 text-center">
                                    <img width="150" class="mt-5 shadow-sm mb-2 img-thumbnail"
                                        src="{{ asset('storage/' . $pendaftar->foto) }}" alt="">
                                    <p>Foto Calon Murid</p>
                                </div>
                                <div class="col-lg-12 col-12 mt-3 mt-lg-0">

                                    <h6 class="fw-bold mt-3 spmb-judul-data">Data Calon Murid Baru</h6>
                                    <table class="table mt-2 mb-4 spmb-data-cmb" width="100%">
                                        <tr>
                                            <td width="25%">No. Pendaftaran</td>
                                            <td width="5%">:</td>
                                            <td>{{ $pendaftar->no_pendaftaran }}</td>
                                        </tr>
                                        <tr>
                                            <td>Nama Lengkap</td>
                                            <td>:</td>
                                            <td>{{ $pendaftar->nama_lengkap }}</td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td>:</td>
                                            <td>{{ $pendaftar?->email }}</td>
                                        </tr>
                                        <tr>
                                            <td>TTL</td>
                                            <td>:</td>
                                            <td>{{ $pendaftar->tempat_lahir . ', ' . \Carbon\Carbon::parse($pendaftar->tanggal_lahir)->translatedFormat('d F Y') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>NIK</td>
                                            <td>:</td>
                                            <td>{{ $pendaftar->nik }}</td>
                                        </tr>
                                        <tr>
                                            <td>NISN</td>
                                            <td>:</td>
                                            <td>{{ $pendaftar->nisn }}</td>
                                        </tr>
                                        <tr>
                                            <td>Alamat</td>
                                            <td>:</td>
                                            <td>{{ $pendaftar->alamat }}</td>
                                        </tr>
                                        <tr>
                                            <td>Jenis Kelamin</td>
                                            <td>:</td>
                                            <td>{{ $pendaftar->jenis_kelamin }}</td>
                                        </tr>
                                        <tr>
                                            <td>Agama</td>
                                            <td>:</td>
                                            <td>{{ $agama }}</td>
                                        </tr>
                                    </table>

                                    <h6 class="fw-bold mt-3 spmb-judul-data">Data Asal Sekolah</h6>
                                    <table class="table mt-2 mb-4 spmb-data-cmb" width="100%">
                                        <tr>
                                            <td width="25%">Sekolah Asal</td>
                                            <td width="5%">:</td>
                                            <td>{{ $berkas->asal_sekolah }}</td>
                                        </tr>
                                        <tr>
                                            <td>Alamat Sekolah Asal</td>
                                            <td>:</td>
                                            <td>{{ $berkas->alamat_sekolah }}</td>
                                        </tr>
                                    </table>

                                    <h6 class="fw-bold mt-3 spmb-judul-data">Data Berkas Pendaftaran</h6>
                                    <table class="table mt-2 mb-4 spmb-data-cmb" width="100%">
                                        <tr>
                                            <td width="25%">No Ijazah / SKHUN</td>
                                            <td width="5%">:</td>
                                            <td>{{ $berkas->no_ijazah }}</td>
                                        </tr>
                                        <tr>
                                            <td>Rata-rata Nilai</td>
                                            <td>:</td>
                                            <td>{{ $berkas->rata_nilai }}</td>
                                        </tr>
                                        <tr>
                                            <td>Jurusan Yang Dipilih</td>
                                            <td>:</td>
                                            <td>{{ $jurusan }}</td>
                                        </tr>
                                        <tr>
                                            <td>File Ijazah</td>
                                            <td>:</td>
                                            <td>
                                                @if ($berkas->ijazah)
                                                    Ada
                                                    <a class="btn btn-primary py-1 px-2 ms-3" style="font-size: 10px;"
                                                        onclick="tampilBerkas('{{ $berkas->ijazah }}')">
                                                        Lihat
                                                    </a>
                                                @else
                                                    Tidak ada
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>File Kartu Keluarga</td>
                                            <td>:</td>
                                            <td>
                                                @if ($berkas->kartu_keluarga)
                                                    Ada
                                                    <a class="btn btn-primary py-1 px-2 ms-3" style="font-size: 10px;"
                                                        onclick="tampilBerkas('{{ $berkas->kartu_keluarga }}')">
                                                        Lihat
                                                    </a>
                                                @else
                                                    Tidak Ada
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>File Akta Kelahiran</td>
                                            <td>:</td>
                                            <td>
                                                @if ($berkas->akta_kelahiran)
                                                    Ada
                                                    <a class="btn btn-primary py-1 px-2 ms-3" style="font-size: 10px;"
                                                        onclick="tampilBerkas('{{ $berkas->akta_kelahiran }}')">
                                                        Lihat
                                                    </a>
                                                @else
                                                    Tidak ada
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>File Piagam Prestasi</td>
                                            <td>:</td>
                                            <td>
                                                @if ($berkas->piagam_prestasi)
                                                    Ada
                                                    <a class="btn btn-primary py-1 px-2 ms-3" style="font-size: 10px;"
                                                        onclick="tampilBerkas('{{ $berkas->piagam_prestasi }}')">
                                                        Lihat
                                                    </a>
                                                @else
                                                    Tidak ada
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>File Kartu Penerima Bantuan</td>
                                            <td>:</td>
                                            <td>
                                                @if ($berkas->kartu_bantuan)
                                                    Ada
                                                    <a class="btn btn-primary py-1 px-2 ms-3" style="font-size: 10px;"
                                                        onclick="tampilBerkas('{{ $berkas->kartu_bantuan }}')">
                                                        Lihat
                                                    </a>
                                                @else
                                                    Tidak ada
                                                @endif
                                            </td>
                                        </tr>
                                    </table>

                                    <h6 class="fw-bold mt-3 spmb-judul-data">Data Orang Tua</h6>
                                    <table class="table mt-2 mb-4 spmb-data-cmb" width="100%">
                                        <tr>
                                            <td width="25%">Nama Ayah</td>
                                            <td width="5%">:</td>
                                            <td>{{ $ayah->nama_ayah }}</td>
                                        </tr>
                                        <tr>
                                            <td>Pekerjan Ayah</td>
                                            <td>:</td>
                                            <td>{{ $ayah->pekerjaan_ayah }}</td>
                                        </tr>
                                        <tr>
                                            <td>Nama Ibu</td>
                                            <td>:</td>
                                            <td>{{ $ibu->nama_ibu }}</td>
                                        </tr>
                                        <tr>
                                            <td>Pekerjaan Ibu</td>
                                            <td>:</td>
                                            <td>
                                                {{ $ibu->pekerjaan_ibu }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Alamat Orang Tua</td>
                                            <td>:</td>
                                            <td>
                                                {{ $ayah->alamat_ayah }}
                                            </td>
                                        </tr>
                                    </table>

                                    <h6 class="fw-bold mt-3 spmb-judul-data">Data Wali</h6>
                                    <table class="table mt-2 mb-4 spmb-data-cmb" width="100%">
                                        <tr>
                                            <td width="25%">Nama Wali</td>
                                            <td width="5%">:</td>
                                            <td>{{ $wali?->nama_walmur ? $wali?->nama_walmur : '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td>Pekerjan Wali</td>
                                            <td>:</td>
                                            <td>{{ $wali?->pekerjaan_walmur ? $wali?->pekerjaan_walmur : '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td>Alamat Wali</td>
                                            <td>:</td>
                                            <td>
                                                {{ $wali?->alamat_walmur ? $wali?->alamat_walmur : '-' }}
                                            </td>
                                        </tr>
                                    </table>

                                    <div class="text-left">
                                        <a href="{{ route('bukti.pendaftaran', $pendaftar->id) }}" target="_blank"
                                            class="btn btn-primary bg-gradient float-lg-end mb-4">
                                            <i class="bi bi-download me-1"></i>
                                            Unduh Bukti Pendaftaran
                                        </a>
                                        <a href="{{ $link_grup }}" target="_blank"
                                            class="btn btn-success bg-gradient float-lg-end mb-4 me-2">
                                            <i class="bi bi-whatsapp me-1"></i>
                                            Gabung Grup Whatsapp
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                @if (empty($pendaftar) && request('identitas'))
                    {{-- Alert --}}
                    <div class="alert alert-warning text-center fw-bold" role="alert">
                        <h6>Data yang anda masukan kurang tepat atau anda belum mendaftar!</h6>
                    </div>
                    {{-- End --}}
                @endif


            </div>
        </div>
    </div>

    <!-- Modal View File -->
    <div class="modal fade" id="tampilBerkas" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="tampilBerkasLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="tampilBerkasLabel">Lihat Berkas</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="tampil-berkas">
                    {{-- Berkas akan ditampilkan disini! --}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Keluar</button>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
    <script type="text/javascript">
        function tampilBerkas(berkas) {
            const url = `{{ asset('storage') }}/` + berkas;
            const html = `<img class="img-fluid img-thumbnail" src="` + url + `">`;
            $('#tampilBerkas').modal('show');
            $('#tampil-berkas').html(html);
        }
    </script>
@endpush
