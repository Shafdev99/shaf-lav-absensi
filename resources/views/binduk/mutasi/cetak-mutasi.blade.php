<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mutasi Siswa - {{ $siswa->nama_lengkap }} ( {{ $siswa->nisn }} ) </title>
    <style>
        @media print {
            * {
                font-family: 'Courier New', Courier, monospace;
                margin: 0 !important;
                padding: 0 !important;
                box-sizing: border-box;
            }

            .judul {
                font-size: 14px;
                text-align: center;
            }

            table.form {
                width: 100%;
                font-size: 14px !important;
                border-spacing: 8px;
            }

            .container-binduk {
                width: 100%;
            }

            table.identitas {
                font-size: 14px !important;
                border-spacing: 6px;
            }

            table.riwayat-pendidikan {
                font-size: 12px !important;
                border-spacing: 0px !important;
                width: 100%;
            }

            table.minat {
                font-size: 12px !important;
                border-spacing: 0px !important;
                width: 100%;
            }

            .img {
                text-align: center !important;
            }
        }
    </style>
</head>

<body>
    {{-- KOP DAN JUDUL MUTASI SISWA --}}
    <div class="img">
        <img src="{{ asset('storage/' . $sekolah->kop_binduk) }}" width="700">
    </div>
    <h3 class="judul">LEMBAR MUTASI SISWA</h3>

    <br>

    {{-- IDENTITAS SISWA --}}
    <table class="identitas" border="0">
        <tr>
            <td style="width: 50%;">Nama Siswa</td>
            <td style="width: 3%;">:</td>
            <td>
                {{ $siswa->nama_lengkap }}
            </td>
        </tr>
        <tr>
            <td>Nomor Induk Siswa</td>
            <td>:</td>
            <td>
                {{ $siswa->nis }}
            </td>
        </tr>
        <tr>
            <td>Nomor Induk Siswa Nasional</td>
            <td>:</td>
            <td>
                {{ $siswa->nisn }}
            </td>
        </tr>
        <tr>
            <td>Sekolah</td>
            <td>:</td>
            <td>{{ Str::upper($sekolah->nama_sekolah) }}</td>
        </tr>
    </table>
    {{-- AKHIR --}}

    <br>
    <br>

    {{-- FOTO SISWA --}}
    <table style="width: 100%" border="0">
        <tr>
            <td align="center">
                <img width="150" src="{{ asset('img/logo/profile.jpg') }}" alt="">
                <br>
                <span style="font-size: 12px;">
                    Foto awal masuk
                </span>
            </td>
            <td align="center">
                <img width="150" src="{{ asset('img/logo/profile.jpg') }}" alt="">
                <br>
                <span style="font-size: 12px;">
                    Foto saat lulus
                </span>
            </td>
        </tr>
    </table>
    {{-- AKHIR --}}

    <br>
    <br>
    <br>

    {{-- DATA MUTASI SISWA --}}
    <table class="form">

        {{-- KETERANGAN DIRI SISWA --}}
        <tr>
            <td colspan="5">
                <h4 class="sub-judul">A. KETERANGAN TENTANG DIRI SISWA</h4>
            </td>
        </tr>
        <tr>
            <td style="width:4%;"></td>
            <td style="width:5%;">1. </td>
            <td style="width:30%;">Nama Lengkap</td>
            <td style="width:3%;">:</td>
            <td>
                <h4>
                    {{ $siswa->nama_lengkap }}
                </h4>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>2. </td>
            <td>Jenis Kelamin</td>
            <td>:</td>
            <td>
                <h4>
                    {{ $siswa->jenis_kelamin }}
                </h4>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>3. </td>
            <td>Tempat/Tanggal Lahir</td>
            <td>:</td>
            <td>
                <h4>
                    {{ $siswa->tempat_lahir . ', ' . \Carbon\Carbon::parse($siswa->tanggal_lahir)->translatedFormat('d F Y') }}
                </h4>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>4. </td>
            <td>Agama</td>
            <td>:</td>
            <td>
                <h4>
                    {{ $siswa->religion->agama }}
                </h4>
            </td>
        </tr>
        <tr>
            <td colspan="5"></td>
        </tr>
        {{-- AKHIR --}}

        {{-- KETERANGAN PENDIDIKAN --}}
        <tr>
            <td colspan="5">
                <h4 class="sub-judul">B. KETERANGAN PENDIDIKAN</h4>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>5. </td>
            <td>Pendidikan Sebelumnya</td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>a. &nbsp; Jenjang Pendidikan</td>
            <td>:</td>
            <td>
                <h4>
                    {{ $ripen->pendidikan->pendidikan }}
                </h4>
            </td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>b. &nbsp; Nama Sekolah</td>
            <td>:</td>
            <td>
                <h4>
                    {{ $ripen->nama_sekolah }}
                </h4>
            </td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>c. &nbsp; Alamat Sekolah</td>
            <td>:</td>
            <td>
                <h4>
                    {{ $ripen->alamat_sekolah }}
                </h4>
            </td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>d. &nbsp; Tahun Lulus</td>
            <td>:</td>
            <td>
                <h4>
                    {{ $ripen->tahun_lulus }}
                </h4>
            </td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>e. &nbsp; No Ijazah</td>
            <td>:</td>
            <td>
                <h4>
                    {{ $ripen->no_ijazah }}
                </h4>
            </td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>f. &nbsp; Tanggal Ijazah</td>
            <td>:</td>
            <td>
                <h4>
                    {{ \Carbon\Carbon::parse($ripen->tanggal_ijazah)->translatedFormat('d F Y') }}
                </h4>
            </td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>g. &nbsp; Lamanya Belajar</td>
            <td>:</td>
            <td>
                <h4>
                    {{ $ripen->lama_belajar }} tahun
                </h4>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>6. </td>
            <td>Diterima Di Sekolah ini</td>
            <td></td>
            <td>
            </td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>a. &nbsp; Di Kelas</td>
            <td>:</td>
            <td>
                <h4>
                    {{ $siswa->tingkat . ' ' . $siswa->nama_jurusan . ' ' . $siswa->nama_kelas }}
                </h4>
            </td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>b. &nbsp; Jurusan</td>
            <td>:</td>
            <td>
                <h4>
                    {{ $siswa->nama_jurusan }}
                </h4>
            </td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>c. &nbsp; Tanggal</td>
            <td>:</td>
            <td>
                <h4>
                    {{ \Carbon\Carbon::parse($siswa->tanggal_keterima)->translatedFormat('d F Y') }}
                </h4>
            </td>
        </tr>
        <tr>
            <td colspan="5"></td>
        </tr>
        {{-- AKHIR --}}

        {{-- KETERANGAN ORANG TUA --}}
        <tr>
            <td colspan="5">
                <h4 class="sub-judul">E. KETERANGAN ORANG TUA</h4>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>7. </td>
            <td>Nama Ayah</td>
            <td>:</td>
            <td>
                <h4>
                    {{ Str::ucfirst($ayah->nama_ayah) }}
                </h4>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>8. </td>
            <td>Nama Ibu </td>
            <td>:</td>
            <td>
                <h4>
                    {{ Str::ucfirst($ibu->nama_ibu) }}
                </h4>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>9. </td>
            <td>Alamat Orang Tua</td>
            <td>:</td>
            <td>
                <h4>
                    {{ Str::ucfirst($ayah->alamat_ayah) }}
                </h4>
            </td>
        </tr>
        <tr>
            <td colspan="5"></td>
        </tr>
        {{-- AKHIR --}}

        {{-- KETERANGAN WALI MURID --}}
        <tr>
            <td colspan="5">
                <h4 class="sub-judul">G. KETERANGAN WALI MURID</h4>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>10. </td>
            <td>Nama Lengkap</td>
            <td>:</td>
            <td>
                <h4>
                    {{ $walmur->nama_walmur ? Str::ucfirst($walmur->nama_walmur) : '............................................................................' }}
                </h4>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>11. </td>
            <td>Alamat Wali</td>
            <td>:</td>
            <td>
                <h4>
                    {{ $walmur->alamat_walmur ? Str::ucfirst($walmur->alamat_walmur) : '............................................................................' }}
                </h4>
            </td>
        </tr>
        <tr>
            <td colspan="5"></td>
        </tr>
        {{-- AKHIR --}}

        {{-- MUTASI SISWA --}}
        <tr>
            <td colspan="5">
                <h4 class="sub-judul">H. MUTASI SISWA</h4>
            </td>
        </tr>
        </tr>
        <tr>
            <td></td>
            <td>12. </td>
            <td>Nama Sekolah Yang Di Tuju</td>
            <td>:</td>
            <td>
                <h4>
                    {{ Str::ucfirst($mutasi->nama_sekolah) }}
                </h4>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>13. </td>
            <td>Tingkat Yang Di Tuju</td>
            <td>:</td>
            <td>
                <h4>
                    {{ Str::ucfirst($mutasi->tingkat->tingkat) }}
                </h4>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>14. </td>
            <td>Tahun Ajar</td>
            <td>:</td>
            <td>
                <h4>
                    {{ Str::ucfirst($mutasi->tahunAjar->tahun_ajar) }}
                </h4>
            </td>
        </tr>
        <tr>
            <td colspan="5"></td>
        </tr>
        {{-- AKHIR --}}

    </table>
    {{-- AKHIR --}}

    <br>
    <br>
    <br>
    <br>


    {{-- TANDA TANGAN ORANG TUA / WALI MURID DAN MURID --}}
    <table border="0" style="width: 100%; font-size: 12px; text-align:center;">
        <tr>
            <td width="33%">Orang Tua/Wali</td>
            <td></td>
            <td width="33%">
                Blora, {{ \Carbon\Carbon::parse(now())->translatedFormat('d F Y') }} <br>
                Siswa yang bersangkutan
            </td>
        </tr>
        <tr>
            <td style="height: 80px;"></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>.....................................</td>
            <td></td>
            <td>{{ $siswa->nama_lengkap }}</td>
        </tr>
    </table>
    {{-- AKHIR --}}

    <br>
    <br>

    {{-- TANDA TANGAN KEPALA SEKOLAH --}}
    <table border="0" style="width: 100%; font-size: 12px; text-align:center;">
        <tr>
            <td width="33%"></td>
            <td>
                Mengetahui, <br>
                Kepala {{ $sekolah->nama_sekolah }}
            </td>
            <td width="33%"></td>
        </tr>
        <tr>
            <td style="height: 80px;"></td>
            <td>{{ $sekolah->ttd_kepsek ? asset('storage/' . $sekolah->ttd_kepsek) : '' }}</td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <b>
                    {{ $sekolah->nama_kepsek }} <br>
                </b>
                NIP.
                {{ $sekolah->nip ? $sekolah->nip : '............................................................................' }}
            </td>
            <td></td>
        </tr>
    </table>
    {{-- AKHIR --}}
</body>

</html>
