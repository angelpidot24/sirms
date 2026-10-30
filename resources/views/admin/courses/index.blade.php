<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Management | SIRMS</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'DM Sans', sans-serif;
        }

        .module-card {
            transition: all 0.2s ease;
        }

        .module-card:hover {
            transform: translateY(-2px);
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
               class="flex items-center gap-3 px-4 py-3 rounded-xl bg-blue-600 text-white font-bold shadow-lg shadow-blue-950/30">
                <span>▣</span>
                Course Management
            </a>

            <a href="{{ route('admin.records.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-300 hover:bg-slate-800 hover:text-white transition">
                <span>▤</span>
                Academic Records
            </a>

            <a href="{{ route('admin.announcements.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-300 hover:bg-slate-800 hover:text-white transition">
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

            <form method="POST" action="{{ route('logout') }}">
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
                    Administration / Course Management
                </p>

                <h2 class="text-xl font-extrabold text-slate-900">
                    Course Management
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
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-7">

                <div>
                    <h1 class="text-3xl font-extrabold text-slate-900">
                        Courses
                    </h1>

                    <p class="text-slate-500 mt-2">
                        Manage course information and academic programs.
                    </p>
                </div>

                <a href="{{ route('admin.courses.create') }}"
                   class="inline-flex items-center justify-center gap-2 bg-blue-700 hover:bg-blue-800 text-white px-5 py-3 rounded-xl font-bold shadow-sm">
                    <span class="text-xl">+</span>
                    Add Course
                </a>

            </div>

            <!-- SUCCESS MESSAGE -->
            @if(session('success'))
                <div class="mb-6 rounded-xl border border-green-200 bg-green-50 p-4 text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            <!-- ERROR MESSAGE -->
            @if(session('error'))
                <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4 text-red-800">
                    {{ session('error') }}
                </div>
            @endif

            <!-- VALIDATION ERRORS -->
            @if($errors->any())
                <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4 text-red-800">
                    <p class="font-bold mb-2">Please check the following:</p>

                    <ul class="list-disc pl-5 space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- STATISTICS -->
            <div class="grid sm:grid-cols-2 gap-5 mb-7">

                <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm">
                    <div class="flex justify-between items-center">

                        <div>
                            <p class="text-sm text-slate-500">Total Courses</p>

                            <h3 class="text-3xl font-extrabold text-slate-900 mt-2">
                                {{ $totalCourses }}
                            </h3>
                        </div>

                        <div class="w-14 h-14 bg-blue-100 text-blue-700 rounded-xl flex items-center justify-center text-2xl">
                            ▣
                        </div>

                    </div>
                </div>

                <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm">
                    <div class="flex justify-between items-center">

                        <div>
                            <p class="text-sm text-slate-500">Matching Results</p>

                            <h3 class="text-3xl font-extrabold text-slate-900 mt-2">
                                {{ $courses->total() }}
                            </h3>
                        </div>

                        <div class="w-14 h-14 bg-indigo-100 text-indigo-700 rounded-xl flex items-center justify-center text-2xl">
                            ⌕
                        </div>

                    </div>
                </div>

            </div>

            <!-- COURSE DIRECTORY -->
            <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">

                <div class="p-6 border-b border-slate-200">

                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">

                        <div>
                            <h2 class="text-lg font-extrabold text-slate-900">
                                Course Directory
                            </h2>

                            <p class="text-sm text-slate-500 mt-1">
                                View and manage all registered courses.
                            </p>
                        </div>

                        <!-- SEARCH -->
                        <form method="GET"
                              action="{{ route('admin.courses.index') }}"
                              class="flex flex-col sm:flex-row gap-2">

                            <input
                                type="text"
                                name="search"
                                value="{{ $search }}"
                                placeholder="Search code or course name..."
                                class="w-full sm:w-72 rounded-xl border border-slate-300 px-4 py-3 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                            >

                            <button type="submit"
                                    class="rounded-xl bg-slate-900 hover:bg-slate-800 text-white px-5 py-3 font-bold">
                                Search
                            </button>

                            @if($search)
                                <a href="{{ route('admin.courses.index') }}"
                                   class="rounded-xl border border-slate-300 px-4 py-3 text-center font-semibold text-slate-600 hover:bg-slate-50">
                                    Clear
                                </a>
                            @endif

                        </form>

                    </div>

                </div>

                <!-- TABLE -->
                <div class="overflow-x-auto">

                    <table class="w-full text-left">

                        <thead class="bg-slate-50 text-slate-500 text-xs uppercase tracking-wider">
                            <tr>
                                <th class="px-6 py-4">#</th>
                                <th class="px-6 py-4">Course Code</th>
                                <th class="px-6 py-4">Course Name</th>
                                <th class="px-6 py-4">Description</th>
                                <th class="px-6 py-4">Date Added</th>
                                <th class="px-6 py-4 text-right">Actions</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-slate-100">

                            @forelse($courses as $course)

                                <tr class="hover:bg-slate-50">

                                    <td class="px-6 py-4 text-sm text-slate-500">
                                        {{ $courses->firstItem() + $loop->index }}
                                    </td>

                                    <td class="px-6 py-4">
                                        <span class="inline-flex rounded-lg bg-blue-100 text-blue-800 px-3 py-1 text-xs font-extrabold">
                                            {{ $course->course_code }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-4">
                                        <p class="font-bold text-slate-900">
                                            {{ $course->course_name }}
                                        </p>
                                    </td>

                                    <td class="px-6 py-4 text-sm text-slate-500 max-w-xs">
                                        {{ $course->description ?: 'No description provided.' }}
                                    </td>

                                    <td class="px-6 py-4 text-sm text-slate-500 whitespace-nowrap">
                                        {{ $course->created_at->format('M d, Y') }}
                                    </td>

                                    <td class="px-6 py-4">
                                        <div class="flex justify-end items-center gap-2">

                                            <a href="{{ route('admin.courses.edit', $course) }}"
                                               class="rounded-lg bg-amber-100 text-amber-800 px-3 py-2 text-xs font-bold hover:bg-amber-200">
                                                Edit
                                            </a>

                                            <form
                                                method="POST"
                                                action="{{ route('admin.courses.destroy', $course) }}"
                                                onsubmit="return confirm('Are you sure you want to delete this course?')">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                        class="rounded-lg bg-red-100 text-red-700 px-3 py-2 text-xs font-bold hover:bg-red-200">
                                                    Delete
                                                </button>

                                            </form>

                                        </div>
                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="6" class="px-6 py-16 text-center">

                                        <div class="text-4xl mb-3">▣</div>

                                        <h3 class="font-extrabold text-slate-800">
                                            No courses found
                                        </h3>

                                        <p class="text-sm text-slate-500 mt-2">
                                            Add a course or try a different search.
                                        </p>

                                        <a href="{{ route('admin.courses.create') }}"
                                           class="inline-block mt-4 text-blue-700 font-bold hover:underline">
                                            + Add your first course
                                        </a>

                                    </td>
                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

                <!-- PAGINATION -->
                @if($courses->hasPages())
                    <div class="p-6 border-t border-slate-200">
                        {{ $courses->links() }}
                    </div>
                @endif

            </div>

            <!-- FOOTER -->
            <footer class="text-center text-xs text-slate-400 mt-8">
                © {{ date('Y') }} SIRMS Administration Portal. All Rights Reserved.
            </footer>

        </div>

    </main>

</div>

</body>
</html>