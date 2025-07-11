<?php
namespace App\Http\Controllers;

use Throwable;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Password;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Validator;
use Illuminate\Notifications\Messages\MailMessage;

class AuthController extends Controller
{
    // Show the login form
    public function login()
    {
        return view('auth/login', [
            'title' => 'Login'
        ]);
    }

    public function redirectToGoogle()
    {
        Session::put('url.intended', url()->previous());
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            // Get the user information from Google
            $user = Socialite::driver('google')->user();
        } catch (Throwable $e) {
            return redirect()->route('masuk')->with('error', 'Google authentication failed.');
        }

        // Check if the user exists by google_id first
        $existingUser = User::where('email', $user->email)->first();


        if ($existingUser) {
            // Log the user in if they already exist
            Auth::login($existingUser);
        } else {
            // Otherwise, create a new user and log them in
            $newUser = User::updateOrCreate([
                'email' => $user->email
            ], [
                'name' => $user->name,
                'password' => bcrypt('stc123456'), // Set a random password
                'roles' => 'peserta'
            ]);
            Auth::login($newUser);
        }

        // Redirect the user to the dashboard or any other secure page
        return redirect()->intended(route('beranda'));

    }

    // Process the login request
    public function loginProcess(Request $request)
    {
        $credentials = $request->only('login', 'password');

        $validator = Validator::make($credentials, [
            'login' => 'required|string',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Cek apakah input adalah email atau username
        $login_type = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        // Cek user berdasarkan email atau username
        $user = User::where($login_type, $request->login)->first();
        if (!$user) {
            return back()->with('error', 'Kamu belum terdaftar, ayo daftar dulu.')->withInput();
        }

        if ($user->roles !== 'peserta') {
            return back()->with('error', 'Anda tidak memiliki akses, silakan login sebagai admin.')->withInput();
        }

        // Lakukan login
        if (Auth::attempt([$login_type => $request->login, 'password' => $request->password])) {
            return redirect($request->input('redirect_to', route('beranda')))
                ->with('success', 'Login berhasil!');
        }

        return back()->with('error', 'Email/Username atau Password salah!')->withInput();
    }






    // Show the registration form
    public function register()
    {
        return view('auth/register', [
            'title' => 'Register'
        ]);
    }

    // Process the registration request
    public function registerProcess(Request $request)
    {
        // Validasi input form
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
        ], [
            'name.required' => 'Nama wajib diisi.',
            'name.string' => 'Nama harus berupa teks.',
            'name.max' => 'Nama tidak boleh lebih dari 255 karakter.',

            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',

            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password harus terdiri dari minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak sesuai.',
        ]);

        // Buat user baru
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'roles' => 'peserta',
            'password' => Hash::make($request->password),
        ]);

        // Simpan redirect ke sesi jika tersedia
        if ($request->filled('redirect_to')) {
            session(['url.intended' => $request->redirect_to]);
        }


        // Redirect ke halaman daftar (agar modal login muncul) + redirect fallback ke halaman sebelumnya jika nanti login berhasil
        return redirect()
            ->route('daftar')
            ->with('show_login_modal', true)
            ->with('success', 'Registrasi berhasil! Silakan login.');
    }


    // Menampilkan form login admin
    public function adminLogin()
    {
        return view('auth/admin-login', [
            'title' => 'Admin Login'
        ]);
    }

    // Proses login admin
    public function adminLoginProcess(Request $request)
    {
        // dd($request->all());
        $credentials = $request->only('username', 'password');

        // Validasi input
        $validator = Validator::make(
            $credentials,
            [
                'username' => 'required',
                'password' => 'required|min:8',
            ],
            [
                'username.required' => 'Kolom username harus diisi',
                'password.required' => 'Kolom password harus diisi',
                'password.min' => 'Kolom password harus berisi 8 karakter',
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Cek apakah user ada di database dan apakah dia admin
        $user = User::where('username', $request->username)->first();

        if (!$user) {
            return back()->with('error', 'Akun tidak ditemukan.')->withInput();
        }

        if ($user->roles !== 'admin') {
            return back()->with('error', 'Anda tidak memiliki akses admin.')->withInput();
        }

        // Coba login
        if (Auth::attempt($credentials)) {
            return redirect()->route('indexAdmin')->with('success', 'Selamat Datang, Admin!');
        }

        return back()->with('error', 'Username atau Password salah!')->withInput();
    }

    // Tampilkan form minta reset password
    // Menampilkan form input username/email
    public function showResetForm()
    {
        return view('auth.forgot-password');
    }

    // Mengecek username/email, lalu tampilkan form ubah password
    public function checkUsername(Request $request)
    {
        $request->validate([
            'username' => 'required'
        ]);

        $user = User::where('username', $request->username)
            ->orWhere('email', $request->username)
            ->first();

        if (!$user) {
            return back()->with('error', 'Username/Email tidak ditemukan.');
        }

        return view('auth.reset-password', ['user' => $user]);
    }

    // Update password-nya langsung
    public function resetPasswordManual(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'password' => 'required|min:6|confirmed'
        ]);

        $user = User::find($request->id);
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('adminLogin')->with('success', 'Password berhasil diubah.');
    }

    // Show forgot password form
    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    // Send reset link to user's email
    public function sendResetLink(Request $request)
    {
        $request->validate([
            'no_hp' => 'required',
        ], [
            'no_hp.required' => 'Nomor WhatsApp wajib diisi.',
        ]);

        // Normalisasi nomor HP jadi format internasional (ganti 08 jadi 628)
        $inputNumber = preg_replace('/[^0-9]/', '', $request->no_hp);
        $normalizedNumber = preg_replace('/^0/', '62', $inputNumber);

        // Cari user berdasarkan no_hp
        $user = User::where('no_hp', $normalizedNumber)->first();

        if (!$user) {
            return back()->withErrors(['no_hp' => 'Nomor WhatsApp tidak ditemukan.']);
        }

        // Buat token reset
        $token = Password::createToken($user);

        // Rakit link reset
        $resetLink = url(route('password.reset', [
            'token' => $token,
            'email' => $user->email,
        ], false));

        // Isi pesan WhatsApp
        $message = "*Halo {$user->name}!* 👋\n"
            . "Gunakan link berikut untuk mengganti password akun Anda:\n\n"
            . "{$resetLink}\n\n"
            . "_Link hanya berlaku selama 60 menit._";

        // Kirim ke Fonnte
        $resp = Http::withHeaders([
            'Authorization' => env('FONNTE_TOKEN'),
        ])->asForm()->post('https://api.fonnte.com/send', [
                    'target' => $normalizedNumber,
                    'message' => $message,
                ]);

        if ($resp->successful() && ($resp->json()['status'] ?? false)) {
            return back()->with('success', 'Link reset password telah dikirim ke WhatsApp Anda.');
        }

        return back()->with('error', 'Gagal mengirim WhatsApp. Silakan coba lagi.');

    }

    // Show reset password form
    public function showResetPasswordForm($token)
    {
        return view('auth.reset-password-user', ['token' => $token]);
    }

    // Handle reset password
    public function resetPassword(Request $request)
    {
        // Validate the form inputs
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
            'token' => 'required',
        ]);

        // Attempt to reset the password
        $response = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => bcrypt($password),
                ])->save();
            }
        );

        // Check the response
        if ($response == Password::PASSWORD_RESET) {
            return redirect()->route('beranda')->with('status', 'Password berhasil direset. Silakan login.');
        } else {
            return back()->withErrors(['email' => 'Link reset password tidak valid.']);
        }
    }



    // Logout function
    public function logout(Request $request)
    {
        if (Auth::check()) {
            $user = Auth::user(); // Ambil user yang sedang login
            Auth::logout(); // Logout user

            // Hapus sesi dan regenerasi token untuk keamanan
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            // Redirect berdasarkan role dengan pesan sukses
            if ($user->roles === 'admin') {
                return redirect('/admin/login')->with('success', 'Logout berhasil.');
            } else {
                return redirect('/')->with('success', 'Anda berhasil logout.');
            }
        }

        // Jika sesi sudah habis, redirect dengan pesan error berdasarkan role
        $intendedUrl = $request->is('admin/*') ? '/admin/login' : '/masuk';
        return redirect($intendedUrl)->with('error', 'Sesi Anda telah berakhir, silakan login kembali.');
    }


}
