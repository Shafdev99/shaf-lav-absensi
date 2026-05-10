<?php

use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AlumniController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\KurikulumController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\MutasiController;
use App\Http\Controllers\PengaturanController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\PindahKelasController;
use App\Http\Controllers\ProcessController;
use App\Http\Controllers\RekapController;
use App\Http\Controllers\SesiPelajaranController;
use App\Http\Controllers\SpmbController;
use App\Http\Controllers\SusunJadwalController;
use App\Http\Controllers\TransisiSemester;
use App\Http\Controllers\WaliKelasController;
use App\Models\Absensi;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::get('/storage-link', function () {
    Artisan::call('storage::link');
    return 'Storage link successfully!';
});

//======== 404 Not Found ========//
Route::get('/404', function () {
    return view('404');
});

Route::get('/', [AuthController::class, 'index'])->middleware(['login']);

//======== Index ========//
Route::get('/resetPassword', [AuthController::class, 'resetPassword'])->name('resetPassword');
Route::post('/resetPassword', [AuthController::class, 'validasiPassword'])->name('prosesReset');

//======== Validasi User ========//
Route::post('/auth', [AuthController::class, 'validasi']);

//======== Logout ========//
Route::post('/logout', [AuthController::class, 'logout']);

//======== SPMB For Visitor ========//
Route::controller(SpmbController::class)->group(
    function () {
        Route::post('/proses-daftar-cmb', 'prosesDaftarCmb')->name('spmb.daftar.cmb');
        Route::get('/form-daftar', 'formDaftar')->name('form.daftar');
        Route::get('/halaman-daftar', 'halamanDaftar')->name('halaman.daftar');
        Route::get('/bukti-pendaftaran/{pendaftarId}', 'buktiPendaftaran')->name('bukti.pendaftaran');
        Route::get('/halaman-konfirmasi/{pendaftarId}', 'halamanKonfirmasi')->name('halaman.konfirmasi');
        Route::get('/alur-pendaftaran', 'alurPendaftaran')->name('alur.pendaftaran');
        Route::get('/syarat-pendaftaran', 'syaratPendaftaran')->name('syarat.pendaftaran');
        Route::get('/unduh-brosur', 'unduhBrosur')->name('unduh.brosur');
        Route::get('/cek-status', 'cekStatus')->name('cek.status');
        Route::post('/cek-status', 'cekStatus')->name('cek.status');
    }
);

/** 
 * Admin & User => Hanya admin dan user yang bisa mengakses halaman ini 
 */
Route::middleware(['all'])->group(function () {
    //======== Beranda ========//
    Route::get('/beranda', [MasterController::class, 'index'])->name('beranda');

    //======== SPMB ========//
    Route::controller(SpmbController::class)->group(function () {
        Route::get('/pendaftar', 'pendaftar')->name('pendaftar');
        Route::get('/pengaturan-spmb/{side?}', 'pengaturanSpmb')->name('spmb.pengaturan');
        Route::post('/add-syarat', 'addSyarat')->name('spmb.add.syarat');
        Route::post('/add-alur', 'addAlur')->name('spmb.add.alur');
        Route::post('/add-sosmed', 'addSosmed')->name('spmb.add.sosmed');
        Route::put('/edit-sosmed', 'editSosmed')->name('spmb.edit.sosmed');
        Route::delete('/delete-sosmed', 'deleteSosmed')->name('spmb.delete.sosmed');
        Route::put('/update-umum', 'updateUmum')->name('spmb.update.umum');
        Route::delete('/hapus-gambar-spmb', 'hapusGambarSpmb')->name('spmb.hapus.gambar');
        Route::post('/ubah-status-pendaftar', 'ubahStatusPendaftar')->name('spmb.ubah.status');
        Route::get('/detail-pendaftar/{id}/{menu}', 'detailPendaftar')->name('spmb.detail.pendaftar');
        Route::get('/tambah-pendaftar', 'tambahPendaftar')->name('spmb.tambah.pendaftar');
        Route::post('/tambah-pendaftar', 'simpanPendaftar')->name('spmb.simpan.pendaftar');
        Route::get('/ubah-pendaftar/{pendaftarId}', 'ubahPendaftar')->name('spmb.ubah.pendaftar');
        Route::put('/ubah-pendaftar/{pendaftarId}', 'perbaruiPendaftar')->name('spmb.perbarui.pendaftar');
        Route::delete('/hapus-pendaftar', 'hapusPendaftar')->name('spmb.hapus.pendaftar');
        Route::post('/cabut-berkas', 'cabutBerkas')->name('spmb.cabut.berkas');
        Route::get('/getDataCabutBerkas/{pendaftarId}', 'getCabutBerkas');
        Route::get('/export-pendaftar', 'exportPendaftar')->name('export.pendaftar');
        Route::get('/migrasi', 'spmbMigrasi')->name('spmb.migrasi');
        Route::get('/spmb-rekap', 'rekapSpmb')->name('spmb.rekap');
        Route::get('/terima-beberapa/{siswaId}', 'terimaBeberapa');
    });

    Route::controller(MasterController::class)->group(function () {
        //======== Menu Siswa ========//
        Route::get('/siswa', 'siswa')->name('siswa');
        Route::get('/getSiswa/{id}', 'getSiswa');
        Route::get('/siswa-create', 'createSiswa')->name('siswa.add');
        Route::post('/siswa-add', 'storeSiswa')->name('siswa.store');
        Route::get('/siswa-edit/{id}', 'editSiswa')->name('siswa.edit');
        Route::put('/siswa-update/{siswa:id}', 'updateSiswa')->name('siswa.update');
        Route::delete('/siswa', 'deleteSiswa')->name('siswa.delete');
        Route::delete('/siswa-some-delete', 'hapusSiswaTerpilih')->name('siswa.someDelete');
        Route::get('/export-siswa', 'exportSiswa')->name('export.siswa');
        Route::post('/import-siswa', 'importSiswa')->name('import.siswa');
        Route::get('/Sample-Import-Data-Siswa', 'templateImport')->name('import.sample');
        Route::get('/getKelasByJurusan/{jurusanId}/{tingkatId}', 'getKelasByJurusan');
        Route::get('/getOneKelasByJurusan/{jurusanId}/{tingkatId}', 'getOneKelasByJurusan');
        Route::get('/getKelasByTahunAjar/{tahunAjarId}', 'getKelasByTahunAjar');

        //======== Menu Profil ========// 
        Route::get('/profil', 'profilView')->name('profil');
        Route::put('/profil', 'updateProfil')->name('profil.update');
        Route::post('/ubah-foto', 'ubahFotoProfil')->name('ubahFotoProfil');
        Route::post('/respas', 'resetPassProf')->name('profil.respas');
    });

    Route::controller(RekapController::class)->group(function () {
        //======== Menu Rekap Binduk ========//
        Route::get('/rekap', 'rekap')->name('rekap');

        // Siswa
        Route::get('alumni/form-data/siswa/{id}', 'formSiswa')->name('alumni.form.siswa');
        Route::get('/form-data/siswa/{id}', 'formSiswa')->name('rekap.form.siswa');
        Route::put('/form-data/siswa/{siswa:id}', 'formSiswaUpdate')->name('rekap.form.siswa.update');

        // Orang tua
        Route::get('alumni/form-data/ortu/{id}', 'formOrtu')->name('alumni.form.ortu');
        Route::get('/form-data/ortu/{id}', 'formOrtu')->name('rekap.form.ortu');
        Route::put('/form-data/ortu/{id}', 'formOrtuUpdate')->name('rekap.form.ortu.update');

        // Biodata
        Route::get('alumni/form-data/biodata/{id}', 'formBiodata')->name('alumni.form.biodata');
        Route::get('/form-data/biodata/{id}', 'formBiodata')->name('rekap.form.biodata');
        Route::put('/form-data/biodata/{id}', 'formBiodataUpdate')->name('rekap.form.biodata.update');

        // Wali murid
        Route::get('alumni/form-data/walmur/{id}', 'formWalmur')->name('alumni.form.walmur');
        Route::get('/form-data/walmur/{id}', 'formWalmur')->name('rekap.form.walmur');
        Route::put('/form-data/walmur/{id}', 'formWalmurUpdate')->name('rekap.form.walmur.update');

        // Riwayat pendidikan
        Route::get('alumni/form-data/pendidikan/{id}', 'formPendidikan')->name('alumni.form.pendidikan');
        Route::get('/form-data/pendidikan/{id}', 'formPendidikan')->name('rekap.form.pendidikan');
        Route::put('/form-data/pendidikan-update/{id}', 'formPendidikanUpdate')->name('rekap.form.pendidikan.update');

        // Kesehatan
        Route::get('alumni/form-data/kesehatan/{id}', 'formKesehatan')->name('alumni.form.kesehatan');
        Route::get('/form-data/kesehatan/{id}', 'formKesehatan')->name('rekap.form.kesehatan');
        Route::put('/form-data/kesehatan/{id}', 'formKesehatanUpdate')->name('rekap.form.kesehatan.update');

        // Minat
        Route::get('alumni/form-data/minat/{id}', 'formMinat')->name('alumni.form.minat');
        Route::get('/form-data/minat/{id}', 'formMinat')->name('rekap.form.minat');
        Route::put('/form-data/minat/{id}', 'formMinatUpdate')->name('rekap.form.minat.update');

        // Beasiswa
        Route::get('alumni/form-data/beasiswa/{id}', 'formBeasiswa')->name('alumni.form.beasiswa');
        Route::get('/form-data/beasiswa/{id}', 'formBeasiswa')->name('rekap.form.beasiswa');
        Route::post('/form-data/beasiswa/{id}', 'formBeasiswaCreate')->name('rekap.form.beasiswa.create');
        Route::get('/getBeasiswa/{id}', 'getBeasiswa');
        Route::put('/form-data/beasiswa/{id}', 'formBeasiswaUpdate')->name('rekap.form.beasiswa.update');
        Route::delete('/form-data/beasiswa/{id}', 'formBeasiswaDelete')->name('rekap.form.beasiswa.delete');

        // Prestasi
        Route::get('alumni/form-data/prestasi/{id}', 'formPrestasi')->name('alumni.form.prestasi');
        Route::get('/form-data/prestasi/{id}', 'formPrestasi')->name('rekap.form.prestasi');
        Route::post('/form-data/prestasi/{id}', 'formPrestasiCreate')->name('rekap.form.prestasi.create');
        Route::get('/getPrestasi/{id}', 'getPrestasi');
        Route::put('/form-data/prestasi/{id}', 'formPrestasiUpdate')->name('rekap.form.prestasi.update');
        Route::delete('/form-data/prestasi/{id}', 'formPrestasiDelete')->name('rekap.form.prestasi.delete');

        // Lampiran
        Route::get('alumni/form-data/lampiran/{id}', 'formLampiran')->name('alumni.form.lampiran');
        Route::get('/form-data/lampiran/{id}', 'formLampiran')->name('rekap.form.lampiran');
        Route::post('/form-data/lampiran/{id}', 'formLampiranCreate')->name('rekap.form.lampiran.create');
        Route::get('/getLampiran/{id}', 'getLampiran');
        Route::put('/form-data/lampiran/{id}', 'formLampiranUpdate')->name('rekap.form.lampiran.update');
        Route::delete('/form-data/lampiran/{id}', 'formLampiranDelete')->name('rekap.form.lampiran.delete');

        // Nilai
        Route::get('alumni/form-data/nilai/{id}', 'formNilai')->name('alumni.form.nilai');
        Route::get('/form-data/nilai/{id}', 'formNilai')->name('rekap.form.nilai');
        Route::put('/form-data/nilai/{id}', 'formNilaiUpdate')->name('rekap.form.nilai.update');

        // Cetak buku induk
        Route::get('/dataSiswa/{siswa:id}', 'cetakDataSiswa')->name('rekap.cetak.data.siswa');
    });

    Route::controller(MutasiController::class)->group(function () {

        //======== Menu Mutasi Siswa ========//
        Route::get('/mutasi', 'mutasi')->name('mutasi');
        Route::get('/mutasi-siswa/{id}', 'mutasiSiswa')->name('mutasi.siswa');
        Route::put('/mutasi-siswa-update/{id}', 'mutasiSiswaUpdate')->name('mutasi.siswa.update');
        Route::get('/cetak-mutasi/{siswa:id}', 'cetakMutasiSiswa')->name('cetak.mutasi');
    });

    Route::controller(AlumniController::class)->group(function () {
        //======== Menu Alumni ========//
        Route::get('/alumni', 'index')->name('alumni');
    });

    Route::controller(PindahKelasController::class)->group(function () {
        //======== Menu Pindah Kelas dan Lulus ========//
        Route::post('/pindah-kelas', 'prosesPindahKelas')->name('siswa.pindahKelas');
    });

    Route::controller(ProcessController::class)->group(function () {

        //======== Menu Naik Kelas dan Lulus ========//
        Route::get('/naik-kelas', 'naikKelas')->name('siswa.naik');
        Route::post('/naik-kelas', 'prosesNaikKelas')->name('naik.kelas');
        Route::post('/lulus-sekolah', 'prosesLulusSekolah')->name('lulus');

        //======== Menu Activity Log ========//
        Route::get('/activity-log', 'activityLog')->name('log');
    });

    Route::controller(AbsensiController::class)->group(function () {
        //======== Menu Absensi ========//
        Route::get('/absensi/{hari_id?}', 'index')->name('absensi');
        Route::post('/absensi', 'store')->name('absensi.store');
    });
});


/** 
 * Admin => Hanya admin yang bisa mengakses halaman ini 
 */
Route::middleware(['admin'])->group(function () {

    Route::controller(PenggunaController::class)->group(function () {

        //======== Menu User ========//
        Route::get('/user/{role?}', 'userView')->name('user');
        Route::get('/user-add', 'createUser')->name('user.add');
        Route::get('/user-add-guru', 'generateUserGuru')->name('user.add.guru');
        Route::get('/user-respas-guru', 'userRespasGuru')->name('user.reset.pass.guru');
        Route::get('/user-add-staff', 'generateUserStaff')->name('user.add.staff');
        Route::get('/user-respas-staff', 'userRespasStaff')->name('user.reset.pass.staff');
        Route::get('/user-add-kepsek', 'generateUserKepsek')->name('user.add.kepsek');
        Route::get('/user-respas-kepsek', 'userRespasKepsek')->name('user.reset.pass.kepsek');
        Route::post('/user-store', 'storeUser')->name('user.store');
        Route::get('/user-edit/{user:id}', 'editUser')->name('user.edit');
        Route::put('/user-edit/{user:id}', 'updateUser')->name('user.update');
        Route::delete('/user-delete', 'deleteUser')->name('user.delete');
        Route::get('/user/status/{id}/{role?}', 'statusUser')->name('user.status');
        Route::post('/user/reset/{role?}', 'resetPassUser')->name('user.reset');
    });

    Route::controller(PengaturanController::class)->group(function () {

        //======== Menu Setting ========// 
        Route::get('/setting', 'settingView')->name('setting');
        Route::post('/setting', 'ubahSetting')->name('setting.update');

        //======== Menu Tahun Akademik ========//
        // Route::get('/buat-tahun-akademik', 'buatTahunAkademik')->name('buat.tahun.akademik');
        // Route::get('/aktifasi-tahun-akademik/{id}', 'aktifasiTahunAkademik')->name('aktifasi.tahun.akademik');
        // Route::post('/tambah-tahun-akademik', 'tambahTahunAkademik')->name('tambah.tahun.akademik');
        // Route::put('/ubah-tahun-akademik', 'ubahTahunAkademik')->name('ubah.tahun.akademik');
        // Route::delete('/hapus-tahun-akademik', 'hapusTahunAkademik')->name('hapus.tahun.akademik');
    });

    Route::controller(GuruController::class)->group(function () {
        //======== Menu Guru ========//
        Route::get('/guru', 'guru')->name('guru');
        Route::post('/guru-add', 'addGuru')->name('guru.add');
        Route::put('/guru-edit', 'editGuru')->name('guru.edit');
        Route::delete('/guru-delete', 'delGuru')->name('guru.delete');

        //======== Menu Status Kepegawaian ========//
        Route::post('/stapeg-add', 'addStaPeg')->name('stapeg.add');
        Route::put('/stapeg-edit', 'editStaPeg')->name('stapeg.edit');
        Route::delete('/stapeg-delete', 'delStaPeg')->name('stapeg.delete');
        Route::get('/getStatusPegawaiDalamGuru/{id}', 'getStatusPegawaiDalamGuru');
    });

    Route::controller(KelasController::class)->group(function () {
        //======== Menu tingkat ========//
        Route::get('/tingkat', 'tingkat')->name('tingkat');
        Route::post('/tingkat-add', 'addtingkat')->name('tingkat.add');
        Route::put('/tingkat-update', 'updatetingkat')->name('tingkat.edit');
        Route::delete('/tingkat-delete', 'deletetingkat')->name('tingkat.delete');
        Route::get('/getKelasDalamTingkat/{id}', 'getKelasDalamTingkat');

        //======== Menu Kelas ========//
        Route::get('/kelas', 'kelas')->name('kelas');
        Route::post('/kelas-add', 'addKelas')->name('kelas.add');
        Route::put('/kelas-update', 'updateKelas')->name('kelas.edit');
        Route::delete('/kelas-delete', 'deleteKelas')->name('kelas.delete');
        Route::get('/getSiswaDalamKelas/{id}', 'getSiswaDalamKelas');

        //======== Menu Jurusan ========//
        Route::get('/jurusan', 'jurusan')->name('jurusan');
        Route::post('/jurusan-add', 'addJurusan')->name('jurusan.add');
        Route::put('/jurusan-update', 'updateJurusan')->name('jurusan.edit');
        Route::delete('/jurusan-delete', 'deleteJurusan')->name('jurusan.delete');
        Route::get('/getSiswaDalamJurusan/{id}', 'getSiswaDalamJurusan');
    });

    Route::controller(MapelController::class)->group(function () {

        //======== Menu Kelompok Mapel ========//
        Route::post('/kelompok-mapel-add', 'addKelompokMapel')->name('kelma.add');
        Route::put('/kelompok-mapel-edit', 'editKelompokMapel')->name('kelma.edit');
        Route::delete('/kelompok-mapel-delete', 'delKelompokMapel')->name('kelma.delete');

        //======== Menu Mapel ========//
        Route::get('/mapel', 'mapel')->name('mapel');
        Route::post('/mapel-add', 'addMapel')->name('mapel.add');
        Route::put('/mapel-edit', 'editMapel')->name('mapel.edit');
        Route::put('/mapel-edit-kkm', 'editMapelKkm')->name('mapel.edit.kkm');
        Route::delete('/mapel-delete', 'delMapel')->name('mapel.delete');
        Route::get('/getKelmaDalamKurlumMapel/{id}', 'getKelmaDalamKurlumMapel');

        //======== Menu Guru Pengampu ========//
        Route::get('/pengampu', 'pengampu')->name('pengampu');
        Route::post('/tambah-guru-pengampu', 'tambahGuruPengampu')->name('guru.pengampu.add');
        Route::put('/edit-guru-pengampu', 'editGuruPengampu')->name('guru.pengampu.edit');
        Route::delete('/hapus-guru-pengampu', 'hapusGuruPengampu')->name('guru.pengampu.delete');
        Route::post('/kelola-kelas-guru-pengampu', 'kelolaKelasGuruPengampu')->name('guru.pengampu.kelola.kelas');
        Route::get('/get-kelas-guru-pengampu/{id}', 'getKelasGuruPengampu');
    });

    Route::controller(SesiPelajaranController::class)->group(function () {

        //======== Menu Sesi Pelajaran ========//
        Route::get('/sesi-pelajaran/{hari_id?}', 'index')->name('sesi.pelajaran');
        Route::post('/sesi-pelajaran-add', 'addSesiPelajaran')->name('sesi.pelajaran.add');
        Route::put('/sesi-pelajaran-edit', 'editSesiPelajaran')->name('sesi.pelajaran.edit');
        Route::delete('/sesi-pelajaran-delete', 'deleteSesiPelajaran')->name('sesi.pelajaran.delete');

        //======== Menu Hari ========//
        // Route::get('/hari', 'hari')->name('hari');
        Route::post('/hari-add', 'addHari')->name('hari.add');
        Route::put('/hari-edit', 'editHari')->name('hari.edit');
        Route::delete('/hari-delete', 'deleteHari')->name('hari.delete');
        Route::get('/generate-hari', 'generateHari')->name('generate.hari');
    });

    Route::controller(SusunJadwalController::class)->group(function () {

        //======== Menu Susun Jadwal ========//
        Route::get('/susun-jadwal/{hari_id?}', 'index')->name('susun.jadwal');
        Route::get('/proses-susun-jadwal', 'prosesSusunJadwal')->name('proses.susun.jadwal');
        // Route::get('/cetak-jadwal/{tahunAjarId}/{kelasId}', 'cetakJadwal')->name('cetak.jadwal');
        Route::post('/guru-pengampu/update', 'simpanGuruPengampu')->name('guru.pengampu.simpan');
        Route::get('/reset-jadwal', 'resetJadwal')->name('reset.jadwal');
    });

    Route::controller(KurikulumController::class)->group(function () {

        //======== Menu Kurikulum ========//
        Route::get('/kurikulum', 'kurikulum')->name('kurikulum');
        Route::post('/kurikulum-add', 'addKurlum')->name('kurikulum.add');
        Route::put('/kurikulum-edit', 'editKurlum')->name('kurikulum.edit');
        Route::delete('/kurikulum-delete', 'delKurlum')->name('kurikulum.delete');
        Route::get('/kurikulum-mapel/{id}', 'kurikulumMapel')->name('kurikulum.mapel');
        Route::post('/kurikulum-mapel-add', 'addKurMapel')->name('kurikulum.mapel.add');
        Route::delete('/kurikulum-mapel-delete', 'delKurMapel')->name('kurikulum.mapel.delete');
        Route::post('/ubah-urutan-mapel', 'ubahUrutanMapel')->name('ubahUrutanMapel');
    });

    Route::controller(WaliKelasController::class)->group(function () {

        //======== Menu Wali Kelas ========//
        Route::get('/walkel', 'walkel')->name('walkel');
        Route::post('/walkel-update', 'updateWalkel')->name('walkel.update');
    });

    Route::controller(AdminController::class)->group(function () {

        //======== Menu Tahun Ajar ========//
        Route::get('/tahun-ajar', 'tahunAjar')->name('tahun.ajar');
        Route::get('/get-tahun-ajar/{id}', 'getTahunAjar');
        Route::post('/tahun-ajar-add', 'addTahunAjar')->name('tahun.ajar.add');
        Route::put('/tahun-ajar-edit', 'editTahunAjar')->name('tahun.ajar.edit');
        Route::delete('/tahun-ajar-delete', 'delTahunAjar')->name('tahun.ajar.delete');
        Route::get('/aktifasi-tahun-ajar/{id}', 'aktifasiTahunAjar')->name('aktifasi.tahun.ajar');
        Route::get('/getDataTahunAjar/{periode}', 'getDataTahunAjar');
        Route::get('/ubahKurikulumTajar/{kurikulumId}/{tahunAjarId}', 'ubahKurikulumTajar');


        //======== Menu Agama ========//
        Route::get('/agama', 'agama')->name('agama');
        Route::post('/agama-add', 'addAgama')->name('agama.add');
        Route::put('/agama-edit', 'editAgama')->name('agama.edit');
        Route::delete('/agama-delete', 'deleteAgama')->name('agama.delete');

        //======== Menu Pendidikan ========//
        Route::get('/pendidikan', 'pendidikan')->name('pendidikan');
        Route::post('/pendidikan-add', 'addPendidikan')->name('pendidikan.add');
        Route::put('/pendidikan-edit', 'editPendidikan')->name('pendidikan.edit');
        Route::delete('/pendidikan-delete', 'delPendidikan')->name('pendidikan.delete');

        //======== Menu Semester ========//
        Route::get('/semester', 'semester')->name('semester');
        Route::put('/semester-update', 'updateSemester')->name('semester.update');
        Route::delete('/semester-delete', 'delSemester')->name('semester.delete');

        //======== Menu Lampiran ========//
        Route::get('/lampiran', 'lampiran')->name('lampiran');
        Route::post('/lampiran-add', 'addLampiran')->name('lampiran.add');
        Route::put('/lampiran-edit', 'editLampiran')->name('lampiran.edit');
        Route::delete('/lampiran-delete', 'delLmpiran')->name('lampiran.delete');
    });

    Route::controller(TransisiSemester::class)->group(function () {
        Route::get('/transisi-semester', 'index')->name('transisi.semester');
        Route::get('/proses-transisi-semester/{id
        }', 'prosesTransisi')->name('proses.transisi.semester');
    });
});
