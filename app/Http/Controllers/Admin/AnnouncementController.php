<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    private function ensureAdmin()
    {
        abort_unless(auth()->check() && auth()->user()->role === 'admin', 403);
    }

    public function index()
    {
        $this->ensureAdmin();

        $announcements = Announcement::latest()->paginate(10);

        $totalAnnouncements = Announcement::count();
        $publishedCount = Announcement::where('status', 'Published')->count();
        $draftCount = Announcement::where('status', 'Draft')->count();

        return view('admin.announcements.index', compact(
            'announcements',
            'totalAnnouncements',
            'publishedCount',
            'draftCount'
        ));
    }

    public function create()
    {
        $this->ensureAdmin();

        return view('admin.announcements.form', [
            'announcement' => new Announcement()
        ]);
    }

    public function store(Request $request)
    {
        $this->ensureAdmin();

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'status' => 'required|in:Draft,Published',
        ]);

        $validated['created_by'] = auth()->id();
        $validated['published_at'] = $validated['status'] === 'Published'
            ? now()
            : null;

        Announcement::create($validated);

        return redirect()->route('admin.announcements.index')
            ->with('success', 'Announcement created successfully.');
    }

    public function edit(Announcement $announcement)
    {
        $this->ensureAdmin();

        return view('admin.announcements.form', compact('announcement'));
    }

    public function update(Request $request, Announcement $announcement)
    {
        $this->ensureAdmin();

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'status' => 'required|in:Draft,Published',
        ]);

        if ($validated['status'] === 'Published') {
            $validated['published_at'] = $announcement->published_at ?? now();
        } else {
            $validated['published_at'] = null;
        }

        $announcement->update($validated);

        return redirect()->route('admin.announcements.index')
            ->with('success', 'Announcement updated successfully.');
    }

    public function destroy(Announcement $announcement)
    {
        $this->ensureAdmin();

        $announcement->delete();

        return redirect()->route('admin.announcements.index')
            ->with('success', 'Announcement deleted successfully.');
    }
}