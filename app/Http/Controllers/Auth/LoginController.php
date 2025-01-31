<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Override the default login attempt method
     */
    protected function attemptLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return false;
        }

        if ($user->status == 0) {
            return false; // Prevent inactive users from logging in
        }

        return Auth::attempt($credentials, $request->filled('remember'));
    }

    /**
     * Override failed login response to show proper validation messages
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return redirect()->back()
                ->withInput($request->only('email'))
                ->with('error', 'Email not found. Please register.');
        }

        if ($user->status == 0) {
            return redirect()->back()
                ->with('error', 'Your account is inactive. Please contact admin.');
        }

        return redirect()->back()
            ->withInput($request->only('email'))
            ->with('error', 'Invalid password.');
    }
}
