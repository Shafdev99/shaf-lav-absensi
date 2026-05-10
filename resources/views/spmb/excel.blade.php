<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Export Excel Pendaftar SPMB</title>
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
            <th><b>Alamat</b></th>
            <th><b>Jenis Kelamin</b></th>
            <th><b>Agama</b></th>
            <th><b>Nama Ayah</b></th>
            <th><b>Pekerjaan Ayah</b></th>
            <th><b>Nama Ibu</b></th>
            <th><b>Pekerjaan Ibu</b></th>
            <th><b>Alamat Orang Tua</b></th>
            <th><b>Nama Wali</b></th>
            <th><b>Pekerjaan Wali</b></th>
            <th><b>Alamat Wali</b></th>
            <th><b>Nama Sekolah Asal</b></th>
            <th><b>Alamat Sekolah Asal</b></th>
            <th><b>Nomor Ijazah</b></th>
            <th><b>Rata-rata Nilai</b></th>
            <th><b>Ijazah</b></th>
            <th><b>Kartu Keluarga</b></th>
            <th><b>Akta Kelahiran</b></th>
            <th><b>Piagam Prestasi</b></th>
            <th><b>Kartu Penerima Bantuan</b></th>
            <th><b>Jurusan</b></th>
            <th><b>Tanggal Keterima</b></th>
        </tr>
        @foreach ($pendaftar as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->nama_lengkap }}</td>
                <td>{{ $item->tanggal_lahir }}</td>
                <td>{{ $item->tempat_lahir }}</td>
                <td>{{ $item->nisn }}</td>
                <td>{{ "'$item->nik" }}</td>
                <td>{{ $item->alamat }}</td>
                <td>{{ $item->jenis_kelamin }}</td>
                <td>{{ $item->religion->agama }}</td>
                <td>{{ $item->ayah->nama_ayah }}</td>
                <td>{{ $item->ayah->pekerjaan_ayah }}</td>
                <td>{{ $item->ibu->nama_ibu }}</td>
                <td>{{ $item->ibu->pekerjaan_ibu }}</td>
                <td>{{ $item->ayah->alamat_ayah }}</td>
                <td>{{ $item->wali?->nama_walmur }}</td>
                <td>{{ $item->wali?->pekerjaan_walmur }}</td>
                <td>{{ $item->wali?->alamat_walmur }}</td>
                <td>{{ $item->berkas?->asal_sekolah }}</td>
                <td>{{ $item->berkas?->alamat_sekolah }}</td>
                <td>{{ $item->berkas?->no_ijazah }}</td>
                <td>{{ $item->berkas?->rata_nilai }}</td>
                <td>{{ $item->berkas?->ijazah ? 'Ada' : 'Tidak Ada' }}</td>
                <td>{{ $item->berkas?->kartu_keluarga ? 'Ada' : 'Tidak Ada' }}</td>
                <td>{{ $item->berkas?->akta_kelahiran ? 'Ada' : 'Tidak Ada' }}</td>
                <td>{{ $item->berkas?->piagam_prestasi ? 'Ada' : 'Tidak Ada' }}</td>
                <td>{{ $item->berkas?->kartu_bantuan ? 'Ada' : 'Tidak Ada' }}</td>
                <td>{{ $item->jurusan?->nama_jurusan }}</td>
                <td>{{ $item->keterangan->tanggal_keterima }}</td>
            </tr>
        @endforeach
    </table>

</body>

</html>
