<!-- Content -->
@extends('layout.app')
@section('title', 'Rekap Nilai Rapor Siswa')
@section('content')

    @php
        $parse = parse_url(url()->full());
        $url = isset($parse['query']) ? $parse['query'] : false;
        $menu = request()->segment(1);
    @endphp

    <div class="content content-sm">

        <div class="container">

            {{-- Breadcrumb --}}
            <div class="breadcrumb">
                Kelengkapan Data
            </div>
            {{-- End --}}

            {{-- <h5>Data Siswa</h5> --}}
            <div class="row mt-4">
                <div class="col-lg-12 mx-auto">
                    <div class="card p-lg-3 py-3 px-0 card-content">
                        {{-- Header Button --}}
                        <div class="d-flex mt-2 mb-3 px-2 justify-content-between">

                            <a href="{{ $menu == 'alumni' ? route('alumni', $url) : route('rekap', $url) }}"
                                class="btn btn-primary ms-2">
                                <i class="bi bi-arrow-left"></i>
                                Kembali
                            </a>

                            <span class="me-3 align-self-center">
                                Nilai siswa
                            </span>

                        </div>

                        <div class="mt-2 mb-3">
                            @include('binduk.rekap.navtabs')
                        </div>
                        {{-- End --}}

                        {{-- Table Nilai Siswa Desktop View --}}
                        <form action="{{ route('rekap.form.nilai.update', $siswa->id) }}" method="post">
                            @csrf
                            @method('put')

                            <input type="hidden" value="{{ $menu }}" name="menu">
                            <input type="hidden" value="{{ request()->input('kelas') }}" name="kelas">
                            <input type="hidden" value="{{ request()->input('nama_siswa') }}" name="nama_siswa">
                            <input type="hidden" value="{{ $siswa->id }}" name="siswa_id">

                            <table class="table d-none d-lg-table d-md-table desktop-table mt-4 table-bordered">
                                <tr class="">
                                    <th rowspan="3" valign="middle" style="text-align: center;">No Urut</th>
                                    <th rowspan="3" valign="middle" style="text-align: center;">Nama Mapel</th>

                                    {{-- Kolom Kelas --}}
                                    @foreach ($tingkat as $tkt)
                                        <th colspan="4" style="text-align: center">Kelas {{ $tkt->tingkat }}</th>
                                    @endforeach
                                    {{-- End --}}
                                </tr>

                                <tr>
                                    {{-- Kolom Semester --}}
                                    @foreach ($semester as $smt)
                                        <td align="center" colspan="2">
                                            {{ $smt->semester % 2 == 0 ? 'Semester 2' : 'Semester 1' }}
                                            {{-- {{ $smt->semester }} --}}
                                        </td>
                                    @endforeach
                                    {{-- End --}}
                                </tr>

                                <tr>
                                    {{-- Kolom KKM --}}
                                    @for ($i = 0; $i < $semester->count(); $i++)
                                        <td align="center">KKM</td>
                                        <td align="center">Nilai</td>
                                    @endfor
                                    {{-- End --}}
                                </tr>
                                {{-- Baris Kelompok Mapel --}}
                                @foreach ($kelma as $row)
                                    <tr>
                                        <td style="background-color:  #1d221e0c" colspan="{{ $semester->count() * 3 }}">
                                            {{ $row->kelompok_mapel }}
                                        </td>
                                    </tr>

                                    {{-- Baris Mapel --}}
                                    @foreach ($kurMapel as $item)
                                        @if ($row->id == $item->kelompok_mapel_id)
                                            <tr>
                                                <td align="center">
                                                    {{ $item->urutan_mapel }}).
                                                </td>
                                                <td>
                                                    {{ $item->mapel }}
                                                </td>

                                                {{-- Kolom Kelola Nilai --}}
                                                @foreach ($semester as $smt)
                                                    <td align="center">{{ $item->kkm }}</td>
                                                    <td align="center">
                                                        @php
                                                            $nilai_rapor = null;
                                                            $nilai_id = null;
                                                        @endphp

                                                        @foreach ($smt->nilai as $point)
                                                            @if ($point->mapel_id === $item->mapel_id)
                                                                @php
                                                                    $nilai_rapor += $point->nilai;
                                                                    $nilai_id = $point->id;
                                                                @endphp
                                                            @endif
                                                        @endforeach

                                                        {{-- Nilai Rapor --}}
                                                        <input type="text" style="width: 40px;"
                                                            value="{{ $nilai_rapor }}" name="nilai[]">
                                                        {{-- End --}}

                                                        {{-- Table ID --}}
                                                        <input type="hidden" style="width: 40px;"
                                                            value="{{ $nilai_id }}" name="nilai_id[]">
                                                        <input type="hidden" style="width: 40px;"
                                                            value="{{ $smt->id }}" name="semester_id[]">
                                                        <input type="hidden" style="width: 40px;"
                                                            value="{{ $item->mapel_id }}" name="mapel_id[]">
                                                        {{-- End --}}

                                                    </td>
                                                @endforeach
                                                {{-- End --}}

                                            </tr>
                                        @endif
                                    @endforeach
                                    {{-- End --}}
                                @endforeach
                                {{-- End --}}
                            </table>
                            <button type="submit" class="btn btn-primary float-end">
                                <i class="bi bi-send-fill me-1"></i>
                                Simpan
                            </button>
                        </form>
                        {{-- End --}}

                    </div>
                </div>

            </div>
        </div>


    @endsection
    @push('scripts')
        <script type="text/javascript">
            // Konfigurasi Dropify preview Image
            $('.dropify').dropify({
                messages: {
                    default: 'Pilih gambar anda! <br> Format gambar yang diwajibkan <br> adalah .JPG, .JPEG, .PNG!',
                    replace: 'Mau ganti gambar anda?',
                    remove: 'Hapus',
                    error: 'Ada kesalahan pada proses upload gambar!'
                }
            });

            // Notif untuk data yang berhasil diproses
            @if (session('sukses'))
                let pesan = "{{ session('sukses') }}"
                toastr.success(pesan)
            @endif
        </script>
    @endpush
