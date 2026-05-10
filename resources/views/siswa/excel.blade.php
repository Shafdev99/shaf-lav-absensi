<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Export Excel Siswa</title>
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
            <th><b>Nama Sekolah Asal</b></th>
            <th><b>Alamat Sekolah Asal</b></th>
            <th><b>Tahun Lulus</b></th>
            <th><b>Nomer Ijazah</b></th>
            <th><b>Tingkat Keterima</b></th>
            <th><b>Jurusan</b></th>
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
                <td>{{ $item->nama_sekolah }}</td>
                <td>{{ $item->alamat_sekolah }}</td>
                <td>{{ $item->tahun_lulus }}</td>
                <td>{{ $item->no_ijazah }}</td>
                <td>{{ $item->tingkat . ' ' . $item->nama_kelas }}</td>
                <td>{{ $item->nama_jurusan }}</td>
                <td>{{ \Carbon\Carbon::parse($item->tanggal_keterima)->translatedFormat('d F Y') }}</td>
            </tr>
        @endforeach
    </table>

</body>

</html>
