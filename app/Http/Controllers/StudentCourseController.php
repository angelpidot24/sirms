<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Http\Request;

class StudentCourseController extends Controller
{
    private function ensureStudent(): void
    {
        abort_unless(
            auth()->check() && auth()->user()->role === 'student',
            403
        );
    }

    public function index(Request $request)
    {
        $this->ensureStudent();

        $studentId = auth()->id();

        $search = $request->input('search');

        $courses = Course::with([
            'enrollments' => function ($query) use ($studentId) {
                $query->where('user_id', $studentId);
            }
        ])
        ->when($search, function ($query) use ($search) {
            $query->where(function ($subQuery) use ($search) {
                $subQuery->where('course_code', 'like', "%{$search}%")
                    ->orWhere('course_name', 'like', "%{$search}%");
            });
        })
        ->orderBy('course_name')
        ->paginate(9)
        ->withQueryString();

        $myEnrollments = Enrollment::with('course')
            ->where('user_id', $studentId)
            ->latest()
            ->get();

        $totalCourses = Course::count();

        $totalEnrollments = Enrollment::where('user_id', $studentId)
            ->count();

        $approvedEnrollments = Enrollment::where('user_id', $studentId)
            ->where('status', 'Approved')
            ->count();

        return view('students.courses', compact(
            'courses',
            'myEnrollments',
            'totalCourses',
            'totalEnrollments',
            'approvedEnrollments',
            'search'
        ));
    }

    public function enroll(Course $course)
    {
        $this->ensureStudent();

        $studentId = auth()->id();

        $existingEnrollment = Enrollment::where('user_id', $studentId)
            ->where('course_id', $course->id)
            ->first();

        if ($existingEnrollment) {
            return back()->with(
                'error',
                'You have already submitted an enrollment request for this course.'
            );
        }

        Enrollment::create([
            'user_id' => $studentId,
            'course_id' => $course->id,
            'status' => 'Pending',
        ]);

        return back()->with(
            'success',
            'Your enrollment request has been submitted successfully. Please wait for administrator approval.'
        );
    }

    public function cancel(Enrollment $enrollment)
    {
        $this->ensureStudent();

        abort_unless(
            $enrollment->user_id === auth()->id(),
            403
        );

        if ($enrollment->status !== 'Pending') {
            return back()->with(
                'error',
                'Only pending enrollment requests can be cancelled.'
            );
        }

        $enrollment->delete();

        return back()->with(
            'success',
            'Your enrollment request has been cancelled.'
        );
    }
}
