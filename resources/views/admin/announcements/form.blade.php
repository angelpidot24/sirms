<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $announcement->exists ? 'Edit' : 'Create' }} Announcement | SIRMS</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'DM Sans', sans-serif; background: #f4f6fa; }
        .sidebar { width: 250px; min-height: 100vh; background: #111c35; }
        .nav-link { display: block; padding: 12px 15px; border-radius: 10px; color: #bdc8dc; margin-bottom: 5px; }
        .nav-link:hover, .nav-active { background: #263858; color: white; }
        .main { margin-left: 250px; }
        @media(max-width: 800px) {
            .sidebar { width: 100%; min-height: auto; }
            .main { margin-left: 0; }
            .app-layout { display: block !important; }
        }
    </style>
</head>
<body>

<div class="app-layout flex">
    <aside class="sidebar text-white p-6">
        <h1 class="text-2xl font-extrabold">SIRMS</h1>
        <p class="text-xs text-slate-400 mt-1 mb-10">ADMINISTRATION PANEL</p>

        <nav>
            <a href="{{ route('dashboard') }}" class="nav-link">▦ Dashboard</a>
            <a href="{{ route('admin.students.index') }}" class="nav-link">♙ Student Management</a>
            <a href="{{ route('admin.admins.index') }}" class="nav-link">♧ Admin Management</a>
            <a href="{{ route('admin.courses.index') }}" class="nav-link">▤ Course Management</a>
            <a href="{{ route('admin.records.index') }}" class="nav-link">▣ Academic Records</a>
            <a href="{{ route('admin.announcements.index') }}" class="nav-link nav-active">▧ Announcements</a>
        </nav>

        <div class="mt-10 border-t border-slate-700 pt-5">
            <p class="text-sm font-semibold">{{ auth()->user()->name }}</p>
            <p class="text-xs text-slate-400">Administrator</p>
            <form action="{{ route('logout') }}" method="POST" class="mt-5">
                @csrf
                <button class="text-sm text-red-300">↪ Logout</button>
            </form>
        </div>
    </aside>

    <main class="main flex-1 min-w-0 p-6 md:p-10">
        <div class="mb-8">
            <a href="{{ route('admin.announcements.index') }}" class="text-sm text-blue-700 font-semibold">
                ← Back to Announcements
            </a>
            <h2 class="text-3xl font-extrabold text-slate-800 mt-4">
                {{ $announcement->exists ? 'Edit Announcement' : 'Create Announcement' }}
            </h2>
            <p class="text-slate-500 mt-1">Fill in the announcement details below.</p>
        </div>

        @if($errors->any())
            <div class="bg-red-100 text-red-700 p-4 rounded-xl mb-6">
                <p class="font-bold mb-2">Please correct the following:</p>
                <ul class="list-disc ml-5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <section class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 md:p-8 max-w-4xl">
            <form
                action="{{ $announcement->exists
                    ? route('admin.announcements.update', $announcement)
                    : route('admin.announcements.store') }}"
                method="POST"
            >
                @csrf
                @if($announcement->exists)
                    @method('PUT')
                @endif

                <div class="mb-6">
                    <label class="block text-sm font-bold text-slate-700 mb-2">Announcement Title</label>
                    <input
                        type="text"
                        name="title"
                        value="{{ old('title', $announcement->title) }}"
                        placeholder="Enter announcement title"
                        required
                        class="w-full border border-slate-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                    @error('title')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-bold text-slate-700 mb-2">Announcement Content</label>
                    <textarea
                        name="content"
                        rows="9"
                        placeholder="Write your announcement here..."
                        required
                        class="w-full border border-slate-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >{{ old('content', $announcement->content) }}</textarea>
                    @error('content')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-8">
                    <label class="block text-sm font-bold text-slate-700 mb-2">Publication Status</label>
                    <select
                        name="status"
                        required
                        class="w-full border border-slate-300 rounded-xl px-4 py-3 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                        <option value="Draft" {{ old('status', $announcement->status ?: 'Draft') === 'Draft' ? 'selected' : '' }}>
                            Save as Draft
                        </option>
                        <option value="Published" {{ old('status', $announcement->status) === 'Published' ? 'selected' : '' }}>
                            Publish Announcement
                        </option>
                    </select>
                    @error('status')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex flex-wrap gap-3">
                    <button type="submit" class="bg-blue-700 hover:bg-blue-800 text-white px-6 py-3 rounded-xl font-bold">
                        {{ $announcement->exists ? 'Update Announcement' : 'Save Announcement' }}
                    </button>

                    <a href="{{ route('admin.announcements.index') }}"
                       class="bg-slate-100 hover:bg-slate-200 text-slate-700 px-6 py-3 rounded-xl font-bold">
                        Cancel
                    </a>
                </div>
            </form>
        </section>
    </main>
</div>

</body>
</html>