<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    // SHOW LOGIN PAGE
    public function create(): View
    {
        return view('auth.login');
    }

    // PROCESS LOGIN
    public function store(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $remember = $request->boolean('remember');

        if (!Auth::attempt($credentials, $remember)) {

            throw ValidationException::withMessages([
                'email' => 'The provided email or password is incorrect.',
            ]);

        }

        $request->session()->regenerate();

        $user = Auth::user();

        // ADMIN REDIRECTION
        if ($user->role === 'admin') {
            return redirect()->intended(route('dashboard'));
        }

        // STUDENT REDIRECTION
        if ($user->role === 'student') {
            return redirect()->route('student.dashboard');
        }

        // UNAUTHORIZED ROLE
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->withErrors([
                'email' => 'Your account does not have an authorized role.',
            ]);
    }

    // LOGOUT
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
