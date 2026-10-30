<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class StudentProfileController extends Controller
{
    private function ensureStudent()
    {
        abort_unless(
            auth()->check() && auth()->user()->role === 'student',
            403
        );
    }

    public function index()
    {
        $this->ensureStudent();

        return view('students.profile');
    }

    public function update(Request $request)
    {
        $this->ensureStudent();

        $user = auth()->user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email,' . $user->id,
            ],
            'profile_photo' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
        ]);

        if ($request->hasFile('profile_photo')) {
            $validated['profile_photo_path'] = $request
                ->file('profile_photo')
                ->store('profile-photos', 'public');
        }

        unset($validated['profile_photo']);

        $user->update($validated);

        return back()->with('success', 'Your profile has been updated successfully.');
    }

    public function updatePassword(Request $request)
    {
        $this->ensureStudent();

        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => [
                'required',
                'confirmed',
                Password::min(8),
            ],
        ]);

        auth()->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('password_success', 'Your password has been changed successfully.');
    }
}