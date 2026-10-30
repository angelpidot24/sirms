
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management | SIRMS</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'DM Sans', sans-serif;
        }
    </style>
</head>

<body class="min-h-screen bg-slate-100 text-slate-800">

<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <aside class="hidden w-64 flex-shrink-0 bg-slate-950 text-white md:flex md:flex-col">

        <div class="border-b border-slate-800 p-6">
            <div class="flex items-center gap-3">
                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-600 text-2xl font-extrabold">
                    S
                </div>

                <div>
                    <h1 class="text-xl font-extrabold">SIRMS</h1>
                    <p class="text-xs text-slate-400">Administration Portal</p>
                </div>
            </div>
        </div>

        <!-- NAVIGATION -->
        <nav class="flex-1 space-y-2 overflow-y-auto p-4">

            <p class="px-3 py-3 text-xs font-bold uppercase tracking-widest text-slate-500">
                Main Menu
            </p>

            <!-- DASHBOARD -->
            <a href="{{ route('dashboard') }}"
               class="flex items-center gap-3 rounded-xl px-4 py-3 text-slate-300 transition hover:bg-slate-800 hover:text-white">
                <span>▦</span>
                Dashboard
            </a>

            <!-- STUDENT MANAGEMENT -->
            <a href="{{ route('admin.students.index') }}"
               class="flex items-center gap-3 rounded-xl bg-blue-600 px-4 py-3 font-bold text-white">
                <span>♙</span>
                Student Management
            </a>

            <!-- ADMIN MANAGEMENT -->
            <a href="{{ route('admin.admins.index') }}"
               class="flex items-center gap-3 rounded-xl px-4 py-3 text-slate-300 transition hover:bg-slate-800 hover:text-white">
                <span>♟</span>
                Admin Management
            </a>

            <!-- COURSE MANAGEMENT -->
            <a href="{{ route('admin.courses.index') }}"
               class="flex items-center gap-3 rounded-xl px-4 py-3 text-slate-300 transition hover:bg-slate-800 hover:text-white">
                <span>▣</span>
                Course Management
            </a>

            <!-- ACADEMIC RECORDS -->
            <a href="{{ route('admin.records.index') }}"
               class="flex items-center gap-3 rounded-xl px-4 py-3 text-slate-300 transition hover:bg-slate-800 hover:text-white">
                <span>▤</span>
                Academic Records
            </a>

            <!-- ANNOUNCEMENTS -->
            <a href="{{ route('admin.announcements.index') }}"
               class="flex items-center gap-3 rounded-xl px-4 py-3 text-slate-300 transition hover:bg-slate-800 hover:text-white">
                <span>♧</span>
                Announcements
            </a>

            <!-- REPORTS -->
            <a href="{{ route('admin.reports.index') }}"
               class="flex items-center gap-3 rounded-xl px-4 py-3 text-slate-300 transition hover:bg-slate-800 hover:text-white">
                <span>▥</span>
                Reports
            </a>

        </nav>

        <!-- LOGOUT -->
        <div class="border-t border-slate-800 p-4">
            <form action="{{ route('logout') }}" method="POST">
                @csrf

                <button type="submit"
                        class="w-full rounded-xl px-4 py-3 text-left font-semibold text-red-300 transition hover:bg-slate-800 hover:text-white">
                    ↪ Sign Out
                </button>
            </form>
        </div>

    </aside>

    <!-- MAIN CONTENT -->
    <main class="min-w-0 flex-1">

        <!-- TOP HEADER -->
        <header class="flex flex-wrap items-center justify-between gap-4 border-b border-slate-200 bg-white px-6 py-5 md:px-10">

            <div>
                <p class="text-xs font-bold uppercase tracking-wider text-blue-600">
                    Administration
                </p>

                <h2 class="mt-1 text-xl font-bold text-slate-900">
                    Student Management
                </h2>
            </div>

            <div class="text-sm text-slate-500">
                Welcome,
                <span class="font-semibold text-slate-800">
                    {{ auth()->user()->name }}
                </span>
            </div>

        </header>

        <div class="p-6 md:p-10">

            <!-- PAGE TITLE -->
            <div class="mb-8 flex flex-wrap items-end justify-between gap-4">

                <div>
                    <h1 class="text-3xl font-bold text-slate-900">
                        Students
                    </h1>

                    <p class="mt-2 text-sm text-slate-500">
                        View, add, update, and manage registered student accounts.
                    </p>
                </div>

                <a href="{{ route('admin.students.create') }}"
                   class="rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700">
                    + Add New Student
                </a>

            </div>

            <!-- SUCCESS MESSAGE -->
            @if(session('success'))
                <div class="mb-6 rounded-xl border border-green-200 bg-green-50 p-4 text-sm font-medium text-green-700">
                    ✓ {{ session('success') }}
                </div>
            @endif

            <!-- STATISTICS -->
            <div class="mb-8 grid gap-5 sm:grid-cols-2">

                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

                    <div class="flex items-center justify-between">

                        <div>
                            <p class="text-sm text-slate-500">Total Students</p>

                            <h3 class="mt-2 text-3xl font-bold text-slate-900">
                                {{ $students->total() }}
                            </h3>
                        </div>

                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-blue-50 text-2xl text-blue-600">
                            ♙
                        </div>

                    </div>

                </div>

                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

                    <div class="flex items-center justify-between">

                        <div>
                            <p class="text-sm text-slate-500">Current Page</p>

                            <h3 class="mt-2 text-3xl font-bold text-slate-900">
                                {{ $students->currentPage() }}
                            </h3>
                        </div>

                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-indigo-50 text-2xl text-indigo-600">
                            ▤
                        </div>

                    </div>

                </div>

            </div>

            <!-- STUDENT TABLE -->
            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                <div class="flex flex-wrap items-center justify-between gap-3 border-b border-slate-200 p-6">

                    <div>
                        <h3 class="font-bold text-slate-900">
                            Registered Students
                        </h3>

                        <p class="mt-1 text-xs text-slate-500">
                            Student account records
                        </p>
                    </div>

                    <span class="rounded-full bg-blue-50 px-3 py-1 text-xs font-semibold text-blue-700">
                        {{ $students->total() }} Students
                    </span>

                </div>

                <div class="overflow-x-auto">

                    <table class="w-full text-left text-sm">

                        <thead class="bg-slate-50 text-xs uppercase tracking-wider text-slate-500">

                            <tr>
                                <th class="px-6 py-4">Student ID</th>
                                <th class="px-6 py-4">Full Name</th>
                                <th class="px-6 py-4">Email Address</th>
                                <th class="px-6 py-4">Account Type</th>
                                <th class="px-6 py-4 text-center">Actions</th>
                            </tr>

                        </thead>

                        <tbody class="divide-y divide-slate-100">

                            @forelse($students as $student)

                                <tr class="transition hover:bg-slate-50">

                                    <td class="whitespace-nowrap px-6 py-5 font-semibold text-slate-700">
                                        {{ $student->student_id ?? 'N/A' }}
                                    </td>

                                    <td class="whitespace-nowrap px-6 py-5">

                                        <div class="font-semibold text-slate-900">
                                            {{ $student->name }}
                                        </div>

                                        <div class="mt-1 text-xs text-slate-400">
                                            Student ID: {{ $student->id }}
                                        </div>

                                    </td>

                                    <td class="whitespace-nowrap px-6 py-5 text-slate-600">
                                        {{ $student->email }}
                                    </td>

                                    <td class="px-6 py-5">

                                        <span class="rounded-full bg-blue-50 px-3 py-1.5 text-xs font-semibold text-blue-700">
                                            Student
                                        </span>

                                    </td>

                                    <td class="whitespace-nowrap px-6 py-5">

                                        <div class="flex items-center justify-center gap-2">

                                            <a href="{{ route('admin.students.edit', $student->id) }}"
                                               class="rounded-lg bg-amber-50 px-3 py-2 text-xs font-semibold text-amber-700 hover:bg-amber-100">
                                                Edit
                                            </a>

                                            <form action="{{ route('admin.students.destroy', $student->id) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('Are you sure you want to delete this student account?')">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                        class="rounded-lg bg-red-50 px-3 py-2 text-xs font-semibold text-red-700 hover:bg-red-100">
                                                    Delete
                                                </button>

                                            </form>

                                        </div>

                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="5" class="px-6 py-16 text-center">

                                        <div class="text-4xl">♙</div>

                                        <h3 class="mt-3 font-semibold text-slate-700">
                                            No Students Found
                                        </h3>

                                        <p class="mt-1 text-sm text-slate-400">
                                            Add a student account to get started.
                                        </p>

                                    </td>
                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

                <!-- PAGINATION -->
                <div class="border-t border-slate-200 p-5">
                    {{ $students->links() }}
                </div>

            </div>

            <!-- FOOTER -->
            <p class="mt-6 text-center text-xs text-slate-400">
                © {{ date('Y') }} Student Information and Records Management System
            </p>

        </div>

    </main>

</div>

</body>
</html>
