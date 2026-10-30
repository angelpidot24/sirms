
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Academic Records | SIRMS</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700;800&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'DM Sans', sans-serif; }
        .heading-font { font-family: 'Playfair Display', serif; }
        .pink-gradient { background: linear-gradient(135deg, #ec4899, #be185d); }
        .sidebar-link { transition: .2s ease; }
        .sidebar-link:hover { background: #fce7f3; color: #be185d; }
    </style>
</head>

<body class="min-h-screen bg-pink-50/50 text-gray-800">

<div class="min-h-screen flex">

    <!-- SIDEBAR -->
    <aside class="hidden md:flex w-64 bg-white border-r border-pink-100 flex-col">

        <div class="p-6 border-b border-pink-100">
            <div class="flex items-center gap-3">
                <div class="pink-gradient w-11 h-11 rounded-xl flex items-center justify-center text-white text-2xl font-bold">
                    S
                </div>
                <div>
                    <h1 class="font-extrabold text-xl text-gray-900">SIRMS</h1>
                    <p class="text-xs text-gray-500">Student Portal</p>
                </div>
            </div>
        </div>

        <nav class="p-4 flex-1 space-y-2">
            <p class="text-xs font-bold uppercase tracking-widest text-gray-400 px-3 py-3">
                Student Menu
            </p>

            <a href="{{ route('student.dashboard') }}"
               class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl text-gray-600">
                <span>▦</span> Dashboard
            </a>

            <a href="{{ route('students.profile') }}"
               class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl text-gray-600">
                <span>♙</span> My Profile
            </a>

            <a href="{{ route('student.records') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl bg-pink-100 text-pink-700 font-bold">
                <span>▤</span> Academic Records
            </a>

            <a href="{{ route('student.dashboard') }}#courses"
               class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl text-gray-600">
                <span>▣</span> My Courses
            </a>

            <a href="{{ route('student.dashboard') }}#announcements"
               class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl text-gray-600">
                <span>♧</span> Announcements
            </a>
        </nav>

        <div class="p-4 border-t border-pink-100">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="w-full text-left px-4 py-3 rounded-xl text-red-600 hover:bg-red-50 font-semibold">
                    ↪ Sign Out
                </button>
            </form>
        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="flex-1 min-w-0">

        <!-- HEADER -->
        <header class="bg-white border-b border-pink-100 px-6 py-5 flex justify-between items-center">
            <div>
                <p class="text-sm text-gray-500">Student Portal / Academic Records</p>
                <h2 class="text-xl font-extrabold text-gray-900">Academic Records</h2>
            </div>

            <div class="flex items-center gap-3">
                <div class="text-right hidden sm:block">
                    <p class="text-sm font-bold text-gray-800">
                        {{ auth()->user()->name }}
                    </p>
                    <p class="text-xs text-pink-600">Student</p>
                </div>

                <div class="w-11 h-11 rounded-full pink-gradient flex items-center justify-center text-white font-bold overflow-hidden">
                    @if(auth()->user()->profile_photo_path)
                        <img src="{{ asset('storage/' . auth()->user()->profile_photo_path) }}"
                             alt="Profile photo"
                             class="w-full h-full object-cover">
                    @else
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    @endif
                </div>
            </div>
        </header>

        <div class="p-6 lg:p-8 max-w-7xl mx-auto">

            <!-- INTRO -->
            <section class="pink-gradient rounded-3xl p-8 text-white shadow-lg shadow-pink-200">
                <p class="text-sm font-semibold text-pink-100">YOUR ACADEMIC INFORMATION</p>

                <h1 class="heading-font text-3xl sm:text-4xl mt-2">
                    Academic Records
                </h1>

                <p class="text-sm sm:text-base text-pink-100 mt-3 max-w-2xl">
                    View your academic performance, grades, course information, and academic history in one place.
                </p>

                <div class="mt-5 inline-block bg-white/20 rounded-xl px-4 py-2 text-sm">
                    Student ID: {{ auth()->user()->student_id ?? 'Not assigned' }}
                </div>
            </section>

            <!-- SUMMARY CARDS -->
            <section class="mt-8">
                <h2 class="text-xl font-extrabold text-gray-900">Academic Summary</h2>
                <p class="text-sm text-gray-500 mt-1">A quick overview of your academic records.</p>

                <div class="grid sm:grid-cols-2 xl:grid-cols-3 gap-5 mt-5">

                    <div class="bg-white border border-pink-100 rounded-2xl p-6 shadow-sm">
                        <div class="w-12 h-12 rounded-xl bg-pink-100 text-pink-600 flex items-center justify-center text-2xl">
                            ▤
                        </div>
                        <p class="text-sm text-gray-500 mt-5">Total Records</p>
                        <h3 class="text-3xl font-extrabold text-gray-900 mt-1">
                            {{ $totalRecords }}
                        </h3>
                        <p class="text-xs text-gray-400 mt-2">Your recorded academic entries</p>
                    </div>

                    <div class="bg-white border border-pink-100 rounded-2xl p-6 shadow-sm">
                        <div class="w-12 h-12 rounded-xl bg-purple-100 text-purple-600 flex items-center justify-center text-2xl">
                            ✓
                        </div>
                        <p class="text-sm text-gray-500 mt-5">Graded Records</p>
                        <h3 class="text-3xl font-extrabold text-gray-900 mt-1">
                            {{ $gradedRecords }}
                        </h3>
                        <p class="text-xs text-gray-400 mt-2">Records with grades entered</p>
                    </div>

                    <div class="bg-white border border-pink-100 rounded-2xl p-6 shadow-sm">
                        <div class="w-12 h-12 rounded-xl bg-amber-100 text-amber-600 flex items-center justify-center text-2xl">
                            ★
                        </div>
                        <p class="text-sm text-gray-500 mt-5">Average Grade</p>
                        <h3 class="text-3xl font-extrabold text-gray-900 mt-1">
                            {{ $averageGrade !== null ? number_format($averageGrade, 2) : 'N/A' }}
                        </h3>
                        <p class="text-xs text-gray-400 mt-2">Average of recorded grades</p>
                    </div>

                </div>
            </section>

            <!-- RECORDS TABLE -->
            <section class="mt-8 bg-white border border-pink-100 rounded-2xl shadow-sm overflow-hidden">

                <div class="p-6 border-b border-pink-100">
                    <h2 class="text-lg font-extrabold text-gray-900">My Grade Records</h2>
                    <p class="text-sm text-gray-500 mt-1">
                        Your academic records provided by the administrator.
                    </p>
                </div>

                @if($records->count() > 0)

                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="bg-pink-50 text-xs uppercase tracking-wider text-gray-500">
                                <tr>
                                    <th class="px-6 py-4 font-bold">Course</th>
                                    <th class="px-6 py-4 font-bold">Academic Year</th>
                                    <th class="px-6 py-4 font-bold">Semester</th>
                                    <th class="px-6 py-4 font-bold">Grade</th>
                                    <th class="px-6 py-4 font-bold">Remarks</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-pink-50">
                                @foreach($records as $record)
                                    <tr class="hover:bg-pink-50/50 transition">

                                        <td class="px-6 py-4">
                                            <p class="font-bold text-gray-800">
                                                {{ $record->course->course_code ?? 'N/A' }}
                                            </p>
                                            <p class="text-xs text-gray-500 mt-1">
                                                {{ $record->course->course_name ?? 'Course unavailable' }}
                                            </p>
                                        </td>

                                        <td class="px-6 py-4 text-sm text-gray-600">
                                            {{ $record->academic_year }}
                                        </td>

                                        <td class="px-6 py-4 text-sm text-gray-600">
                                            {{ $record->semester }}
                                        </td>

                                        <td class="px-6 py-4">
                                            @if($record->grade !== null)
                                                <span class="inline-flex rounded-full bg-pink-100 px-3 py-1 text-sm font-bold text-pink-700">
                                                    {{ number_format((float) $record->grade, 2) }}
                                                </span>
                                            @else
                                                <span class="inline-flex rounded-full bg-amber-100 px-3 py-1 text-xs font-bold text-amber-700">
                                                    Pending
                                                </span>
                                            @endif
                                        </td>

                                        <td class="px-6 py-4 text-sm text-gray-600">
                                            {{ $record->remarks ?: 'No remarks' }}
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- PAGINATION -->
                    <div class="border-t border-pink-100 px-6 py-5">
                        {{ $records->links() }}
                    </div>

                @else

                    <div class="px-6 py-16 text-center">
                        <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-pink-100 text-3xl text-pink-500">
                            ▤
                        </div>

                        <h3 class="mt-5 text-lg font-extrabold text-gray-800">
                            No Academic Records Yet
                        </h3>

                        <p class="mx-auto mt-2 max-w-md text-sm text-gray-500">
                            Your academic records will appear here once the administrator adds your grades and course information.
                        </p>

                        <a href="{{ route('student.dashboard') }}"
                           class="mt-6 inline-block rounded-xl bg-pink-500 px-6 py-3 text-sm font-bold text-white transition hover:bg-pink-600">
                            Back to Dashboard
                        </a>
                    </div>

                @endif

            </section>

            <!-- INFORMATION -->
            <section class="mt-6 rounded-2xl border border-pink-100 bg-white p-6">
                <div class="flex items-start gap-4">
                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-pink-100 text-pink-600 text-xl">
                        ℹ
                    </div>

                    <div>
                        <h3 class="font-extrabold text-gray-800">Academic Records Information</h3>
                        <p class="mt-2 text-sm leading-6 text-gray-500">
                            This page is for viewing your academic records only. If you notice an incorrect grade or missing record, please contact your school administrator for assistance.
                        </p>
                    </div>
                </div>
            </section>

            <footer class="text-center text-xs text-gray-400 mt-10">
                © {{ date('Y') }} SIRMS Student Portal. All Rights Reserved.
            </footer>

        </div>
    </main>
</div>

</body>
</html>
