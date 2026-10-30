<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    private function ensureAdmin(): void
    {
        abort_unless(auth()->user()?->role === 'admin', 403);
    }

    public function index()
    {
        $this->ensureAdmin();

        $students = User::where('role', 'student')
            ->latest()
            ->paginate(10);

        return view('admin.students.index', compact('students'));
    }

    public function create()
    {
        $this->ensureAdmin();

        return view('admin.students.form');
    }

    public function store(Request $request)
    {
        $this->ensureAdmin();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'student_id' => ['required', 'string', 'max:50', 'unique:users,student_id'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        User::create([
            'name' => $validated['name'],
            'student_id' => $validated['student_id'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'student',
        ]);

        return redirect()->route('admin.students.index')
            ->with('success', 'Student added successfully.');
    }

    public function edit(User $student)
    {
        $this->ensureAdmin();

        abort_unless($student->role === 'student', 404);

        return view('admin.students.form', compact('student'));
    }

    public function update(Request $request, User $student)
    {
        $this->ensureAdmin();

        abort_unless($student->role === 'student', 404);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'student_id' => [
                'required',
                'string',
                'max:50',
                Rule::unique('users', 'student_id')->ignore($student->id),
            ],
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($student->id),
            ],
            'password' => ['nullable', 'confirmed', 'min:8'],
        ]);

        $student->name = $validated['name'];
        $student->student_id = $validated['student_id'];
        $student->email = $validated['email'];

        if (!empty($validated['password'])) {
            $student->password = Hash::make($validated['password']);
        }

        $student->save();

        return redirect()->route('admin.students.index')
            ->with('success', 'Student information updated successfully.');
    }

    public function destroy(User $student)
    {
        $this->ensureAdmin();

        abort_unless($student->role === 'student', 404);

        $student->delete();

        return redirect()->route('admin.students.index')
            ->with('success', 'Student deleted successfully.');
    }
}