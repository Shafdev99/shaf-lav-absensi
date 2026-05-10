<?php

namespace App\Imports;

use App\Models\Ayah;
use App\Models\Ibu;
use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\KelolaSiswa;
use App\Models\KeteranganKeterima;
use App\Models\Pendidikan;
use App\Models\RiwayatPendidikan;
use App\Models\Siswa;
use App\Models\TahunAjar;
use App\Models\Tingkat;
use App\Models\Walmur;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class SiswaImport implements ToModel, SkipsEmptyRows, WithHeadingRow, WithValidation
{
    use Importable;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {

        $tingkat    = Tingkat::select('id')->where('tingkat', $row['tingkat_keterima'])->first();
        $kelas      = Kelas::select('id')->where('nama_kelas', $row['kelas_keterima'])->first();
        $jurusan    = Jurusan::select('id')->where('nama_jurusan', $row['jurusan_keterima'])->first();
        $pendidikan = Pendidikan::select('id')->where('pendidikan', $row['tingkat_pendidikan'])->first();
        $kuriulum   = TahunAjar::select('kurikulum_id')->where('id', session('tahun_ajar_id'))->first();
        $nik = trim($row['nik'], "'");

        $siswa = Siswa::create([
            'kurikulum_id'      => $kuriulum->kurikulum_id,
            'nama_lengkap'      => $row['nama_lengkap'],
            'tanggal_lahir'     => $row['tanggal_lahir'],
            'tempat_lahir'      => $row['tempat_lahir'],
            'nisn'              => $row['nisn'],
            'nik'               => $nik,
            'nis'               => $row['nis'],
            'alamat'            => $row['alamat'],
            'jenis_kelamin'     => $row['jenis_kelamin'],
            'agama'             => $row['agama'],
            'foto'              => NULL,
            'status'            => 'aktif'
        ]);

        Ayah::create([
            'siswa_id'      => $siswa->id,
            'nama_ayah'     => $row['nama_ayah'],
            'alamat_ayah'   => $row['alamat_orang_tua']
        ]);

        Ibu::create([
            'siswa_id'      => $siswa->id,
            'nama_ibu'      => $row['nama_ibu']
        ]);

        Walmur::create([
            'siswa_id'      => $siswa->id,
            'nama_wali'     => $row['nama_wali'],
            'alamat_wali'   => $row['alamat_wali']
        ]);

        RiwayatPendidikan::create([
            'siswa_id'       => $siswa->id,
            'pendidikan_id'  => $pendidikan->id,
            'nama_sekolah'   => $row['nama_sekolah_asal'],
            'alamat_sekolah' => $row['alamat_sekolah_asal'],
            'tahun_lulus'    => $row['tahun_lulus'],
            'no_ijazah'      => $row['nomer_ijazah'],
            'tanggal_ijazah'  => $row['tanggal_ijazah'],
            'lama_belajar'   => $row['lama_belajar']
        ]);

        KelolaSiswa::create([
            'siswa_id'      => $siswa->id,
            'kelas_id'      => $kelas->id,
            'tahun_ajar_id' => session('tahun_ajar_id'),
        ]);

        KeteranganKeterima::create([
            'siswa_id'         => $siswa->id,
            'tingkat_id'       => $tingkat->id,
            'kelas_id'         => $kelas->id,
            'jurusan_id'       => $jurusan->id,
            'tahun_ajar_id'    => session('tahun_ajar_id'),
            'tanggal_keterima' => $row['tanggal_keterima']
        ]);

        return $siswa;
    }

    public function rules(): array
    {
        return [
            'nama_lengkap'      => 'required',
            // 'tanggal_lahir'     => 'required|date',
            // 'tempat_lahir'      => 'required',
            // 'nisn'              => 'required|unique:siswa,nisn',
            // 'nik'               => 'required|unique:siswa,nik',
            // 'nis'               => 'required|unique:siswa,nis',
            // 'alamat'            => 'required',
            // 'jenis_kelamin'     => ['required', Rule::in(['Laki-laki', 'Perempuan'])],
            // 'agama'             => ['required', Rule::in(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'])],
            // 'tingkat_keterima'  => ['required', Rule::exists('tingkat', 'tingkat')],
            'kelas_keterima'    => ['required', Rule::exists('kelas', 'nama_kelas')],
            // 'jurusan_keterima'  => ['required', Rule::exists('jurusan', 'nama_jurusan')],
            // 'tanggal_keterima'  => 'required|date',
            // 'tingkat_pendidikan' => ['required', Rule::exists('pendidikan', 'pendidikan')],
            // 'nama_sekolah_asal' => 'required',
            // 'alamat_sekolah_asal' => 'required',
            // 'tahun_lulus'       => 'required|digits:4|integer|min:1900|max:' . (date('Y') + 1),
            // 'nomer_ijazah'      => 'required',
            // 'tanggal_ijazah'    => 'required|date',
            // 'lama_belajar'      => 'required|integer|min:1|max:20',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
            // 'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
            // 'tempat_lahir.required' => 'Tempat lahir wajib diisi.',
            // 'nisn.required' => 'NISN wajib diisi.',
            // 'nik.required' => 'NIK wajib diisi.',
            // 'nis.required' => 'NIS wajib diisi.',
            // 'alamat.required' => 'Alamat wajib diisi.',
            // 'jenis_kelamin.required' => 'Jenis kelamin wajib diisi.',
            // 'agama.required' => 'Agama wajib diisi.',
            // 'tingkat_keterima.required' => 'Tingkat keterima wajib diisi.',
            'kelas_keterima.required' => 'Kelas keterima wajib diisi.',
            // 'jurusan_keterima.required' => 'Jurusan keterima wajib diisi.',
            // 'tanggal_keterima.required' => 'Tanggal keterima wajib diisi.',
            // 'tingkat_pendidikan.required' => 'Tingkat pendidikan wajib diisi.',
            // 'nama_sekolah_asal.required' => 'Nama sekolah asal wajib diisi.',
            // 'alamat_sekolah_asal.required' => 'Alamat sekolah asal wajib diisi.',
            // 'tahun_lulus.required' => 'Tahun lulus wajib diisi.',
            // 'nomer_ijazah.required' => 'Nomer ijazah wajib diisi.',
            // 'tanggal_ijazah.required' => 'Tanggal ijazah wajib diisi.',
            // 'lama_belajar.required' => 'Lama belajar wajib diisi.'
        ];
    }
}
