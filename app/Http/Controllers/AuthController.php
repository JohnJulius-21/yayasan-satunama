<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // Show the login form
    public function login()
    {
        return view('auth/login', [
            'title' => 'Login'
        ]);
    }

    // Process the login request
    public function loginProcess(Request $request)
    {
        $credentials = $request->only('email', 'password');
    
        // Validate the form input
        $validator = Validator::make($credentials, [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
    
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
    
        // Check if the user exists
        $user = User::where('email', $request->email)->first();
    
        if (!$user) {
            return back()->with('error', 'Kamu belum terdaftar dalam database kami, Ayo daftar dulu.')->withInput();
        }
    
        // Attempt to log the user in
        if (Auth::attempt($credentials)) {
            // Redirect the user to the intended URL or fallback to '/'
            return redirect()->intended('/')->with('success', 'Login berhasil!');
        }
    
        return back()->with('error', 'Email atau Password anda salah!.')->withInput();
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
        // Validate the form input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        // Create the user
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Log the user in
        Auth::attempt($request->only('email', 'password'));

        return redirect()->intended('/masuk')->with('success', 'Registration berhasil! Silahkan log in.');
    }


    // Logout function
    public function logout()
    {
        Auth::logout();
        return redirect()->route('masuk');
    }
}
