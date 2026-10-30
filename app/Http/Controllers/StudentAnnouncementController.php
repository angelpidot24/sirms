<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;

class StudentAnnouncementController extends Controller
{
    public function index(Request $request)
    {
        abort_unless(
            auth()->check() && auth()->user()->role === 'student',
            403
        );

        $search = $request->input('search');

        $announcements = Announcement::where('status', 'Published')
            ->when($search, function ($query) use ($search) {
                $query->where(function ($subQuery) use ($search) {
                    $subQuery->where('title', 'like', "%{$search}%")
                        ->orWhere('content', 'like', "%{$search}%");
                });
            })
            ->orderByDesc('published_at')
            ->orderByDesc('created_at')
            ->paginate(6)
            ->withQueryString();

        $totalAnnouncements = Announcement::where('status', 'Published')->count();

        return view('students.announcements', compact(
            'announcements',
            'totalAnnouncements',
            'search'
        ));
    }
}