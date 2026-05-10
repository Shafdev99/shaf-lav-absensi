<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\User;
use App\Models\Setting;
use App\Services\PenggunaService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class PenggunaController extends Controller
{

    //======== Terhubung ke PenggunaService ========//
    protected $penggunaService;

    public function __construct(PenggunaService $penggunaService)
    {
        $this->penggunaService = $penggunaService;
    }

    /** 
     * Pengguna 
     */
    //======== View Data Pengguna ========//
    public function userView($role = null)
    {
        return view('user.index', [
            'role'       => $role,
            'user'       => User::where('role', 'admin')->cari(request(['keyword']))->latest()->paginate(10)->withQueryString(),
            'guru'       => Guru::userGuru()->cari(request(['keyword']))->paginate(10)->withQueryString(),
            'staff'      => Guru::userStaff()->cari(request(['keyword']))->paginate(10)->withQueryString(),
            'kepsek'     => Guru::userKepsek()->cari(request(['keyword']))->paginate(10)->withQueryString(),
            'userGuru'   => Guru::userGuru()->where('tahun_akademik_id', session('tahun_akademik_id'))->get(),
            'userStaff'  => Guru::userStaff()->where('tahun_akademik_id', session('tahun_akademik_id'))->get(),
            'userKepsek' => Guru::userKepsek()->where('tahun_akademik_id', session('tahun_akademik_id'))->get(),
        ]);
    }

    //======== Generate Akun Untuk Semua Guru ========//
    public function generateUserGuru()
    {
        $this->penggunaService->generateUserGuru();

        return to_route('user', 'guru')->with('sukses', 'Akun untuk guru sudah berhasil dibuat!');
    }

    //======== Reset Password Akun Untuk Semua Guru ========//
    public function userRespasGuru()
    {
        $this->penggunaService->resetPassAllGuru();

        return to_route('user', 'guru')->with('sukses', 'Semua password akun guru sudah berhasil diubah!');
    }

    //======== Generate Akun Untuk Semua Staff ========//
    public function generateUserStaff()
    {
        $this->penggunaService->generateUserStaff();

        return to_route('user', 'staff')->with('sukses', 'Akun untuk staff sudah berhasil dibuat!');
    }

    //======== Reset Password Akun Untuk Semua Staff ========//
    public function userRespasStaff()
    {
        $this->penggunaService->resetPassAllStaff();

        return to_route('user', 'staff')->with('sukses', 'Semua password akun staff sudah berhasil diubah!');
    }

    //======== Generate Akun Untuk Semua Kepsek ========//
    public function generateUserKepsek()
    {
        $this->penggunaService->generateUserKepsek();

        return to_route('user', 'kepala-sekolah')->with('sukses', 'Akun untuk kepala sekolah sudah berhasil dibuat!');
    }

    //======== Reset Password Akun Untuk Semua Kepsek ========//
    public function userRespasKepsek()
    {
        $this->penggunaService->resetPassAllKepsek();

        return to_route('user', 'kepala-sekolah')->with('sukses', 'Semua password akun kepala sekolah sudah berhasil diubah!');
    }

    //======== View Add User ========//
    public function createUser()
    {
        return view('user.add', [
            'passDefault' => Setting::first('password_user'),
        ]);
    }

    //======== Add Data User ========//
    public function storeUser()
    {
        // Insert data user to database
        $this->penggunaService->createUser(request());

        // Function Aclog untuk merekam acitivtas setiap ada perubahan
        $this->record(Auth::user()->id, 'Tambah data', request()->name, 'Menambah data user', date('Y-m-d'), date('H:i'));

        // Alihkan ke halamam user //
        return redirect()->route('user')->with('sukses', 'Data user berhasil ditambahkan!');
    }

    //======== View Edit User ========//
    public function editUser(User $user)
    {
        return view('user.edit', compact('user'));
    }

    //======== Edit Data User ========//
    public function updateUser($id)
    {
        // Update data user from database
        $this->penggunaService->updateUser($id, request());

        // Function Aclog untuk merekam acitivtas setiap ada perubahan
        $this->record(Auth::user()->id, 'Update data', request()->name . " (" . request()->role . ")", 'Mengubah data user', date('Y-m-d'), date('H:i'));

        // Alihkan ke halamam user //
        return redirect()->route('user')->with('sukses', 'Data user berhasil diperbarui!');
    }

    //======== Delete Data User ========//
    public function deleteUser()
    {
        $user = User::select('name', 'role')->find(request()->id);

        // Hapus data user
        User::destroy(request()->id);

        $this->record(Auth::user()->id, 'Hapus data', $user->name . " (" . $user->role . ")", 'Menghapus data', date('Y-m-d'), date('H:i'));

        // Alihkan ke halamam user //
        return redirect()->route('user')->with('sukses', 'Data user berhasil dihapus!');
    }

    //======== Change Status User ========//
    public function statusUser($id, $role = null)
    {
        // Update Status User
        $this->penggunaService->updateStatus($id);

        // Alihkan ke halaman user
        return redirect()->route('user', $role)->with('sukses', 'Status user berhasil diubah!');
    }

    //======== Reset Password User ========//
    public function resetPassUser($role = null)
    {
        // Reset Password User
        $this->penggunaService->resetPassUser(request());

        // Alihkan ke halaman user
        return redirect()->route('user', $role)->with('sukses', 'Password user tersebut berhasil direset!');
    }
}
