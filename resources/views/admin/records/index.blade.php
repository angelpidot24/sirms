```php
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Academic Records | SIRMS</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'DM Sans', sans-serif;
        }

        .record-card {
            transition: all 0.2s ease;
        }

        .record-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 25px rgba(15, 23, 42, 0.08);
        }
    </style>
</head>

<body class="bg-slate-100 min-h-screen">

<div class="min-h-screen flex">

    <!-- SIDEBAR -->
    <aside class="hidden md:flex w-64 bg-slate-950 text-white flex-col shrink-0">

        <div class="p-6 border-b border-slate-800">
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 rounded-xl bg-blue-600 flex items-center justify-center text-2xl font-extrabold">
                    S
                </div>

                <div>
                    <h1 class="font-extrabold text-xl">SIRMS</h1>
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
               class="flex items-center gap-3 px-4 py-3 rounded-xl bg-blue-600 text-white font-bold shadow-lg shadow-blue-950/30">
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
                    Administration / Academic Records
                </p>

                <h2 class="text-xl font-extrabold text-slate-900">
                    Academic Records
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
                        Academic Records
                    </h1>

                    <p class="text-slate-500 mt-2">
                        Manage student grades and academic information.
                    </p>
                </div>

                <a href="{{ route('admin.records.create') }}"
                   class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-xl font-bold text-center shadow-sm">
                    + Add Academic Record
                </a>

            </div>

            <!-- SUCCESS MESSAGE -->
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-100 border border-green-200 text-green-700 rounded-xl">
                    {{ session('success') }}
                </div>
            @endif

            <!-- ERROR MESSAGE -->
            @if($errors->any())
                <div class="mb-6 p-4 bg-red-100 border border-red-200 text-red-700 rounded-xl">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <!-- STATISTICS -->
            <section class="grid grid-cols-1 sm:grid-cols-2 gap-5 mb-8">

                <div class="record-card bg-white border border-slate-200 rounded-2xl p-6 shadow-sm">
                    <div class="w-12 h-12 bg-blue-100 text-blue-700 rounded-xl flex items-center justify-center text-2xl">
                        ▤
                    </div>

                    <p class="text-sm text-slate-500 mt-5">
                        Total Academic Records
                    </p>

                    <h3 class="text-3xl font-extrabold text-slate-900 mt-1">
                        {{ $totalRecords }}
                    </h3>
                </div>

                <div class="record-card bg-white border border-slate-200 rounded-2xl p-6 shadow-sm">
                    <div class="w-12 h-12 bg-indigo-100 text-indigo-700 rounded-xl flex items-center justify-center text-2xl">
                        ▦
                    </div>

                    <p class="text-sm text-slate-500 mt-5">
                        Displayed Records
                    </p>

                    <h3 class="text-3xl font-extrabold text-slate-900 mt-1">
                        {{ $records->count() }}
                    </h3>
                </div>

            </section>

            <!-- SEARCH -->
            <section class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm mb-6">

                <form action="{{ route('admin.records.index') }}" method="GET"
                      class="flex flex-col md:flex-row gap-3">

                    <input
                        type="text"
                        name="search"
                        value="{{ $search }}"
                        placeholder="Search student, student ID, course, or academic year..."
                        class="flex-1 border border-slate-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >

                    <button type="submit"
                        class="bg-slate-900 hover:bg-slate-800 text-white px-6 py-3 rounded-xl font-semibold">
                        Search
                    </button>

                    <a href="{{ route('admin.records.index') }}"
                       class="bg-slate-200 hover:bg-slate-300 text-slate-700 px-6 py-3 rounded-xl font-semibold text-center">
                        Reset
                    </a>

                </form>

            </section>

            <!-- RECORDS TABLE -->
            <section class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">

                <div class="p-6 border-b border-slate-200">
                    <h2 class="text-lg font-extrabold text-slate-900">
                        Student Academic Records
                    </h2>

                    <p class="text-sm text-slate-500 mt-1">
                        View and manage registered student academic information.
                    </p>
                </div>

                <div class="overflow-x-auto">

                    <table class="w-full text-left">

                        <thead class="bg-slate-50 text-slate-600 text-xs uppercase tracking-wide">
                            <tr>
                                <th class="px-6 py-4">Student</th>
                                <th class="px-6 py-4">Course</th>
                                <th class="px-6 py-4">Academic Year</th>
                                <th class="px-6 py-4">Semester</th>
                                <th class="px-6 py-4">Grade</th>
                                <th class="px-6 py-4">Remarks</th>
                                <th class="px-6 py-4 text-center">Actions</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-slate-100 text-sm">

                            @forelse($records as $record)

                                <tr class="hover:bg-slate-50">

                                    <!-- STUDENT -->
                                    <td class="px-6 py-5">
                                        <p class="font-bold text-slate-800">
                                            {{ $record->student->name ?? 'Unknown Student' }}
                                        </p>

                                        <p class="text-xs text-slate-500 mt-1">
                                            {{ $record->student->student_id ?? 'No ID' }}
                                        </p>
                                    </td>

                                    <!-- COURSE -->
                                    <td class="px-6 py-5">
                                        <p class="font-bold text-slate-800">
                                            {{ $record->course->course_code ?? 'N/A' }}
                                        </p>

                                        <p class="text-xs text-slate-500 mt-1">
                                            {{ $record->course->course_name ?? '' }}
                                        </p>
                                    </td>

                                    <!-- ACADEMIC YEAR -->
                                    <td class="px-6 py-5 text-slate-700">
                                        {{ $record->academic_year }}
                                    </td>

                                    <!-- SEMESTER -->
                                    <td class="px-6 py-5 text-slate-700">
                                        {{ $record->semester }}
                                    </td>

                                    <!-- GRADE -->
                                    <td class="px-6 py-5">
                                        @if($record->grade !== null)
                                            <span class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded-full font-bold">
                                                {{ number_format((float) $record->grade, 2) }}
                                            </span>
                                        @else
                                            <span class="text-slate-400">
                                                Not graded
                                            </span>
                                        @endif
                                    </td>

                                    <!-- REMARKS -->
                                    <td class="px-6 py-5 text-slate-600">
                                        {{ $record->remarks ?: '—' }}
                                    </td>

                                    <!-- ACTIONS -->
                                    <td class="px-6 py-5">
                                        <div class="flex justify-center items-center gap-2">

                                            <a href="{{ route('admin.records.edit', $record->id) }}"
                                               class="bg-amber-100 text-amber-700 hover:bg-amber-200 px-3 py-2 rounded-lg font-semibold">
                                                Edit
                                            </a>

                                            <form action="{{ route('admin.records.destroy', $record->id) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('Are you sure you want to delete this academic record?')">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                    class="bg-red-100 text-red-700 hover:bg-red-200 px-3 py-2 rounded-lg font-semibold">
                                                    Delete
                                                </button>

                                            </form>

                                        </div>
                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="7" class="px-6 py-16 text-center">

                                        <div class="text-4xl mb-3">📚</div>

                                        <h3 class="text-lg font-bold text-slate-700">
                                            No Academic Records Found
                                        </h3>

                                        <p class="text-sm text-slate-400 mt-2">
                                            Start by adding an academic record for a student.
                                        </p>

                                        <a href="{{ route('admin.records.create') }}"
                                           class="inline-block mt-5 bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-xl font-semibold">
                                            + Add Academic Record
                                        </a>

                                    </td>
                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

                <!-- PAGINATION -->
                <div class="p-5 border-t border-slate-200">
                    {{ $records->links() }}
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