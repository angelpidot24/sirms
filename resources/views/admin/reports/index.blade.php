
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports | SIRMS</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'DM Sans', sans-serif;
            background: #f1f5f9;
        }

        .sidebar {
            width: 260px;
            min-height: 100vh;
            background: #020617;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 13px 15px;
            border-radius: 12px;
            color: #cbd5e1;
            margin-bottom: 5px;
            transition: 0.2s;
        }

        .nav-link:hover {
            background: #1e293b;
            color: white;
        }

        .nav-active {
            background: #2563eb;
            color: white;
            font-weight: 700;
        }

        .main-content {
            min-width: 0;
            flex: 1;
        }

        .stat-card {
            transition: 0.2s ease;
        }

        .stat-card:hover {
            transform: translateY(-3px);
        }

        .print-title {
            display: none;
        }

        @media print {
            body {
                background: white !important;
            }

            .sidebar,
            .no-print,
            button,
            nav {
                display: none !important;
            }

            .main-content {
                width: 100% !important;
            }

            .print-area {
                padding: 0 !important;
                margin: 0 !important;
                max-width: 100% !important;
            }

            .stat-card,
            .report-table {
                box-shadow: none !important;
                break-inside: avoid;
            }

            table {
                width: 100% !important;
                border-collapse: collapse !important;
            }

            th, td {
                border: 1px solid #cbd5e1 !important;
                color: black !important;
            }

            .print-title {
                display: block !important;
            }

            a {
                color: black !important;
                text-decoration: none !important;
            }
        }

        @media(max-width: 767px) {
            .app-layout {
                display: block;
            }

            .sidebar {
                width: 100%;
                min-height: auto;
            }
        }
    </style>
</head>

<body>

<div class="app-layout flex min-h-screen">

    <!-- SIDEBAR -->
    <aside class="sidebar text-white p-6 no-print flex flex-col">

        <!-- BRAND -->
        <div class="mb-10">
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
        <p class="text-xs uppercase tracking-widest text-slate-500 font-bold mb-4 px-3">
            Main Menu
        </p>

        <nav class="flex-1">

            <!-- DASHBOARD -->
            <a href="{{ route('dashboard') }}" class="nav-link">
                <span>▦</span>
                Dashboard
            </a>

            <!-- STUDENT MANAGEMENT -->
            <a href="{{ route('admin.students.index') }}" class="nav-link">
                <span>♙</span>
                Student Management
            </a>

            <!-- ADMIN MANAGEMENT -->
            <a href="{{ route('admin.admins.index') }}" class="nav-link">
                <span>♟</span>
                Admin Management
            </a>

            <!-- COURSE MANAGEMENT -->
            <a href="{{ route('admin.courses.index') }}" class="nav-link">
                <span>▣</span>
                Course Management
            </a>

            <!-- ACADEMIC RECORDS -->
            <a href="{{ route('admin.records.index') }}" class="nav-link">
                <span>▤</span>
                Academic Records
            </a>

            <!-- ANNOUNCEMENTS -->
            <a href="{{ route('admin.announcements.index') }}" class="nav-link">
                <span>♧</span>
                Announcements
            </a>

            <!-- REPORTS -->
            <a href="{{ route('admin.reports.index') }}" class="nav-link nav-active">
                <span>▥</span>
                Reports
            </a>

        </nav>

        <!-- LOGOUT -->
        <div class="mt-10 border-t border-slate-800 pt-5">

            <p class="font-semibold text-sm">
                {{ auth()->user()->name }}
            </p>

            <p class="text-xs text-slate-400">
                Administrator
            </p>

            <form action="{{ route('logout') }}" method="POST" class="mt-5">
                @csrf

                <button type="submit"
                        class="w-full text-left rounded-xl px-4 py-3 text-sm text-red-300 hover:bg-slate-800 hover:text-white">
                    ↪ Sign Out
                </button>
            </form>

        </div>

    </aside>


    <!-- MAIN CONTENT -->
    <main class="main-content">

        <!-- HEADER -->
        <header class="bg-white border-b border-slate-200 px-6 py-5 flex flex-wrap justify-between items-center gap-4 no-print">

            <div>
                <p class="text-sm text-slate-500">
                    Administration / Reports
                </p>

                <h2 class="text-2xl font-extrabold text-slate-900">
                    System Reports
                </h2>
            </div>

            <button onclick="window.print()"
                    class="bg-blue-700 hover:bg-blue-800 text-white px-5 py-3 rounded-xl font-bold">
                Print / Save as PDF
            </button>

        </header>


        <div class="print-area p-6 lg:p-8 max-w-7xl mx-auto">

            <!-- PRINT HEADER -->
            <section class="print-title mb-8">

                <h1 class="text-3xl font-extrabold">SIRMS</h1>

                <h2 class="text-xl font-bold mt-2">
                    System Reports
                </h2>

                <p class="text-sm mt-2">
                    Student Information and Records Management System
                </p>

                <p class="text-sm mt-1">
                    Report generated: {{ now()->format('F d, Y h:i A') }}
                </p>

                <hr class="my-5">

            </section>


            <!-- PAGE INTRODUCTION -->
            <section class="mb-8 no-print">

                <h1 class="text-3xl font-extrabold text-slate-900">
                    Reports Overview
                </h1>

                <p class="text-slate-500 mt-2">
                    Review the current statistics and academic records stored in SIRMS.
                </p>

            </section>


            <!-- STATISTICS -->
            <section class="grid sm:grid-cols-2 xl:grid-cols-3 gap-5 mb-8">

                <!-- TOTAL STUDENTS -->
                <div class="stat-card bg-white border border-slate-200 rounded-2xl p-6 shadow-sm">

                    <div class="w-12 h-12 bg-blue-100 text-blue-700 rounded-xl flex items-center justify-center text-2xl">
                        ♙
                    </div>

                    <p class="text-sm text-slate-500 mt-5">
                        Total Students
                    </p>

                    <h3 class="text-3xl font-extrabold text-slate-900 mt-1">
                        {{ number_format($totalStudents) }}
                    </h3>

                </div>


                <!-- TOTAL ADMINS -->
                <div class="stat-card bg-white border border-slate-200 rounded-2xl p-6 shadow-sm">

                    <div class="w-12 h-12 bg-indigo-100 text-indigo-700 rounded-xl flex items-center justify-center text-2xl">
                        ♟
                    </div>

                    <p class="text-sm text-slate-500 mt-5">
                        Total Administrators
                    </p>

                    <h3 class="text-3xl font-extrabold text-slate-900 mt-1">
                        {{ number_format($totalAdmins) }}
                    </h3>

                </div>


                <!-- TOTAL COURSES -->
                <div class="stat-card bg-white border border-slate-200 rounded-2xl p-6 shadow-sm">

                    <div class="w-12 h-12 bg-emerald-100 text-emerald-700 rounded-xl flex items-center justify-center text-2xl">
                        ▣
                    </div>

                    <p class="text-sm text-slate-500 mt-5">
                        Total Courses
                    </p>

                    <h3 class="text-3xl font-extrabold text-slate-900 mt-1">
                        {{ number_format($totalCourses) }}
                    </h3>

                </div>


                <!-- ACADEMIC RECORDS -->
                <div class="stat-card bg-white border border-slate-200 rounded-2xl p-6 shadow-sm">

                    <div class="w-12 h-12 bg-purple-100 text-purple-700 rounded-xl flex items-center justify-center text-2xl">
                        ▤
                    </div>

                    <p class="text-sm text-slate-500 mt-5">
                        Academic Records
                    </p>

                    <h3 class="text-3xl font-extrabold text-slate-900 mt-1">
                        {{ number_format($totalRecords) }}
                    </h3>

                </div>


                <!-- GRADED RECORDS -->
                <div class="stat-card bg-white border border-slate-200 rounded-2xl p-6 shadow-sm">

                    <div class="w-12 h-12 bg-amber-100 text-amber-700 rounded-xl flex items-center justify-center text-2xl">
                        ✓
                    </div>

                    <p class="text-sm text-slate-500 mt-5">
                        Records with Grades
                    </p>

                    <h3 class="text-3xl font-extrabold text-slate-900 mt-1">
                        {{ number_format($gradedRecords) }}
                    </h3>

                </div>


                <!-- AVERAGE GRADE -->
                <div class="stat-card bg-white border border-slate-200 rounded-2xl p-6 shadow-sm">

                    <div class="w-12 h-12 bg-rose-100 text-rose-700 rounded-xl flex items-center justify-center text-2xl">
                        %
                    </div>

                    <p class="text-sm text-slate-500 mt-5">
                        Average Recorded Grade
                    </p>

                    <h3 class="text-3xl font-extrabold text-slate-900 mt-1">
                        {{ $averageGrade !== null ? number_format($averageGrade, 2) : 'N/A' }}
                    </h3>

                    <p class="text-xs text-slate-400 mt-2">
                        Based on records with grades
                    </p>

                </div>

            </section>


            <!-- ACADEMIC RECORDS REPORT -->
            <section class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden report-table">

                <div class="p-6 border-b border-slate-200">

                    <h2 class="text-xl font-extrabold text-slate-900">
                        Academic Records Report
                    </h2>

                    <p class="text-sm text-slate-500 mt-1">
                        List of recorded student academic information.
                    </p>

                </div>


                <div class="overflow-x-auto">

                    <table class="w-full text-left">

                        <thead class="bg-slate-50 text-xs uppercase text-slate-500">

                            <tr>
                                <th class="px-5 py-4">Student</th>
                                <th class="px-5 py-4">Student ID</th>
                                <th class="px-5 py-4">Course</th>
                                <th class="px-5 py-4">Academic Year</th>
                                <th class="px-5 py-4">Semester</th>
                                <th class="px-5 py-4">Grade</th>
                            </tr>

                        </thead>

                        <tbody class="divide-y divide-slate-100">

                            @forelse($records as $record)

                                <tr class="hover:bg-slate-50">

                                    <td class="px-5 py-4">
                                        <p class="font-bold text-slate-800">
                                            {{ $record->student->name ?? 'Student unavailable' }}
                                        </p>
                                    </td>

                                    <td class="px-5 py-4 text-sm text-slate-600">
                                        {{ $record->student->student_id ?? 'N/A' }}
                                    </td>

                                    <td class="px-5 py-4 text-sm text-slate-600">
                                        {{ $record->course->course_code ?? 'N/A' }}
                                    </td>

                                    <td class="px-5 py-4 text-sm text-slate-600">
                                        {{ $record->academic_year }}
                                    </td>

                                    <td class="px-5 py-4 text-sm text-slate-600">
                                        {{ $record->semester }}
                                    </td>

                                    <td class="px-5 py-4">

                                        @if($record->grade !== null)

                                            <span class="font-bold text-slate-800">
                                                {{ number_format($record->grade, 2) }}
                                            </span>

                                        @else

                                            <span class="text-slate-400">
                                                No grade
                                            </span>

                                        @endif

                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center">

                                        <p class="text-3xl mb-3">▤</p>

                                        <p class="font-bold text-slate-700">
                                            No academic records available
                                        </p>

                                        <p class="text-sm text-slate-500 mt-1">
                                            Academic records will appear here once added.
                                        </p>

                                    </td>
                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>


                <!-- PAGINATION -->
                <div class="p-6 border-t border-slate-100 no-print">
                    {{ $records->links() }}
                </div>

            </section>


            <!-- REPORT FOOTER -->
            <footer class="text-center text-xs text-slate-400 mt-8">
                SIRMS Administration Portal | Generated {{ now()->format('F d, Y') }}
            </footer>

        </div>

    </main>

</div>

</body>
</html>
