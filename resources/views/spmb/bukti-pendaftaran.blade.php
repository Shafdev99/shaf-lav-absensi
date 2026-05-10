<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bukti Pendaftaran - {{ $pendaftar->nama_lengkap }} ( {{ $pendaftar->nisn }} )</title>
    <style>
        @media print {
            * {
                font-family: 'Courier New', Courier, monospace;
                margin: 0 !important;
                padding: 0 !important;
                box-sizing: border-box;
            }

            .judul {
                font-size: 12px;
                text-align: center;
            }

            .sub-judul td {
                background-color: rgba(97, 160, 255, 0.268);
                padding: 10px;
                color: rgb(6, 58, 135);
            }

            table.form {
                width: 100%;
                font-size: 10px !important;
                border-spacing: 8px;
            }

            .img {
                margin-left: 100px !important;
            }

        }
    </style>
</head>

<body>
    {{-- KOP SPMB --}}
    <table style="width: 100%;">
        <tr>
            <td width="10%" style="text-align: center;">
                <div class="img">
                    <img src="{{ asset('storage/' . $logo) }}" width="35">
                </div>
            </td>
            <td style="font-size: 14px;">
                SISTEM PENERIMAAN MURID BARU
                <br>
                {{ $sekolah->nama_sekolah }}
            </td>
            <td style="text-align: right;">
                <h3 class="judul">BUKTI PENDAFTARAN <br> SPMB 2026/2027 </h3>
            </td>
        </tr>
    </table>
    <hr>
    <br>
    <table style="width: 100%;">
        <tr>
            <td>
                No. Pendaftaran :
                <b style="font-size: 18px;">
                    {{ $pendaftar->no_pendaftaran }}
                </b>
            </td>
            <td></td>
            <td style="text-align: right;">
                Status :
                <span style="background-color: rgb(149, 200, 255); font-size: 14px;">
                    <b> TERDAFTAR </b>
                </span>
            </td>
        </tr>
    </table>

    <br>

    {{-- FOTO PENDAFTAR --}}
    <table style="width: 100%" border="0">
        <tr>
            <td align="center">
                <img width="60" src="{{ asset('storage/' . $pendaftar->foto) }}" alt="">
                <br>
                <span style="font-size: 12px;">
                    Foto Calon Murid Baru
                </span>
            </td>
        </tr>
    </table>
    {{-- AKHIR --}}

    {{-- <br> --}}

    {{-- ### DATA SPMB ### --}}

    {{-- BIODATA CALON MURID BARU --}}
    <table class="form">
        <tr class="sub-judul">
            <td colspan="5">
                <h4>A. BIODATA CALON MURID BARU</h4>
            </td>
        </tr>
        <tr>
            <td style="width:4%;"></td>
            <td style="width:5%;">1. </td>
            <td style="width:30%;">Nama Lengkap</td>
            <td style="width:3%;">:</td>
            <td>
                <h4>
                    {{ $pendaftar->nama_lengkap }}
                </h4>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>2. </td>
            <td>Email</td>
            <td>:</td>
            <td>
                <h4>
                    {{ $pendaftar?->email }}
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
                    {{ $pendaftar->jenis_kelamin }}
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
                    {{ $pendaftar->tempat_lahir . ', ' . \Carbon\Carbon::parse($pendaftar->tanggal_lahir)->translatedFormat('d F Y') }}
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
                    {{ $pendaftar->religion->agama }}
                </h4>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>5. </td>
            <td>Nomor Induk Kependudukan</td>
            <td>:</td>
            <td>
                <h4>
                    {{ $pendaftar->nik }}
                </h4>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>7.</td>
            <td>Nomor Induk Siswa Nasional</td>
            <td>:</td>
            <td>
                {{ $pendaftar->nisn }}
            </td>
        </tr>
        <tr>
            <td></td>
            <td>8.</td>
            <td>Asal Sekolah</td>
            <td>:</td>
            <td>{{ Str::upper($berkas->asal_sekolah) }}</td>
        </tr>
        <tr>
            <td></td>
            <td>9.</td>
            <td>Alamat Sekolah</td>
            <td>:</td>
            <td>{{ Str::upper($berkas->alamat_sekolah) }}</td>
        </tr>
    </table>
    {{-- AKHIR --}}

    {{-- BERKAS PENDAFTARAN --}}
    <table class="form">
        <tr class="sub-judul">
            <td colspan="5">
                <h4>B. BERKAS PENDAFTARAN</h4>
            </td>
        </tr>
        <tr>
            <td style="width:4%;"></td>
            <td style="width:5%;">1. </td>
            <td style="width:30%;">Jurusan yang dipilih</td>
            <td style="width:3%;">:</td>
            <td>
                <h4>
                    {{ $jurusan->jurusan->nama_jurusan }}
                </h4>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>2. </td>
            <td>No Ijazah / STTB / Tahun</td>
            <td>:</td>
            <td>
                <h4>
                    {{ $berkas->no_ijazah }}
                </h4>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>3. </td>
            <td>Rata-rata Nilai Ijazah</td>
            <td>:</td>
            <td>
                <h4>
                    {{ $berkas->rata_nilai }}
                </h4>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>4. </td>
            <td>Ijazah / Surat Keterangan Lulus</td>
            <td>:</td>
            <td>
                <h4>
                    {{ $berkas->ijazah ? 'Ada' : 'Tidak ada' }}
                </h4>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>5. </td>
            <td>Akta Kelahiran</td>
            <td>:</td>
            <td>
                <h4>
                    {{ $berkas->akta_kelahiran ? 'Ada' : 'Tidak ada' }}
                </h4>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>6. </td>
            <td>Kartu Keluarga</td>
            <td>:</td>
            <td>
                <h4>
                    {{ $berkas->kartu_keluarga ? 'Ada' : 'Tidak ada' }}
                </h4>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>7. </td>
            <td>Kartu Indonesia Pintar / Sejenisnya</td>
            <td>:</td>
            <td>
                <h4>
                    {{ $berkas->kartu_bantuan ? 'Ada' : 'Tidak ada' }}
                </h4>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>8.</td>
            <td>Piagam atau Sertifikat Kejuaraan</td>
            <td>:</td>
            <td>
                <h4>
                    {{ $berkas->piagam_prestasi ? 'Ada' : 'Tidak ada' }}
                </h4>
            </td>
        </tr>

    </table>
    {{-- AKHIR --}}

    {{-- INFORMASI --}}
    <table class="form">
        <tr class="sub-judul">
            <td colspan="5">
                <h4>C. INFORMASI</h4>
            </td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>1).</td>
            <td>
                Bagi calon murid baru yang sudah mendaftar diharapkan mengumpulkan semua berkas yang sudah
                terupload ke ruang sekretariat {{ $sekolah->nama_sekolah }}
            </td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>2).</td>
            <td>
                Silakan masuk grup whatsapp yang sudah tertera untuk mendapatkan informasi lebih lanjut!
            </td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>3).</td>
            <td>
                Jika ingin mengetahui status pendaftaran atau belum masuk grup, bisa langsung masuk ke menu cek status!
            </td>
        </tr>
    </table>
    {{-- AKHIR --}}

    <h6>
        Informasi lebih lanjut bisa scan QR code dibawah ini!
    </h6>
    <div class="img">
        {!! str_replace('<?xml version="1.0" encoding="UTF-8"?>', '', $QRCode) !!}
    </div>

    {{-- ### AKHIR ### --}}

</body>

</html>
