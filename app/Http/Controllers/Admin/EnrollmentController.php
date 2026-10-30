<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    private function ensureAdmin(): void
    {
        abort_unless(
            auth()->check() && auth()->user()->role === 'admin',
            403
        );
    }

    public function index(Request $request)
    {
        $this->ensureAdmin();

        $search = $request->input('search');
        $status = $request->input('status');

        $enrollments = Enrollment::with(['student', 'course'])
            ->when($search, function ($query) use ($search) {
                $query->whereHas('student', function ($studentQuery) use ($search) {
                    $studentQuery->where('name', 'like', "%{$search}%")
                        ->orWhere('student_id', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                })->orWhereHas('course', function ($courseQuery) use ($search) {
                    $courseQuery->where('course_code', 'like', "%{$search}%")
                        ->orWhere('course_name', 'like', "%{$search}%");
                });
            })
            ->when($status, function ($query) use ($status) {
                $query->where('status', $status);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $totalEnrollments = Enrollment::count();
        $pendingEnrollments = Enrollment::where('status', 'Pending')->count();
        $approvedEnrollments = Enrollment::where('status', 'Approved')->count();
        $rejectedEnrollments = Enrollment::where('status', 'Rejected')->count();

        return view('admin.enrollments.index', compact(
            'enrollments',
            'search',
            'status',
            'totalEnrollments',
            'pendingEnrollments',
            'approvedEnrollments',
            'rejectedEnrollments'
        ));
    }

    public function updateStatus(Request $request, Enrollment $enrollment)
    {
        $this->ensureAdmin();

        $validated = $request->validate([
            'status' => ['required', 'in:Approved,Rejected'],
        ]);

        $enrollment->update([
            'status' => $validated['status'],
        ]);

        return redirect()
            ->route('admin.enrollments.index')
            ->with('success', 'Enrollment request has been ' . strtolower($validated['status']) . ' successfully.');
    }
}