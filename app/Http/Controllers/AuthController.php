<?php

namespace App\Http\Controllers;

// use App\Models\TahunAkademik;
use App\Models\User;
use App\Models\TahunAjar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /** 
     * Index 
     */
    public function index()
    {
        return view('index', [
            'tahunAjar' => TahunAjar::select('id', 'tahun_ajar', 'semester')->where('status', 1)->latest('tahun_ajar')->get()
        ]);
    }

    /** 
     * Validasi  
     */
    public function validasi(Request $request)
    {

        //======== Remember Me ========//
        $remember = $request->remember ? true : false;

        //======== 1. Menyimpan dan validasi data dari form login ========//
        $login = $request->validate([
            'username'       => 'required',
            'password'       => 'required',
        ], [
            'required'   => ':attribute wajib diisi!'
        ]);

        //======== 2. Mengambil data dari database berdasarkan username ========//
        $user = User::select('username', 'password', 'status', 'role')->where('username', $request->username)->first();

        //======== 3. Validasi data username dari type data null ========//
        $username = $user->username ?? null;

        //======== 4. Validasi data lanjutan ========//
        if ($username === null) {

            // Kembali ke halaman login
            return redirect('/')->with('gagal', 'Email atau Password anda belum benar!');
        } else {

            // 5. Validasi password
            if (Hash::check($request->password, $user->password)) {

                if ($user->status === 'aktif') {

                    // Ambil data dari tabel Tahun Ajar
                    $tahunAjar = TahunAjar::select('tahun_ajar', 'semester')
                        ->where('id', $request->tahun_ajar_id)
                        ->first();

                    // Buat session
                    $request->session()->put('tahun_ajar_id', $request->tahun_ajar_id);
                    $request->session()->put('tahun_ajar', $tahunAjar->tahun_ajar);
                    $request->session()->put('semester', $tahunAjar->semester);

                    switch ($user->role) {
                        // Menu Admin
                        case 'admin':
                            if (Auth::attempt($login, $remember)) {

                                // Generate Session
                                $request->session()->regenerate();

                                // Dialihkan ke halaman admin
                                return redirect()->intended('/beranda');
                            }
                            break;
                        // Menu Guru
                        case 'guru':
                            if (Auth::attempt($login, $remember)) {

                                // Generate Session
                                $request->session()->regenerate();

                                // Dialihkan ke halaman guru
                                return redirect()->intended('/beranda');
                            }
                            break;
                        // Menu Staff
                        case 'staff':
                            if (Auth::attempt($login, $remember)) {

                                // Generate Session
                                $request->session()->regenerate();

                                // Dialihkan ke halaman staff
                                return redirect()->intended('/beranda');
                            }
                            break;

                        // Menu Kepala Sekolah
                        default:
                            if (Auth::attempt($login, $remember)) {

                                // Generate Session
                                $request->session()->regenerate();

                                // Dialihkan ke halaman Kepala Sekolah
                                return redirect()->intended('/beranda');
                            }
                            break;
                    }
                } else {

                    // Kembali ke halaman login
                    return redirect('/')->with('gagal', 'Maaf akun anda tidak aktif, silakan hubungi admin!');
                }
            } else {

                // Kembali ke halaman login
                return redirect('/')->with('gagal', 'Email atau Password anda belum benar!');
            }
        }
    }

    /** 
     * Logout 
     */
    public function logout(Request $request)
    {
        // User di logout
        Auth::logout();

        // Menghapus session
        $request->session()->invalidate();

        // Membuat ulang token session
        $request->session()->regenerateToken();

        // Dialihkan ke halaman login
        return redirect('/');
    }

    /** 
     * Reset Password 
     */
    //======== Halaman reset password ========//
    function resetPassword()
    {
        return view('resetPassword');
    }

    //======== Proses validasi password ========//
    function validasiPassword()
    {
        // Validasi data dari form
        $data = request()->validate([
            'valid' => 'required'
        ]);

        // Ambil data user dari database
        $user = User::select('id', 'request')->where('username', $data)->orWhere('email', $data)->first();

        // Jika data user ada
        if ($user) {

            // Maka lakukan proses dibawah ini
            // .
            // .
            // Jika request dari user bernilai 'true'
            if ($user->request == 'true') {

                // Maka alihkan ke halaman login dengan informasi tertera
                return redirect('/')->with('info', 'Anda sebelumnya sudah melakukan request <b> reset password </b>!  <br> Silakan tunggu informasi dari administrator lalu login kembali!');

                // Dan jika tidak
            } else {

                // Ambil data user dari database
                User::where('id', $user->id)->update(['request' => 'true']);

                // Maka alihkan ke halaman login dengan informasi tertera
                return redirect('/')->with('info', 'Request <b> reset password </b> berhasil!  <br> Silakan tunggu informasi dari administrator lalu login kembali!');
            }

            // Dan jika tidak
        } else {

            // Maka alihkan ke halaman reset password
            return redirect()->route('resetPassword')->with('info', 'User tidak terdaftar!');
        }
    }
}
