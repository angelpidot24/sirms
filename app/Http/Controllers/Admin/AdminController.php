<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    private function ensureAdmin(): void
    {
        abort_unless(auth()->user()?->role === 'admin', 403);
    }

    public function index()
    {
        $this->ensureAdmin();

        $admins = User::where('role', 'admin')
            ->latest()
            ->paginate(10);

        return view('admin.admins.index', compact('admins'));
    }

    public function create()
    {
        $this->ensureAdmin();

        return view('admin.admins.form');
    }

    public function store(Request $request)
    {
        $this->ensureAdmin();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'admin',
            'student_id' => null,
        ]);

        return redirect()->route('admin.admins.index')
            ->with('success', 'Administrator account created successfully.');
    }

    public function edit(User $admin)
    {
        $this->ensureAdmin();

        abort_unless($admin->role === 'admin', 404);

        return view('admin.admins.form', compact('admin'));
    }

    public function update(Request $request, User $admin)
    {
        $this->ensureAdmin();

        abort_unless($admin->role === 'admin', 404);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($admin->id),
            ],
            'password' => ['nullable', 'confirmed', 'min:8'],
        ]);

        $admin->name = $validated['name'];
        $admin->email = $validated['email'];

        if (!empty($validated['password'])) {
            $admin->password = Hash::make($validated['password']);
        }

        $admin->save();

        return redirect()->route('admin.admins.index')
            ->with('success', 'Administrator information updated successfully.');
    }

    public function destroy(User $admin)
    {
        $this->ensureAdmin();

        abort_unless($admin->role === 'admin', 404);

        if ($admin->id === auth()->id()) {
            return back()->with('error', 'You cannot delete the administrator account you are currently using.');
        }

        $admin->delete();

        return redirect()->route('admin.admins.index')
            ->with('success', 'Administrator account deleted successfully.');
    }
}