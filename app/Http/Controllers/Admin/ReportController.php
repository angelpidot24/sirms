<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Course;
use App\Models\AcademicRecord;

class ReportController extends Controller
{
    private function ensureAdmin()
    {
        abort_unless(
            auth()->check() && auth()->user()->role === 'admin',
            403
        );
    }

    public function index()
    {
        $this->ensureAdmin();

        $totalStudents = User::where('role', 'student')->count();

        $totalAdmins = User::where('role', 'admin')->count();

        $totalCourses = Course::count();

        $totalRecords = AcademicRecord::count();

        $gradedRecords = AcademicRecord::whereNotNull('grade')->count();

        $averageGrade = AcademicRecord::whereNotNull('grade')->avg('grade');

        $records = AcademicRecord::with(['student', 'course'])
            ->latest()
            ->paginate(15);

        return view('admin.reports.index', compact(
            'totalStudents',
            'totalAdmins',
            'totalCourses',
            'totalRecords',
            'gradedRecords',
            'averageGrade',
            'records'
        ));
    }
}
