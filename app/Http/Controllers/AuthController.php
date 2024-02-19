<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index(): Response
    {
        return response()
            ->view('index', [
                "title" => "Login"
            ]);
    }

    public function cek_login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
        // Authentication passed
        return redirect()->intended('/home');
        }

        return redirect('/')->withErrors(['email' => 'Invalid credentials']);
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }
}
