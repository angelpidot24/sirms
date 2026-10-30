<?php

namespace App\Http\Controllers;

use App\Models\AcademicRecord;

class StudentAcademicRecordController extends Controller
{
    public function index()
    {
        abort_unless(
            auth()->check() && auth()->user()->role === 'student',
            403
        );

        $studentId = auth()->id();

        $records = AcademicRecord::with('course')
            ->where('user_id', $studentId)
            ->latest()
            ->paginate(10);

        $totalRecords = AcademicRecord::where('user_id', $studentId)
            ->count();

        $gradedRecords = AcademicRecord::where('user_id', $studentId)
            ->whereNotNull('grade')
            ->count();

        $averageGrade = AcademicRecord::where('user_id', $studentId)
            ->whereNotNull('grade')
            ->avg('grade');

        return view('students.records', compact(
            'records',
            'totalRecords',
            'gradedRecords',
            'averageGrade'
        ));
    }
}