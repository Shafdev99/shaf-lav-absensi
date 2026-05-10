<?php

namespace App\Services;

use App\Models\Guru;
use App\Models\User;
use App\Models\Setting;
use App\Models\UserGuru;
use App\Models\UserStaff;
use App\Models\UserKepsek;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Repository\PenggunaRepository;

class PenggunaService extends Controller
{

    //======== Terhubung ke PenggunaRepository ========//
    protected $penggunaRepository;

    public function __construct(PenggunaRepository $penggunaRepository)
    {
        $this->penggunaRepository = $penggunaRepository;
    }

    // Method Tambah User
    public function createUser($request)
    {
        // Validasi data dari form //
        $data = $request->validate([
            'name'       => 'required',
            'username'   => 'required',
            'email'      => 'required',
            'password'   => 'required|min:3|max:8',
        ], [
            'required'   => ':attribute wajib diisi!',
            'max'        => ':attribute diisi maksimal :max karakter!',
            'min'        => ':attribute diisi minimal :min karakter!',
        ]);

        return $this->penggunaRepository->insertDataUser($data);
    }

    // Method Ubah User
    public function updateUser($id, $request)
    {
        // Validasi data dari form //
        $data = $request->validate([
            'name'       => 'required',
            'username'   => 'required',
            'email'      => 'required',
        ], [
            'required'   => ':attribute wajib diisi!'
        ]);

        // Input Data ke database //
        return User::where('id', $id)->update($data);
    }

    // Method Ubah Status User
    public function updateStatus($id)
    {
        return $this->penggunaRepository->updateStatusUser($id);
    }

    // Method Reset Password User
    public function resetPassUser($request)
    {
        $this->penggunaRepository->resetPasswordUser($request);

        // Ambil data user dari database
        $user = User::select('name', 'role')->where('id', $request->id)->first();

        // Function Aclog untuk merekam acitivtas setiap ada perubahan
        return $this->record(Auth::user()->id, 'Reset password', $user->name . " (" . $user->role . ")", 'Mereset password user', date('Y-m-d'), date('H:i'));
    }

    // Method Generate Akun Untuk Semua Guru
    public function generateUserGuru()
    {
        $guru         = Guru::where('jabatan', 'Guru')->get();
        $userGuru     = UserGuru::get();
        $passwordUser = Setting::first()->password_user;

        return $this->penggunaRepository->generateAkunGuru($guru, $userGuru, $passwordUser);
    }

    // Method Reset Password Akun Untuk Semua Guru
    public function resetPassAllGuru()
    {
        $userGuru = Guru::select('user_id')->userGuru()->where('tahun_akademik_id', session('tahun_akademik_id'))->get();
        $passUser = Setting::first('password_user')->password_user;

        foreach ($userGuru as $UserGuru) {
            User::where('id', $UserGuru->user_id)->update([
                'password' => Hash::make($passUser)
            ]);
        }

        return true;
    }

    // Method Generate Akun Untuk Semua Staff
    public function generateUserStaff()
    {
        $guru         = Guru::where('jabatan', 'Staff')->get();
        $userStaff    = UserStaff::get();
        $passwordUser = Setting::first()->password_user;

        return $this->penggunaRepository->generateAkunStaff($guru, $userStaff, $passwordUser);
    }

    // Method Reset Password Akun Untuk Semua Staff
    public function resetPassAllStaff()
    {
        $userStaff = Guru::select('user_id')->userStaff()->where('tahun_akademik_id', session('tahun_akademik_id'))->get();
        $passUser = Setting::first('password_user')->password_user;

        foreach ($userStaff as $UserStaff) {
            User::where('id', $UserStaff->user_id)->update([
                'password' => Hash::make($passUser)
            ]);
        }

        return true;
    }

    // Method Generate Akun Untuk Semua Kepsek
    public function generateUserKepsek()
    {
        $guru         = Guru::where('jabatan', 'Kepala Sekolah')->get();
        $userKepsek   = UserKepsek::get();
        $passwordUser = Setting::first()->password_user;

        return $this->penggunaRepository->generateAkunKepsek($guru, $userKepsek, $passwordUser);
    }

    // Method Reset Password Akun Untuk Semua Kepsek
    public function resetPassAllKepsek()
    {
        $userKepsek = Guru::select('user_id')->userKepsek()->where('tahun_akademik_id', session('tahun_akademik_id'))->get();
        $passUser = Setting::first('password_user')->password_user;

        foreach ($userKepsek as $UserKepsek) {
            User::where('id', $UserKepsek->user_id)->update([
                'password' => Hash::make($passUser)
            ]);
        }

        return true;
    }
}
