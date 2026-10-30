<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AcademicRecord;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;

class AcademicRecordController extends Controller
{
    private function ensureAdmin(): void
    {
        abort_unless(auth()->user()?->role === 'admin', 403);
    }

    public function index(Request $request)
    {
        $this->ensureAdmin();

        $search = $request->input('search');

        $records = AcademicRecord::with(['student', 'course'])
            ->when($search, function ($query) use ($search) {
                $query->where(function ($subquery) use ($search) {
                    $subquery->where('academic_year', 'like', "%{$search}%")
                        ->orWhere('semester', 'like', "%{$search}%")
                        ->orWhereHas('student', function ($studentQuery) use ($search) {
                            $studentQuery->where('name', 'like', "%{$search}%")
                                ->orWhere('student_id', 'like', "%{$search}%");
                        })
                        ->orWhereHas('course', function ($courseQuery) use ($search) {
                            $courseQuery->where('course_code', 'like', "%{$search}%")
                                ->orWhere('course_name', 'like', "%{$search}%");
                        });
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $totalRecords = AcademicRecord::count();

        return view('admin.records.index', compact(
            'records',
            'search',
            'totalRecords'
        ));
    }

    public function create()
    {
        $this->ensureAdmin();

        $students = User::where('role', 'student')->orderBy('name')->get();
        $courses = Course::orderBy('course_name')->get();

        return view('admin.records.form', compact('students', 'courses'));
    }

    public function store(Request $request)
    {
        $this->ensureAdmin();

        $validated = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'course_id' => ['required', 'exists:courses,id'],
            'academic_year' => ['required', 'string', 'max:20'],
            'semester' => ['required', 'in:1st Semester,2nd Semester,Summer'],
            'grade' => ['nullable', 'numeric', 'min:0', 'max:100'],
            'remarks' => ['nullable', 'string', 'max:2000'],
        ]);

        if (User::findOrFail($validated['user_id'])->role !== 'student') {
            return back()->withErrors([
                'user_id' => 'Please select a valid student account.',
            ])->withInput();
        }

        AcademicRecord::create($validated);

        return redirect()->route('admin.records.index')
            ->with('success', 'Academic record added successfully.');
    }

    public function edit(AcademicRecord $record)
    {
        $this->ensureAdmin();

        $students = User::where('role', 'student')->orderBy('name')->get();
        $courses = Course::orderBy('course_name')->get();

        return view('admin.records.form', compact(
            'record',
            'students',
            'courses'
        ));
    }

    public function update(Request $request, AcademicRecord $record)
    {
        $this->ensureAdmin();

        $validated = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'course_id' => ['required', 'exists:courses,id'],
            'academic_year' => ['required', 'string', 'max:20'],
            'semester' => ['required', 'in:1st Semester,2nd Semester,Summer'],
            'grade' => ['nullable', 'numeric', 'min:0', 'max:100'],
            'remarks' => ['nullable', 'string', 'max:2000'],
        ]);

        if (User::findOrFail($validated['user_id'])->role !== 'student') {
            return back()->withErrors([
                'user_id' => 'Please select a valid student account.',
            ])->withInput();
        }

        $record->update($validated);

        return redirect()->route('admin.records.index')
            ->with('success', 'Academic record updated successfully.');
    }

    public function destroy(AcademicRecord $record)
    {
        $this->ensureAdmin();

        $record->delete();

        return redirect()->route('admin.records.index')
            ->with('success', 'Academic record deleted successfully.');
    }
}
