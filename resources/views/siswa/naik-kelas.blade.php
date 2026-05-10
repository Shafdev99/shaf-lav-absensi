<!-- Content -->
@extends('layout.app')
@section('title', 'Naik Kelas')
@section('content')

    @php
        $parse = parse_url(url()->full());
        $url = isset($parse['query']) ? $parse['query'] : false;
    @endphp

    <div class="content content-sm">

        <div class="container">

            {{-- Breadcrumb --}}
            <div class="breadcrumb">
                Naik Kelas
            </div>
            {{-- End --}}

            {{-- <h5>Data Siswa</h5> --}}
            <div class="row mt-4">
                <div class="col">
                    <div class="card p-lg-3 p-2 card-content">

                        {{-- Header Button --}}
                        <div class="d-flex mt-2 mb-3 mb-lg-0">
                            <h5 class="align-self-center">
                                Data Siswa
                            </h5>

                            {{-- Search Button --}}
                            <form action="{{ route('siswa.naik') }}" method="get" class="ms-lg-auto me-2 ">
                                <div class="d-none d-lg-flex justify-content-center">
                                    <select class="form-select form-select-sm me-2" style="width: 350px;" name="kelas"
                                        id="pilih-kelas-id">
                                        @forelse ($kelas as $Kelas)
                                            <option value="{{ $Kelas->kelas_id }}"
                                                {{ request('kelas') == $Kelas->kelas_id ? 'selected' : '' }}>
                                                {{ $Kelas->tingkat . ' ' . $Kelas->nama_jurusan . ' ' . $Kelas->nama_kelas }}
                                            </option>
                                        @empty
                                            <option value="">Belum ada kelas!</option>
                                        @endforelse
                                    </select>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm form-default"
                                            placeholder="Cari data.." aria-describedby="button-addon2" name="nama_siswa"
                                            value="{{ request('nama_siswa') }}" style="width: 50px;" id="nama-siswa">
                                        <button type="submit" class="btn btn-default-2" type="button" id="button-addon2">
                                            Cari
                                        </button>
                                    </div>
                                </div>
                            </form>
                            {{-- End --}}

                            {{-- Tombol Naik Kelas --}}
                            {{-- <a href="javascript:void(0);" id="tmb-lulus"
                                class="btn btn-success disabled me-2 ms-auto ms-lg-0 d-none d-lg-block d-md-block  py-1 px-2 pe-1 pe-lg-2">
                                <i class="bi bi-mortarboard-fill me-1" style="font-size: 16px;"></i>
                                <span class="d-none d-lg-inline d-md-inline">
                                    Lulus
                                </span>
                            </a> --}}

                            {{-- Tombol Refresh --}}
                            <a href="{{ route('siswa.naik') }}" class="btn btn-default-2 d-none d-lg-block d-md-block">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-arrow-clockwise " viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2z" />
                                    <path
                                        d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466" />
                                </svg>
                                <span class=" ms-1">
                                    Refresh
                                </span>
                            </a>

                        </div>
                        {{-- End --}}

                        <form action="{{ route('naik.kelas', $url) }}" method="POST">
                            @csrf
                            {{-- Table Siswa Desktop View --}}
                            <table class="table d-none d-lg-table d-md-table desktop-table mt-4">
                                <tr class="tr-table">
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>NIS</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Kelas</th>
                                    <th>Status</th>
                                </tr>
                                @forelse ($siswa as $Siswa)
                                    <tr style="color: rgb(26, 26, 26);">
                                        <td>
                                            {{ $loop->iteration }}).
                                            <input type="hidden" name="siswa_id[]" value="{{ $Siswa->id }}">
                                            <input type="hidden" name="kelas_saat_ini[]" value="{{ $Siswa->kelas_id }}">
                                        </td>
                                        <td class="d-flex">
                                            <img src="{{ $Siswa->foto ? asset('storage/' . $Siswa->foto) : asset('img/logo/profile.jpg') }}"
                                                class="d-none d-lg-block img-fluid rounded-pill img-user align-self-center me-3"
                                                alt="user-photo">
                                            <div class="d-inline">
                                                <div class="fs-nama">{{ $Siswa->nama_lengkap }}</div><br>
                                                {{ $Siswa->nisn }}
                                            </div>
                                        </td>
                                        <td>{{ $Siswa->nis }}</td>
                                        <td class="ps-2">
                                            <div
                                                class="{{ $Siswa->jenis_kelamin == 'Laki-laki' ? 'jenkel-l' : 'jenkel-p' }}">
                                                {{ $Siswa->jenis_kelamin }}
                                            </div>
                                        </td>
                                        <td>
                                            <b>
                                                <i class="bi bi-door-closed-fill"></i>
                                                {{ $Siswa->tingkat . ' ' . $Siswa->nama_jurusan . ' ' . $Siswa->nama_kelas }}
                                            </b>
                                        </td>
                                        <td>
                                            <select name="status_kenaikan_kelas[]" class="form-select">
                                                @php
                                                    $tingkatNaikKelas = null;
                                                    foreach ($pilihKelas as $baris) {
                                                        $tingkatNaikKelas = $baris->tingkat;
                                                    }
                                                @endphp

                                                @if ($tingkatNaikKelas == null)
                                                    @forelse ($alumni as $Alumni)
                                                        @foreach ($lulusSekolah as $LulusSekolah)
                                                            <option value="{{ $LulusSekolah }}"
                                                                {{ $Siswa->tingkat == $Alumni?->tingkat ? 'selected' : '' }}>
                                                                {{ $LulusSekolah }}
                                                            </option>
                                                        @endforeach
                                                    @empty
                                                        @foreach ($lulusSekolah as $LulusSekolah)
                                                            <option value="{{ $LulusSekolah }}">
                                                                {{ $LulusSekolah }}
                                                            </option>
                                                        @endforeach
                                                    @endforelse
                                                @else
                                                    @forelse ($siswaNaik as $SiswaNaik)
                                                        @foreach ($naikKelas as $NaikKelas)
                                                            <option value="{{ $NaikKelas }}"
                                                                {{ $Siswa->tingkat == $SiswaNaik->tingkat ? 'selected' : '' }}>
                                                                {{ $NaikKelas }}
                                                            </option>
                                                        @endforeach
                                                    @empty
                                                        @foreach ($naikKelas as $NaikKelas)
                                                            <option value="{{ $NaikKelas }}">
                                                                {{ $NaikKelas }}
                                                            </option>
                                                        @endforeach
                                                    @endforelse
                                                @endif


                                            </select>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" align="center">Data tidak ada!</td>
                                    </tr>
                                @endforelse
                            </table>
                            {{-- End --}}


                            {{-- Table Siswa Mobile View --}}

                            {{-- End --}}

                            {{-- Pagination --}}
                            {{ $siswa->links() }}
                            {{-- End --}}

                            <div class="input-group ms-auto" style="width: 300px;">
                                {{-- Pilih Naik Kelas --}}
                                <select name="kelas_id" class="form-select" id="pilih-naik-kelas">
                                    @php
                                        $naikKelas = null;
                                    @endphp
                                    @forelse ($pilihKelas as $PilihKelas)
                                        <option value="{{ $PilihKelas->id }}">
                                            {{ $PilihKelas->tingkat . ' ' . $PilihKelas->nama_jurusan . ' ' . $PilihKelas->nama_kelas }}
                                        </option>
                                        @php
                                            $naikKelas = $PilihKelas->tingkat;
                                        @endphp
                                    @empty
                                        <option value="">Lulus Sekolah</option>
                                    @endforelse
                                </select>
                                {{-- Akhir --}}

                                {{-- Tombol Naik Kelas --}}
                                <button type="submit" class="btn btn-primary">
                                    <i class=" bi bi-chevron-double-up me-1"></i>
                                    <span class="">
                                        {{ $naikKelas != null ? 'Naik Kelas' : 'Lulus Sekolah' }}
                                    </span>
                                </button>
                                {{-- Akhir --}}
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>

        <a href="{{ route('siswa.add') }}" class="btn btn-primary add-btn-siswa-mbl d-lg-none d-md-none">
            <i class="bi bi-plus-lg"></i>
        </a>

    </div>

    {{-- Modal Naik Kelas --}}
    {{-- <div class="modal fade" id="naikKelas" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="naikKelasLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom">
                    <h6 class="modal-title fw-bold" id="naikKelasLabel">Naik Kelas</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('naik.kelas') }}" method="post">
                    <div class="modal-body">
                        @csrf

                        <div class="row">
                            <div class="col-4 text-center ">
                                <input type="text" value="{{ $kelasSaatIni ?? false }}" class="form-control" disabled>
                            </div>
                            <div class="col-3 text-center align-self-center">
                                Naik ke
                            </div>
                            <div class="col-5">
                                
                            </div>

                            <input type="hidden" name="siswa_id[]" id="siswa_id">
                            <input type="hidden" name="kelas_id" id="kelas_id" value="{{ $Siswa->id }}">
                        </div>

                    </div>
                    <div class="modal-footer border-top">
                        <button type="button" class="btn btn-default-2 me-2" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-chevron-double-up me-1"></i>
                            {{ $naikKelas ? 'Naik Kelas!' : 'Lulus Sekolah!' }}
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div> --}}
    {{-- End --}}

    {{-- Modal Lulus --}}
    {{-- <div class="modal fade" id="lulus" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="lulusLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom">
                    <h6 class="modal-title fw-bold" id="lulusLabel">Lulus Sekolah</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('lulus') }}" method="post">
                        @csrf
                        <p class="text-center peringatan-modal">Anda yakin ingin meluluskan siswa yang terpilih?</p>
                        <input type="hidden" name="siswa_id[]" id="siswa_lulus_id">
                        <div class="button-modal d-flex justify-content-center">
                            <button type="button" class="btn btn-default-2 me-2" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-mortarboard-fill me-1"></i>
                                Luluskan!
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}
    {{-- End --}}

    {{-- Loading screen --}}
    <div class="loading-screen d-none">
        <span class="loader"></span>
    </div>

@endsection
@push('scripts')
    <script type="text/javascript">
        // Notif untuk data yang berhasil diproses
        @if (session('sukses'))
            let pesan = "{{ session('sukses') }}"
            toastr.success(pesan)
        @endif

        $('#pilih-kelas-id').change(function(e) {
            e.preventDefault();
            const namaSiswa = $('#nama-siswa').val();

            // Diarahkan ke URL di bawah ini
            window.location.href = `naik-kelas?kelas=${this.value}&nama_siswa=${namaSiswa}`;
        });

        // $('#pilih-naik-kelas').change(function() {
        //     const param = this.value;
        //     const pisah = param.split(' ');
        //     $('#tingkat_id').val(pisah[0]);
        //     $('#jurusan_id').val(pisah[1]);
        //     $('#kelas_id').val(pisah[2]);
        // });

        // Ambil data siswa berupa json
        function detailData(id) {
            $('.loading-screen').removeClass('d-none');
            // url
            const url = "{{ url('/getSiswa') }}/";

            // asset
            const asset = "{{ asset('storage') }}/";
            $.getJSON(url + id, function(json) {

                $('.loading-screen').addClass('d-none');
                $('#detailSiswa').modal('show');
                $('#nama').html(json.nama_lengkap);
                $('#tempat_lahir').html(json.tempat_lahir);
                $('#tanggal_lahir').html(tgl_indo(json.tanggal_lahir));
                $('#nik').html(json.nik);
                $('#nisn').html(json.nisn);
                $('#nis').html(json.nis);
                $('#alamat').html(json.alamat);
                $('#agama').html(json.agama);
                $('#jenis_kelamin').html(json.jenis_kelamin);
                $('#nama_ayah').html(json.nama_ayah);
                $('#nama_ibu').html(json.nama_ibu);
                $('#alamat_ortu').html(json.alamat_ortu);
                $('#nama_wali').html(json.nama_wali);
                $('#alamat_wali').html(json.alamat_wali);
                $('#nama_sekolah').html(json.nama_sekolah);
                $('#alamat_sekolah').html(json.alamat_sekolah);
                $('#tahun_lulus').html(json.tahun_lulus);
                $('#nomer_ijazah').html(json.nomer_ijazah);
                $('#tingkat_keterima').html(json.nama_kelas.nama_kelas + ' ' + json.jurusan.nama_jurusan);
                $('#tanggal_keterima').html(tgl_indo(json.tanggal_keterima));
                $('#tahun_ajar').html(json.tahun_ajar);
                if (json.foto) {
                    $('#foto').attr("src", asset + json.foto);
                } else {
                    $('#foto').attr("src", "{{ asset('img/logo/profile.jpg') }}");
                }
            });
        }

        // Checklist atau centang semua siswa
        $("#check-all").click(function() {
            if ($(this).is(":checked")) {
                $(".check-item").prop("checked", true);
                $('#tmb-naik-kelas').removeClass('disabled');
                $('#tmb-lulus').removeClass('disabled');
            } else {
                $(".check-item").prop("checked", false);
                $('#tmb-naik-kelas').addClass('disabled');
                $('#tmb-lulus').addClass('disabled');
            }
        });

        // Checklist atau centang semua siswa mobile version
        $("#check-all-mobile").click(function() {
            if ($(this).is(":checked")) {
                $(".check-item").prop("checked", true);
                $('#tmb-hapus-mobile').removeClass('disabled');
            } else {
                $(".check-item").prop("checked", false);
                $('#tmb-hapus-mobile').addClass('disabled');
            }
        });

        // Checklist atau centang beberapa siswa
        $('.check-item').click(function() {
            if ($(".check-item").is(":checked")) {
                $('#tmb-naik-kelas').removeClass('disabled');
                $('#tmb-lulus').removeClass('disabled');
            } else {
                $('#tmb-naik-kelas').addClass('disabled');
                $('#tmb-lulus').addClass('disabled');
            }
        });

        // Tombol Naik Kelas
        // $('#tmb-naik-kelas').click(function() {

        //     $('#naikKelas').modal('show');

        //     let siswa_id = [];
        //     if ($(".check-item").is(":checked")) {
        //         $("input[name^='id_siswa']:checked").each(function() {
        //             siswa_id.push($(this).val());
        //         });
        //         $('#siswa_id').val(siswa_id);
        //     } else {
        //         $('#siswa_id').val(siswa_id);
        //     }
        // });

        // Tombol Lulus
        // $('#tmb-lulus').click(function() {

        //     $('#lulus').modal('show');

        //     let siswa_id = [];
        //     if ($(".check-item").is(":checked")) {
        //         $("input[name^='id_siswa']:checked").each(function() {
        //             siswa_id.push($(this).val());
        //         });
        //         $('#siswa_lulus_id').val(siswa_id);
        //     } else {
        //         $('#siswa_lulus_id').val(siswa_id);
        //     }
        // });

        // Tombol Naik Kelas Mobile View
        // $('#tmb-hapus-mobile').click(function() {

        //     $('#naikKelas').modal('show');

        //     let siswa_id = [];
        //     if ($(".check-item").is(":checked")) {
        //         $("input[name^='id_siswa']:checked").each(function() {
        //             siswa_id.push($(this).val());
        //         });
        //         $('#siswa_id').val(siswa_id);
        //     } else {
        //         $('#siswa_id').val(siswa_id);
        //     }
        // });
    </script>
@endpush
