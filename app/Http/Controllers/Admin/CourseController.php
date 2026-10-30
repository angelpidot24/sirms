<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CourseController extends Controller
{
    private function ensureAdmin(): void
    {
        abort_unless(auth()->user()?->role === 'admin', 403);
    }

    public function index(Request $request)
    {
        $this->ensureAdmin();

        $search = $request->input('search');

        $courses = Course::query()
            ->when($search, function ($query) use ($search) {
                $query->where(function ($subquery) use ($search) {
                    $subquery->where('course_code', 'like', "%{$search}%")
                        ->orWhere('course_name', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $totalCourses = Course::count();

        return view('admin.courses.index', compact(
            'courses',
            'search',
            'totalCourses'
        ));
    }

    public function create()
    {
        $this->ensureAdmin();

        return view('admin.courses.form');
    }

    public function store(Request $request)
    {
        $this->ensureAdmin();

        $validated = $request->validate([
            'course_code' => [
                'required',
                'string',
                'max:50',
                'unique:courses,course_code',
            ],
            'course_name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:2000'],
        ]);

        Course::create($validated);

        return redirect()
            ->route('admin.courses.index')
            ->with('success', 'Course added successfully.');
    }

    public function edit(Course $course)
    {
        $this->ensureAdmin();

        return view('admin.courses.form', compact('course'));
    }

    public function update(Request $request, Course $course)
    {
        $this->ensureAdmin();

        $validated = $request->validate([
            'course_code' => [
                'required',
                'string',
                'max:50',
                Rule::unique('courses', 'course_code')->ignore($course->id),
            ],
            'course_name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:2000'],
        ]);

        $course->update($validated);

        return redirect()
            ->route('admin.courses.index')
            ->with('success', 'Course updated successfully.');
    }

    public function destroy(Course $course)
    {
        $this->ensureAdmin();

        $course->delete();

        return redirect()
            ->route('admin.courses.index')
            ->with('success', 'Course deleted successfully.');
    }
}