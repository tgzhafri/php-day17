<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

/**
 * @group Authentication
 *
 * API endpoints for managing authentication
 */
class AuthController extends Controller
{
    /**
     * Log in the user.
     *
     * @bodyParam   email    string  required    The email of the  user.      Example: testuser@example.com
     * @bodyParam   password    string  required    The password of the  user.   Example: secret
     *
     * @response {
     *  "access_token": "{{$jwt_token}}",
     *  "token_type": "Bearer",
     * }
     */
    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $credentials = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);

            if (Auth::attempt($credentials)) {
                if (Auth::user()->role == 1) {
                    $request->session()->regenerate();
                    $jwt_token = JWTAuth::attempt($credentials);
                    session(['jwt_token' => $jwt_token]); // authenticate the token and save into the session

                    return redirect()->route('admin.dashboard');
                } else {
                    return redirect('/');
                }
            }

            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);
        }

        return view('admin.login');
    }
    public function logout()
    {
        if (Auth::check()) {
            Auth::logout();
        }
        return redirect('/admin');
    }
}
