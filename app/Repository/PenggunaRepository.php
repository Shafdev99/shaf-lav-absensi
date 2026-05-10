<?php

namespace App\Repository;

use App\Models\Guru;
use App\Models\User;
use App\Models\Setting;
use App\Models\UserGuru;
use App\Models\UserStaff;
use App\Models\UserKepsek;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PenggunaRepository extends Controller
{
    public function insertDataUser($request)
    {
        // Input Data ke database //
        return User::create([
            'name'              => $request['name'],
            'username'          => $request['username'],
            'email'             => $request['email'],
            'password'          => Hash::make($request['password']),
            'role'              => 'admin',
            'status'            => 'aktif',
            'foto_profil'       => 'image/profil/profile.jpg',
            'request'           => 'kosong',
            'email_verified_at' => now(),
            'remember_token'    => Str::random(20),
        ]);
    }

    public function updateStatusUser($id)
    {
        // Ambil data user dari database
        $user = User::select('status', 'name', 'role')->where('id', $id)->first();

        // Jika status user adalah aktif
        if ($user->status == 'aktif') {

            // Maka update status user menjadi non aktif
            User::where('id', $id)->update(['status' => 'non aktif']);

            // Function Aclog untuk merekam acitivtas setiap ada perubahan
            return $this->record(Auth::user()->id, "Ubah status aktif", $user->name . " (" . $user->role . ")", 'Mengubah status non aktif user', date('Y-m-d'), date('H:i'));

            // Dan jika tidak
        } else {

            // Maka update status user menjadi aktif
            User::where('id', $id)->update(['status' => 'aktif']);

            // Function Aclog untuk merekam acitivtas setiap ada perubahan
            return $this->record(Auth::user()->id, 'Ubah status aktif', $user->name . " (" . $user->role . ")", 'Mengubah status aktif user', date('Y-m-d'), date('H:i'));
        }
    }

    public function resetPasswordUser($request)
    {
        // Ambil data password dari database
        $default = Setting::select('password_user')->first();

        // Ubah password user
        return User::where('id', $request->id)->update([
            'password' => Hash::make($default->password_user),
            'request'  => 'kosong'
        ]);
    }

    public function generateAkunGuru($guru, $userGuru, $passwordUser)
    {
        if ($userGuru->count() == 0) {
            foreach ($guru as $Guru) {
                $userNameGuru = Str::of($Guru->nama_guru)->replace(' ', '');

                $user = User::create([
                    'name'              => $Guru->nama_guru,
                    'username'          => Str::lower($userNameGuru),
                    'email'             => Str::lower($userNameGuru) . '@email.com',
                    'email_verified_at' => now(),
                    'password'          => Hash::make($passwordUser),
                    'role'              => 'guru',
                    'status'            => 'aktif',
                    'request'           => 'kosong',
                    'remember_token'    => Str::random(50)
                ]);

                UserGuru::create([
                    'user_id'           => $user->id,
                    'guru_id'           => $Guru->id,
                    'tahun_akademik_id' => session('tahun_akademik_id')
                ]);
            }
        } else {
            foreach ($guru as $Guru) {
                $GuruId = UserGuru::select('guru_id')->where('guru_id', $Guru->id)->first()?->guru_id;
                if (!$GuruId) {
                    $userNameGuru = Str::of($Guru->nama_guru)->replace(' ', '');

                    $user = User::create([
                        'name'              => $Guru->nama_guru,
                        'username'          => Str::lower($userNameGuru),
                        'email'             => Str::lower($userNameGuru) . '@gmail.com',
                        'email_verified_at' => now(),
                        'password'          => Hash::make($passwordUser),
                        'role'              => 'guru',
                        'status'            => 'aktif',
                        'request'           => 'kosong',
                        'remember_token'    => Str::random(50)
                    ]);

                    UserGuru::create([
                        'user_id'           => $user->id,
                        'guru_id'           => $Guru->id,
                        'tahun_akademik_id' => session('tahun_akademik_id')
                    ]);
                }
            }
        }

        return true;
    }

    public function generateAkunStaff($guru, $userStaff, $passwordUser)
    {
        if ($userStaff->count() == 0) {
            foreach ($guru as $Guru) {
                $userNameGuru = Str::of($Guru->nama_guru)->replace(' ', '');

                $user = User::create([
                    'name'              => $Guru->nama_guru,
                    'username'          => Str::lower($userNameGuru),
                    'email'             => Str::lower($userNameGuru) . '@email.com',
                    'email_verified_at' => now(),
                    'password'          => Hash::make($passwordUser),
                    'role'              => 'staff',
                    'status'            => 'aktif',
                    'request'           => 'kosong',
                    'remember_token'    => Str::random(50)
                ]);

                return UserStaff::create([
                    'user_id'           => $user->id,
                    'staff_id'          => $Guru->id,
                    'tahun_akademik_id' => session('tahun_akademik_id')
                ]);
            }
        } else {
            foreach ($guru as $Guru) {
                $StaffId = UserStaff::select('guru_id')->where('guru_id', $Guru->id)->first()?->guru_id;
                if (!$StaffId) {
                    $userNameGuru = Str::of($Guru->nama_guru)->replace(' ', '');

                    $user = User::create([
                        'name'              => $Guru->nama_guru,
                        'username'          => Str::lower($userNameGuru),
                        'email'             => Str::lower($userNameGuru) . '@gmail.com',
                        'email_verified_at' => now(),
                        'password'          => Hash::make($passwordUser),
                        'role'              => 'staff',
                        'status'            => 'aktif',
                        'request'           => 'kosong',
                        'remember_token'    => Str::random(50)
                    ]);

                    return UserStaff::create([
                        'user_id'           => $user->id,
                        'staff_id'           => $Guru->id,
                        'tahun_akademik_id' => session('tahun_akademik_id')
                    ]);
                }
            }
        }
    }

    public function generateAkunKepsek($guru, $userKepsek, $passwordUser)
    {
        if ($userKepsek->count() == 0) {
            foreach ($guru as $Guru) {
                $userNameGuru = Str::of($Guru->nama_guru)->replace(' ', '');

                $user = User::create([
                    'name'              => $Guru->nama_guru,
                    'username'          => Str::lower($userNameGuru),
                    'email'             => Str::lower($userNameGuru) . '@email.com',
                    'email_verified_at' => now(),
                    'password'          => Hash::make($passwordUser),
                    'role'              => 'kepala-sekolah',
                    'status'            => 'aktif',
                    'request'           => 'kosong',
                    'remember_token'    => Str::random(50)
                ]);

                return UserKepsek::create([
                    'user_id'           => $user->id,
                    'kepsek_id'         => $Guru->id,
                    'tahun_akademik_id' => session('tahun_akademik_id')
                ]);
            }
        } else {
            foreach ($guru as $Guru) {
                $KepsekId = UserKepsek::select('guru_id')->where('guru_id', $Guru->id)->first()?->guru_id;
                if (!$KepsekId) {
                    $userNameGuru = Str::of($Guru->nama_guru)->replace(' ', '');

                    $user = User::create([
                        'name'              => $Guru->nama_guru,
                        'username'          => Str::lower($userNameGuru),
                        'email'             => Str::lower($userNameGuru) . '@email.com',
                        'email_verified_at' => now(),
                        'password'          => Hash::make($passwordUser),
                        'role'              => 'kepala-sekolah',
                        'status'            => 'aktif',
                        'request'           => 'kosong',
                        'remember_token'    => Str::random(50)
                    ]);

                    return UserKepsek::create([
                        'user_id'           => $user->id,
                        'kepsek_id'         => $Guru->id,
                        'tahun_akademik_id' => session('tahun_akademik_id')
                    ]);
                }
            }
        }
    }
}
