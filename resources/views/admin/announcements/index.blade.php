```php
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Announcements | SIRMS</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'DM Sans', sans-serif;
            background: #f4f6fa;
        }

        .announcement-card {
            transition: all 0.2s ease;
        }

        .announcement-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 25px rgba(15, 23, 42, 0.08);
        }
    </style>
</head>

<body class="min-h-screen bg-slate-100">

<div class="min-h-screen flex">

    <!-- SIDEBAR -->
    <aside class="hidden md:flex w-64 bg-slate-950 text-white flex-col shrink-0">

        <div class="p-6 border-b border-slate-800">
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 rounded-xl bg-blue-600 flex items-center justify-center text-2xl font-extrabold">
                    S
                </div>

                <div>
                    <h1 class="text-xl font-extrabold">SIRMS</h1>
                    <p class="text-xs text-slate-400">Administration Portal</p>
                </div>
            </div>
        </div>

        <!-- NAVIGATION -->
        <nav class="p-4 flex-1 space-y-2">

            <p class="text-xs uppercase tracking-widest text-slate-500 font-bold px-3 py-3">
                Main Menu
            </p>

            <a href="{{ route('dashboard') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-300 hover:bg-slate-800 hover:text-white transition">
                <span>▦</span>
                Dashboard
            </a>

            <a href="{{ route('admin.students.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-300 hover:bg-slate-800 hover:text-white transition">
                <span>♙</span>
                Student Management
            </a>

            <a href="{{ route('admin.admins.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-300 hover:bg-slate-800 hover:text-white transition">
                <span>♟</span>
                Admin Management
            </a>

            <a href="{{ route('admin.courses.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-300 hover:bg-slate-800 hover:text-white transition">
                <span>▣</span>
                Course Management
            </a>

            <a href="{{ route('admin.records.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-300 hover:bg-slate-800 hover:text-white transition">
                <span>▤</span>
                Academic Records
            </a>

            <a href="{{ route('admin.announcements.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl bg-blue-600 text-white font-bold shadow-lg shadow-blue-950/30">
                <span>♧</span>
                Announcements
            </a>

            <a href="{{ route('admin.reports.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-300 hover:bg-slate-800 hover:text-white transition">
                <span>▥</span>
                Reports
            </a>
        </nav>

        <!-- LOGOUT -->
        <div class="p-4 border-t border-slate-800">

            <div class="px-4 py-3 mb-2">
                <p class="text-sm font-bold text-white truncate">
                    {{ auth()->user()->name }}
                </p>

                <p class="text-xs text-slate-400">
                    Administrator
                </p>
            </div>

            <form action="{{ route('logout') }}" method="POST">
                @csrf

                <button type="submit"
                        class="w-full text-left px-4 py-3 rounded-xl text-red-300 hover:bg-slate-800 font-semibold transition">
                    ↪ Sign Out
                </button>
            </form>

        </div>

    </aside>

    <!-- MAIN CONTENT -->
    <main class="flex-1 min-w-0">

        <!-- HEADER -->
        <header class="bg-white border-b border-slate-200 px-6 py-5 flex justify-between items-center">

            <div>
                <p class="text-sm text-slate-500">
                    Administration / Announcements
                </p>

                <h2 class="text-xl font-extrabold text-slate-900">
                    Announcements
                </h2>
            </div>

            <div class="flex items-center gap-3">

                <div class="text-right hidden sm:block">
                    <p class="text-sm font-bold text-slate-800">
                        {{ auth()->user()->name }}
                    </p>

                    <p class="text-xs text-blue-600 font-semibold">
                        Administrator
                    </p>
                </div>

                <div class="w-11 h-11 rounded-full bg-blue-900 flex items-center justify-center text-white font-bold">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>

            </div>

        </header>

        <div class="p-6 lg:p-8 max-w-7xl mx-auto">

            <!-- PAGE TITLE -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">

                <div>
                    <h1 class="text-3xl font-extrabold text-slate-900">
                        Announcements
                    </h1>

                    <p class="text-slate-500 mt-2">
                        Create and manage school announcements.
                    </p>
                </div>

                <a href="{{ route('admin.announcements.create') }}"
                   class="bg-blue-700 hover:bg-blue-800 text-white px-5 py-3 rounded-xl font-semibold shadow text-center">
                    + Create Announcement
                </a>

            </div>

            <!-- SUCCESS MESSAGE -->
            @if(session('success'))
                <div class="bg-green-100 border border-green-200 text-green-800 px-5 py-4 rounded-xl mb-6">
                    {{ session('success') }}
                </div>
            @endif

            <!-- ERROR MESSAGE -->
            @if($errors->any())
                <div class="bg-red-100 border border-red-200 text-red-700 px-5 py-4 rounded-xl mb-6">
                    <p class="font-bold mb-2">Please check the following:</p>

                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <!-- STATISTICS -->
            <section class="grid grid-cols-1 sm:grid-cols-3 gap-5 mb-8">

                <div class="announcement-card bg-white rounded-2xl p-6 shadow-sm border border-slate-200">
                    <div class="w-12 h-12 rounded-xl bg-blue-100 text-blue-700 flex items-center justify-center text-2xl">
                        ▧
                    </div>

                    <p class="text-sm text-slate-500 mt-5">
                        Total Announcements
                    </p>

                    <h3 class="text-3xl font-extrabold text-slate-800 mt-2">
                        {{ $totalAnnouncements }}
                    </h3>
                </div>

                <div class="announcement-card bg-white rounded-2xl p-6 shadow-sm border border-slate-200">
                    <div class="w-12 h-12 rounded-xl bg-green-100 text-green-700 flex items-center justify-center text-2xl">
                        ✓
                    </div>

                    <p class="text-sm text-slate-500 mt-5">
                        Published
                    </p>

                    <h3 class="text-3xl font-extrabold text-green-600 mt-2">
                        {{ $publishedCount }}
                    </h3>
                </div>

                <div class="announcement-card bg-white rounded-2xl p-6 shadow-sm border border-slate-200">
                    <div class="w-12 h-12 rounded-xl bg-amber-100 text-amber-600 flex items-center justify-center text-2xl">
                        ▤
                    </div>

                    <p class="text-sm text-slate-500 mt-5">
                        Drafts
                    </p>

                    <h3 class="text-3xl font-extrabold text-amber-500 mt-2">
                        {{ $draftCount }}
                    </h3>
                </div>

            </section>

            <!-- ANNOUNCEMENTS TABLE -->
            <section class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">

                <div class="p-6 border-b border-slate-200">
                    <h3 class="text-lg font-extrabold text-slate-800">
                        All Announcements
                    </h3>

                    <p class="text-sm text-slate-500 mt-1">
                        View and manage your school announcements below.
                    </p>
                </div>

                <div class="overflow-x-auto">

                    <table class="w-full text-left">

                        <thead class="bg-slate-50 text-slate-500 text-xs uppercase tracking-wider">
                            <tr>
                                <th class="px-6 py-4">Announcement</th>
                                <th class="px-6 py-4">Status</th>
                                <th class="px-6 py-4">Date Created</th>
                                <th class="px-6 py-4 text-right">Actions</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-slate-100">

                            @forelse($announcements as $announcement)

                                <tr class="hover:bg-slate-50">

                                    <!-- ANNOUNCEMENT DETAILS -->
                                    <td class="px-6 py-5">
                                        <p class="font-bold text-slate-800">
                                            {{ $announcement->title }}
                                        </p>

                                        <p class="text-sm text-slate-500 mt-1">
                                            {{ \Illuminate\Support\Str::limit($announcement->content, 90) }}
                                        </p>
                                    </td>

                                    <!-- STATUS -->
                                    <td class="px-6 py-5">

                                        @if($announcement->status === 'Published')
                                            <span class="bg-green-100 text-green-700 text-xs font-bold px-3 py-1.5 rounded-full">
                                                Published
                                            </span>
                                        @else
                                            <span class="bg-amber-100 text-amber-700 text-xs font-bold px-3 py-1.5 rounded-full">
                                                Draft
                                            </span>
                                        @endif

                                    </td>

                                    <!-- DATE CREATED -->
                                    <td class="px-6 py-5 text-sm text-slate-500 whitespace-nowrap">
                                        {{ $announcement->created_at->format('M d, Y') }}
                                    </td>

                                    <!-- ACTIONS -->
                                    <td class="px-6 py-5">
                                        <div class="flex justify-end items-center gap-2">

                                            <a href="{{ route('admin.announcements.edit', $announcement) }}"
                                               class="bg-blue-50 text-blue-700 hover:bg-blue-100 px-3 py-2 rounded-lg text-sm font-semibold">
                                                Edit
                                            </a>

                                            <form action="{{ route('admin.announcements.destroy', $announcement) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('Are you sure you want to delete this announcement?')">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                        class="bg-red-50 text-red-600 hover:bg-red-100 px-3 py-2 rounded-lg text-sm font-semibold">
                                                    Delete
                                                </button>

                                            </form>

                                        </div>
                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="4" class="px-6 py-16 text-center">

                                        <div class="text-4xl mb-3">▧</div>

                                        <h3 class="font-extrabold text-slate-700">
                                            No Announcements Yet
                                        </h3>

                                        <p class="text-sm text-slate-500 mt-2">
                                            Create your first school announcement.
                                        </p>

                                        <a href="{{ route('admin.announcements.create') }}"
                                           class="inline-block mt-5 bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-xl font-semibold">
                                            + Create Announcement
                                        </a>

                                    </td>
                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

                <!-- PAGINATION -->
                <div class="p-6 border-t border-slate-200">
                    {{ $announcements->links() }}
                </div>

            </section>

            <!-- FOOTER -->
            <footer class="text-center text-xs text-slate-400 mt-10">
                © {{ date('Y') }} SIRMS Administration Portal. All Rights Reserved.
            </footer>

        </div>

    </main>

</div>

</body>
</html>
```