<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Buku Induk - {{ $siswa?->nama_lengkap }} ( {{ $siswa?->nisn }} ) </title>
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
    {{-- KOP DAN JUDUL BUKU INDUK SISWA --}}
    <div class="img">
        <img src="{{ asset('storage/' . $sekolah?->kop_binduk) }}" width="700">
    </div>
    <h3 class="judul">LEMBAR BUKU INDUK SISWA</h3>

    <br>

    {{-- IDENTITAS SISWA --}}
    <table class="identitas" border="0">
        <tr>
            <td style="width: 50%;">Nama Siswa</td>
            <td style="width: 3%;">:</td>
            <td>
                {{ $siswa?->nama_lengkap }}
            </td>
        </tr>
        <tr>
            <td>Nomor Induk Siswa</td>
            <td>:</td>
            <td>
                {{ $siswa?->nis }}
            </td>
        </tr>
        <tr>
            <td>Nomor Induk Siswa Nasional</td>
            <td>:</td>
            <td>
                {{ $siswa?->nisn }}
            </td>
        </tr>
        <tr>
            <td>Sekolah</td>
            <td>:</td>
            <td>{{ Str::upper($sekolah?->nama_sekolah) }}</td>
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

    {{-- DATA BUKU INDUK SISWA --}}
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
                    {{ $siswa?->nama_lengkap }}
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
                    {{ $siswa?->jenis_kelamin }}
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
                    {{ $siswa?->tempat_lahir . ', ' . \Carbon\Carbon::parse($siswa?->tanggal_lahir)->translatedFormat('d F Y') }}
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
                    {{ $siswa?->religion->agama }}
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
                    {{ $siswa?->nik }}
                </h4>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>6. </td>
            <td>Kewarganegaraan</td>
            <td>:</td>
            <td>
                <h4>
                    {{ $biodata?->kewarganegaraan }}
                </h4>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>7. </td>
            <td>Anak Ke-</td>
            <td>:</td>
            <td>
                <h4>
                    {{ $biodata?->anak_ke . ' ( ' . Str::ucfirst(Number::spell($biodata?->anak_ke ? 1 : 0, locale: 'id')) . ' )' }}
                </h4>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>8. </td>
            <td>Jumlah Saudara Kandung</td>
            <td>:</td>
            <td>
                <h4>
                    {{ $biodata?->saudara_kandung ? $biodata?->saudara_kandung : '............................................................................' }}
                </h4>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>9. </td>
            <td>Jumlah Saudara Tiri</td>
            <td>:</td>
            <td>
                <h4>
                    {{ $biodata?->saudara_tiri ? $biodata?->saudara_tiri : '............................................................................' }}
                </h4>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>10. </td>
            <td>Jumlah Saudara Angkat</td>
            <td>:</td>
            <td>
                <h4>
                    {{ $biodata?->saudara_angkat ? $biodata?->saudara_angkat : '............................................................................' }}
                </h4>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>11. </td>
            <td>Anak Yatim/Piatu/Yatim Piatu</td>
            <td>:</td>
            <td>
                <h4>
                    {{ $biodata?->kelengkapan_ortu }}
                </h4>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>12. </td>
            <td>Bahasa Sehari-hari Di Rumah</td>
            <td>:</td>
            <td>
                <h4>
                    {{ $biodata?->bahasa_harian }}
                </h4>
            </td>
        </tr>
        <tr>
            <td colspan="5"></td>
        </tr>
        {{-- AKHIR --}}

        {{-- KETERANGAN TEMPAT TINGGAL --}}
        <tr>
            <td colspan="5">
                <h4 class="sub-judul">B. KETERANGAN TEMPAT TINGGAL</h4>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>13. </td>
            <td>Alamat</td>
            <td>:</td>
            <td>
                <h4>
                    {{ $siswa?->alamat }}
                </h4>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>14. </td>
            <td>Nomor Telp./Hp.</td>
            <td>:</td>
            <td>
                <h4>
                    {{ $biodata?->telepon }}
                </h4>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>15. </td>
            <td>Tinggal dengan Orang Tua/Saudara/di Asrama/Kost</td>
            <td>:</td>
            <td>
                <h4>
                    {{ $biodata?->tinggal_dengan }}
                </h4>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>16. </td>
            <td>Jarak Tempat Tinggal Ke Sekolah</td>
            <td>:</td>
            <td>
                <h4>
                    {{ $biodata?->jarak_sekolah }}
                </h4>
            </td>
        </tr>
        <tr>
            <td colspan="5"></td>
        </tr>
        {{-- AKHIR --}}

        {{-- KETERANGAN KESEHATAN --}}
        <tr>
            <td colspan="5">
                <h4 class="sub-judul">C. KETERANGAN KESEHATAN</h4>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>17. </td>
            <td>Golongan Darah</td>
            <td>:</td>
            <td>
                <h4>
                    {{ $kesehatan?->golongan_darah }}
                </h4>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>18. </td>
            <td>Riwayat Penyakit</td>
            <td>:</td>
            <td>
                <h4>
                    {{ $kesehatan?->riwayat_penyakit ? $kesehatan?->riwayat_penyakit : '............................................................................' }}
                </h4>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>19. </td>
            <td>Kelainan Jasmani</td>
            <td>:</td>
            <td>
                <h4>
                    {{ $kesehatan?->kelainan_jasmani ? $kesehatan?->kelainan_jasmani : '............................................................................' }}
                </h4>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>20. </td>
            <td>Tinggi Badan</td>
            <td>:</td>
            <td>
                <h4>
                    {{ $kesehatan?->tinggi_badan }} Cm
                </h4>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>21. </td>
            <td>Berat Badan</td>
            <td>:</td>
            <td>
                <h4>
                    {{ $kesehatan?->berat_badan }} Kg
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
                <h4 class="sub-judul">D. KETERANGAN PENDIDIKAN</h4>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>22. </td>
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
                    {{ $ripen?->pendidikan?->pendidikan }}
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
                    {{ $ripen?->nama_sekolah }}
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
                    {{ $ripen?->alamat_sekolah }}
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
                    {{ $ripen?->tahun_lulus }}
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
                    {{ $ripen?->no_ijazah }}
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
                    {{ \Carbon\Carbon::parse($ripen?->tanggal_ijazah)->translatedFormat('d F Y') }}
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
                    {{ $ripen?->lama_belajar }} tahun
                </h4>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>23. </td>
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
                    {{ $siswa?->tingkat . ' ' . $siswa?->nama_jurusan . ' ' . $siswa?->nama_kelas }}
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
                    {{ $siswa?->nama_jurusan }}
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
                    {{ \Carbon\Carbon::parse($siswa?->tanggal_keterima)->translatedFormat('d F Y') }}
                </h4>
            </td>
        </tr>
        <tr>
            <td colspan="5"></td>
        </tr>
        {{-- AKHIR --}}

        {{-- KETERANGAN TENTANG AYAH KANDUNG --}}
        <tr>
            <td colspan="5">
                <h4 class="sub-judul">E. KETERANGAN TENTANG AYAH KANDUNG</h4>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>24. </td>
            <td>Nama Lengkap</td>
            <td>:</td>
            <td>
                <h4>
                    {{ Str::ucfirst($ayah?->nama_ayah) }}
                </h4>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>25. </td>
            <td>Tempat/Tangal Lahir</td>
            <td>:</td>
            <td>
                <h4>
                    {{ Str::ucfirst($ayah?->tempat_lahir_ayah) . ', ' . \Carbon\Carbon::parse($ayah?->tanggal_lahir_ayah)->translatedFormat('d F Y') }}
                </h4>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>26. </td>
            <td>Agama</td>
            <td>:</td>
            <td>
                <h4>
                    {{ Str::ucfirst($ayah?->agama->agama) }}
                </h4>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>27. </td>
            <td>Nomor Induk Kependudukan</td>
            <td>:</td>
            <td>
                <h4>
                    {{ $ayah?->nik_ayah }}
                </h4>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>28. </td>
            <td>Kewarganegaraan</td>
            <td>:</td>
            <td>
                <h4>
                    {{ Str::ucfirst($ayah?->kewarganegaraan_ayah) }}
                </h4>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>29. </td>
            <td>Pendidikan Terakhir</td>
            <td>:</td>
            <td>
                <h4>
                    {{ $ayah?->pendidikan?->pendidikan }}
                </h4>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>30. </td>
            <td>Pekerjaan</td>
            <td>:</td>
            <td>
                <h4>
                    {{ Str::ucfirst($ayah?->pekerjaan_ayah) }}
                </h4>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>31. </td>
            <td>Penghasilan per Bulan</td>
            <td>:</td>
            <td>
                <h4>
                    {{ 'Rp. ' . $ayah?->penghasilan_ayah }}
                </h4>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>32. </td>
            <td>Alamat Rumah</td>
            <td>:</td>
            <td>
                <h4>
                    {{ Str::ucfirst($ayah?->alamat_ayah) }}
                </h4>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>33. </td>
            <td>No. Telp/HP</td>
            <td>:</td>
            <td>
                <h4>
                    {{ $ayah?->telp_ayah }}
                </h4>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>34. </td>
            <td>Masih Hidup/Meninggal Dunia</td>
            <td>:</td>
            <td>
                <h4>
                    {{ $ayah?->status_kematian_ayah }}
                </h4>
            </td>
        </tr>
        <tr>
            <td colspan="5"></td>
        </tr>
        {{-- AKHIR --}}

        {{-- KETERANGAN TENTANG IBU KANDUNG --}}
        <tr>
            <td colspan="5">
                <h4 class="sub-judul">F. KETERANGAN TENTANG IBU KANDUNG</h4>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>35. </td>
            <td>Nama Lengkap</td>
            <td>:</td>
            <td>
                <h4>
                    {{ Str::ucfirst($ibu?->nama_ibu) }}
                </h4>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>36. </td>
            <td>Tempat/Tangal Lahir</td>
            <td>:</td>
            <td>
                <h4>
                    {{ Str::ucfirst($ibu?->tempat_lahir_ibu) . ', ' . \Carbon\Carbon::parse($ibu?->tanggal_lahir_ibu)->translatedFormat('d F Y') }}
                </h4>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>37. </td>
            <td>Agama</td>
            <td>:</td>
            <td>
                <h4>
                    {{ Str::ucfirst($ibu?->agama->agama) }}
                </h4>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>38. </td>
            <td>Nomor Induk Kependudukan</td>
            <td>:</td>
            <td>
                <h4>
                    {{ $ibu?->nik_ibu }}
                </h4>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>39. </td>
            <td>Kewarganegaraan</td>
            <td>:</td>
            <td>
                <h4>
                    {{ Str::ucfirst($ibu?->kewarganegaraan_ibu) }}
                </h4>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>40. </td>
            <td>Pendidikan Terakhir</td>
            <td>:</td>
            <td>
                <h4>
                    {{ $ibu?->pendidikan?->pendidikan }}
                </h4>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>41. </td>
            <td>Pekerjaan</td>
            <td>:</td>
            <td>
                <h4>
                    {{ Str::ucfirst($ibu?->pekerjaan_ibu) }}
                </h4>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>42. </td>
            <td>Penghasilan per Bulan</td>
            <td>:</td>
            <td>
                <h4>
                    {{ 'Rp. ' . $ibu?->penghasilan_ibu }}
                </h4>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>43. </td>
            <td>Alamat Rumah</td>
            <td>:</td>
            <td>
                <h4>
                    {{ Str::ucfirst($ibu?->alamat_ibu) }}
                </h4>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>44. </td>
            <td>No. Telp/HP</td>
            <td>:</td>
            <td>
                <h4>
                    {{ $ibu?->telp_ibu }}
                </h4>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>45. </td>
            <td>Masih Hidup/Meninggal Dunia</td>
            <td>:</td>
            <td>
                <h4>
                    {{ $ibu?->status_kematian_ibu }}
                </h4>
            </td>
        </tr>
        <tr>
            <td colspan="5"></td>
        </tr>
        {{-- AKHIR --}}

        {{-- KETERANGAN TENTANG WALI MURID --}}
        <tr>
            <td colspan="5">
                <h4 class="sub-judul">G. KETERANGAN TENTANG WALI MURID</h4>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>46. </td>
            <td>Nama Lengkap</td>
            <td>:</td>
            <td>
                <h4>
                    {{ $walmur?->nama_walmur ? Str::ucfirst($walmur?->nama_walmur) : '............................................................................' }}
                </h4>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>47. </td>
            <td>Tempat/Tangal Lahir</td>
            <td>:</td>
            <td>
                <h4>
                    {{ $walmur?->tempat_lahir_walmur ? Str::ucfirst($walmur?->tempat_lahir_walmur) . ', ' . \Carbon\Carbon::parse($walmur?->tanggal_lahir_walmur)->translatedFormat('d F Y') : '............................................................................' }}
                </h4>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>48. </td>
            <td>Agama</td>
            <td>:</td>
            <td>
                <h4>
                    {{ $walmur?->agama->agama ? Str::ucfirst($walmur?->agama->agama) : '............................................................................' }}
                </h4>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>49. </td>
            <td>Nomor Induk Kependudukan</td>
            <td>:</td>
            <td>
                <h4>
                    {{ $walmur?->nik_walmur ? $walmur?->nik_walmur : '............................................................................' }}
                </h4>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>50. </td>
            <td>Kewarganegaraan</td>
            <td>:</td>
            <td>
                <h4>
                    {{ $walmur?->kewarganegaraan_walmur ? Str::ucfirst($walmur?->kewarganegaraan_walmur) : '............................................................................' }}
                </h4>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>51. </td>
            <td>Pendidikan Terakhir</td>
            <td>:</td>
            <td>
                <h4>
                    {{ $walmur?->pendidikan?->pendidikan ? $walmur?->pendidikan?->pendidikan : '............................................................................' }}
                </h4>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>52. </td>
            <td>Pekerjaan</td>
            <td>:</td>
            <td>
                <h4>
                    {{ $walmur?->pekerjaan_walmur ? Str::ucfirst($walmur?->pekerjaan_walmur) : '............................................................................' }}
                </h4>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>53. </td>
            <td>Penghasilan per Bulan</td>
            <td>:</td>
            <td>
                <h4>
                    {{ $walmur?->penghasilan_walmur ? 'Rp. ' . $walmur?->penghasilan_walmur : '............................................................................' }}
                </h4>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>54. </td>
            <td>Alamat Rumah</td>
            <td>:</td>
            <td>
                <h4>
                    {{ $walmur?->alamat_walmur ? Str::ucfirst($walmur?->alamat_walmur) : '............................................................................' }}
                </h4>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>55. </td>
            <td>No. Telp/HP</td>
            <td>:</td>
            <td>
                <h4>
                    {{ $walmur?->telp_walmur ? $walmur?->telp_walmur : '............................................................................' }}
                </h4>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>56. </td>
            <td>Hubungan Keluarga Dengan Siswa</td>
            <td>:</td>
            <td>
                <h4>
                    {{ $walmur?->hubungan_siswa_walmur ? $walmur?->hubungan_siswa_walmur : '............................................................................' }}
                </h4>
            </td>
        </tr>
        <tr>
            <td colspan="5"></td>
        </tr>
        {{-- AKHIR --}}

        {{-- KEGEMARAN SISWA --}}
        <tr>
            <td colspan="5">
                <h4 class="sub-judul">H. KEGEMARAN SISWA</h4>
            </td>
        </tr>
        </tr>
        <tr>
            <td></td>
            <td>51. </td>
            <td>Kesenian</td>
            <td>:</td>
            <td>
                <h4>
                    {{ $minat?->kesenian ? Str::ucfirst($minat?->kesenian) : '............................................................................' }}
                </h4>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>52. </td>
            <td>Olahraga</td>
            <td>:</td>
            <td>
                <h4>
                    {{ $minat?->olahraga ? Str::ucfirst($minat?->olahraga) : '............................................................................' }}
                </h4>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>53. </td>
            <td>kemasyarakatan / Organisasi</td>
            <td>:</td>
            <td>
                <h4>
                    {{ $minat?->organisasi ? Str::ucfirst($minat?->organisasi) : '............................................................................' }}
                </h4>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>54. </td>
            <td>Lain-lain</td>
            <td>:</td>
            <td>
                <h4>
                    {{ $minat?->lain_lain ? Str::ucfirst($minat?->lain_lain) : '............................................................................' }}
                </h4>
            </td>
        </tr>
        <tr>
            <td colspan="5"></td>
        </tr>
        {{-- AKHIR --}}

        {{-- BEASISWA SISWA --}}
        <tr>
            <td colspan="5">
                <h4 class="sub-judul">I. BEASISWA SISWA</h4>
            </td>
        </tr>
        <tr>
            <td></td>
            <td colspan="4">
                <table class="minat" border="1">
                    <tr>
                        <th>
                            Nama Beasiswa
                        </th>
                        <th>
                            Tahun
                        </th>
                        <th>
                            Pemberi
                        </th>
                        <th>
                            Nominal
                        </th>
                    </tr>
                    @forelse ($beasiswa as $item)
                        <tr>
                            <td align="center">
                                {{ $item?->nama_beasiswa }}
                            </td>
                            <td align="center">
                                {{ $item?->tahun_beasiswa }}
                            </td>
                            <td align="center">
                                {{ $item?->pemberi_beasiswa }}
                            </td>
                            <td align="center">
                                {{ $item?->nominal_beasiswa }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td style="padding: 20px 0px;" colspan="4" align="center">
                                Tidak memiliki beasiswa
                            </td>
                        </tr>
                    @endforelse
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="5"></td>
        </tr>
        {{-- AKHIR --}}

        {{-- PRESTASI SISWA --}}
        <tr>
            <td colspan="5">
                <h4 class="sub-judul">J. PRESTASI SISWA</h4>
            </td>
        </tr>
        <tr>
            <td></td>
            <td colspan="4">
                <table class="minat" border="1">
                    <tr>
                        <th>
                            Nama Prestasi
                        </th>
                        <th>
                            Tahun
                        </th>
                        <th>
                            Penyelenggara
                        </th>
                        <th>
                            Tempat
                        </th>
                    </tr>
                    @forelse ($prestasi as $item)
                        <tr>
                            <td align="center">
                                {{ $item?->nama_prestasi }}
                            </td>
                            <td align="center">
                                {{ $item?->tahun_prestasi }}
                            </td>
                            <td align="center">
                                {{ $item?->penyelenggara_prestasi }}
                            </td>
                            <td align="center">
                                {{ $item?->tempat_prestasi }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td style="padding: 20px 0px;" colspan="4" align="center">
                                Tidak memiliki prestasi
                            </td>
                        </tr>
                    @endforelse
                </table>
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
                {{ $sekolah?->kota }}, {{ \Carbon\Carbon::parse(now())->translatedFormat('d F Y') }} <br>
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
            <td>{{ $siswa?->nama_lengkap }}</td>
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
                Kepala {{ $sekolah?->nama_sekolah }}
            </td>
            <td width="33%"></td>
        </tr>
        <tr>
            <td style="height: 80px;"></td>
            <td>{{ $sekolah?->ttd_kepsek ? asset('storage/' . $sekolah?->ttd_kepsek) : '' }}</td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <b>
                    {{ $sekolah?->nama_kepsek }} <br>
                </b>
                NIP. {{ $sekolah?->nip }}
            </td>
            <td></td>
        </tr>
    </table>
    {{-- AKHIR --}}
</body>

</html>
