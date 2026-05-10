<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Import Excel Siswa</title>
</head>

<body>
    <table>
        <tr>
            <th><b>No</b></th>
            <th><b>Nama Lengkap</b></th>
            <th><b>Tanggal Lahir</b></th>
            <th><b>Tempat Lahir</b></th>
            <th><b>NISN</b></th>
            <th><b>NIK</b></th>
            <th><b>NIS</b></th>
            <th><b>Alamat</b></th>
            <th><b>Jenis Kelamin</b></th>
            <th><b>Agama</b></th>

            <th><b>Nama Ayah</b></th>
            <th><b>Nama Ibu</b></th>
            <th><b>Alamat Orang Tua</b></th>

            <th><b>Nama Wali</b></th>
            <th><b>Alamat Wali</b></th>

            <th><b>Tingkat Pendidikan</b></th>
            <th><b>Nama Sekolah Asal</b></th>
            <th><b>Alamat Sekolah Asal</b></th>
            <th><b>Tahun Lulus</b></th>
            <th><b>Nomer Ijazah</b></th>
            <th><b>Tanggal Ijazah</b></th>
            <th><b>Lama Belajar</b></th>

            <th><b>Tingkat Keterima</b></th>
            <th><b>Kelas Keterima</b></th>
            <th><b>Jurusan Keterima</b></th>
            <th><b>Tanggal Keterima</b></th>
        </tr>
        @foreach ($siswa as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->nama_lengkap }}</td>
                <td>{{ $item->tanggal_lahir }}</td>
                <td>{{ $item->tempat_lahir }}</td>
                <td>{{ $item->nisn }}</td>
                <td>{{ "'$item->nik" }}</td>
                <td>{{ $item->nis }}</td>
                <td>{{ $item->alamat }}</td>
                <td>{{ $item->jenis_kelamin }}</td>
                <td>{{ $item->agama }}</td>

                <td>{{ $item->nama_ayah }}</td>
                <td>{{ $item->nama_ibu }}</td>
                <td>{{ $item->alamat_ayah }}</td>

                <td>{{ $item->nama_wali ?? '-' }}</td>
                <td>{{ $item->alamat_wali ?? '-' }}</td>

                <td>{{ $item->pendidikan }}</td>
                <td>{{ $item->nama_sekolah }}</td>
                <td>{{ $item->alamat_sekolah }}</td>
                <td>{{ $item->tahun_lulus }}</td>
                <td>{{ $item->no_ijazah }}</td>
                <td>{{ $item->tanggal_iazah }}</td>
                <td>{{ $item->lama_belajar }}</td>

                <td>{{ $item->tingkat }}</td>
                <td>{{ $item->nama_kelas }}</td>
                <td>{{ $item->nama_jurusan }}</td>
                <td>{{ $item->tanggal_keterima }}</td>

            </tr>
        @endforeach
    </table>

    {{-- <table>
        <tr>
            <th colspan="3">
                <b>
                    Keterangan Tingkat Pendidikan:
                </b>
            </th>
        </tr>
        <tr>
            <th><b>No</b></th>
            <th><b>Tingkat Pendidikan</b></th>
            <th><b>Keterangan Pendidikan</b></th>
        </tr>
        @foreach ($pendidikan as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->pendidikan }}</td>
                <td>{{ $item->ket_pendidikan }}</td>
            </tr>
        @endforeach
    </table>

    <br>
    <table>
        <tr>
            <th colspan="4">
                <b>
                    Keterangan Kelas Yang Tersedia:
                </b>
            </th>
        </tr>
        <tr>
            <th><b>No</b></th>
            <th><b>tingkat</b></th>
            <th><b>Kelas</b></th>
            <th><b>Jurusan</b></th>
        </tr>
        @foreach ($kelas as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->tingkat }}</td>
                <td>{{ $item->nama_kelas }}</td>
                <td>{{ $item->nama_jurusan }}</td>
            </tr>
        @endforeach
    </table> --}}
</body>

</html>
