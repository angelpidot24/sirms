
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | SIRMS</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'DM Sans', sans-serif;
        }

        .admin-gradient {
            background: linear-gradient(135deg, #172554, #1e40af);
        }

        .module-card {
            transition: all 0.2s ease;
        }

        .module-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 25px rgba(15, 23, 42, 0.08);
        }
    </style>
</head>

<body class="bg-slate-100 min-h-screen">

<div class="min-h-screen flex">

    <!-- SIDEBAR -->
    <aside class="hidden md:flex w-64 bg-slate-950 text-white flex-col">

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
               class="flex items-center gap-3 px-4 py-3 rounded-xl bg-blue-600 text-white font-bold">
                <span>▦</span>
                Dashboard
            </a>

            <a href="{{ route('admin.students.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-300 hover:bg-slate-800 hover:text-white">
                <span>♙</span>
                Student Management
            </a>

            <a href="{{ route('admin.admins.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-300 hover:bg-slate-800 hover:text-white">
                <span>♟</span>
                Admin Management
            </a>

            <a href="{{ route('admin.courses.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-300 hover:bg-slate-800 hover:text-white">
                <span>▣</span>
                Course Management
            </a>

            <a href="{{ route('admin.records.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-300 hover:bg-slate-800 hover:text-white">
                <span>▤</span>
                Academic Records
            </a>

            <!-- ENROLLMENT MANAGEMENT -->
            <a href="{{ route('admin.enrollments.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-300 hover:bg-slate-800 hover:text-white">
                <span>▤</span>
                Enrollment Management
            </a>

            <!-- ANNOUNCEMENTS -->
            <a href="{{ route('admin.announcements.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-300 hover:bg-slate-800 hover:text-white">
                <span>♧</span>
                Announcements
            </a>

            <!-- REPORTS -->
            <a href="{{ route('admin.reports.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-300 hover:bg-slate-800 hover:text-white">
                <span>▥</span>
                Reports
            </a>

        </nav>

        <!-- LOGOUT -->
        <div class="p-4 border-t border-slate-800">
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit"
                        class="w-full text-left px-4 py-3 rounded-xl text-red-300 hover:bg-slate-800 font-semibold">
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
                    Administration / Dashboard
                </p>

                <h2 class="text-xl font-extrabold text-slate-900">
                    Admin Dashboard
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

            <!-- WELCOME BANNER -->
            <section class="admin-gradient rounded-2xl p-8 text-white shadow-lg">

                <p class="text-blue-200 text-sm font-semibold uppercase tracking-widest">
                    Administration Portal
                </p>

                <h1 class="text-3xl sm:text-4xl font-extrabold mt-3">
                    Welcome, {{ auth()->user()->name }}!
                </h1>

                <p class="text-blue-100 mt-3 max-w-2xl">
                    Manage student information, administrator accounts, courses, academic records, enrollment requests, announcements, and other SIRMS operations from one place.
                </p>

                <div class="mt-5 inline-flex bg-white/15 rounded-lg px-4 py-2 text-sm">
                    Administrator Access
                </div>

            </section>

            <!-- STATISTICS -->
            <section class="mt-8">

                <div class="flex justify-between items-center">

                    <div>
                        <h2 class="text-xl font-extrabold text-slate-900">
                            System Overview
                        </h2>

                        <p class="text-sm text-slate-500 mt-1">
                            Current system statistics.
                        </p>
                    </div>

                    <span class="text-xs bg-blue-100 text-blue-800 px-3 py-2 rounded-full font-bold">
                        Live account counts
                    </span>

                </div>

                <div class="grid sm:grid-cols-2 xl:grid-cols-4 gap-5 mt-5">

                    <!-- STUDENTS -->
                    <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm">

                        <div class="w-12 h-12 bg-blue-100 text-blue-700 rounded-xl flex items-center justify-center text-2xl">
                            ♙
                        </div>

                        <p class="text-sm text-slate-500 mt-5">
                            Total Students
                        </p>

                        <h3 class="text-3xl font-extrabold text-slate-900 mt-1">
                            {{ $totalStudents }}
                        </h3>

                    </div>

                    <!-- ADMINS -->
                    <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm">

                        <div class="w-12 h-12 bg-indigo-100 text-indigo-700 rounded-xl flex items-center justify-center text-2xl">
                            ♟
                        </div>

                        <p class="text-sm text-slate-500 mt-5">
                            Total Administrators
                        </p>

                        <h3 class="text-3xl font-extrabold text-slate-900 mt-1">
                            {{ $totalAdmins }}
                        </h3>

                    </div>

                    <!-- COURSES -->
                    <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm">

                        <div class="w-12 h-12 bg-emerald-100 text-emerald-700 rounded-xl flex items-center justify-center text-2xl">
                            ▣
                        </div>

                        <p class="text-sm text-slate-500 mt-5">
                            Total Courses
                        </p>

                        <h3 class="text-3xl font-extrabold text-slate-900 mt-1">
                            {{ $totalCourses }}
                        </h3>

                        <p class="text-xs text-slate-400 mt-2">
                            Registered courses
                        </p>

                    </div>

                    <!-- ACADEMIC RECORDS -->
                    <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm">

                        <div class="w-12 h-12 bg-amber-100 text-amber-700 rounded-xl flex items-center justify-center text-2xl">
                            ▤
                        </div>

                        <p class="text-sm text-slate-500 mt-5">
                            Academic Records
                        </p>

                        <h3 class="text-3xl font-extrabold text-slate-900 mt-1">
                            {{ $totalRecords }}
                        </h3>

                        <p class="text-xs text-slate-400 mt-2">
                            Registered academic records
                        </p>

                    </div>

                </div>

            </section>

            <!-- MANAGEMENT MODULES -->
            <section class="mt-8">

                <h2 class="text-xl font-extrabold text-slate-900">
                    System Management
                </h2>

                <p class="text-sm text-slate-500 mt-1">
                    Administrative modules and system operations.
                </p>

                <div class="grid sm:grid-cols-2 xl:grid-cols-3 gap-5 mt-5">

                    <!-- STUDENT MANAGEMENT -->
                    <a href="{{ route('admin.students.index') }}"
                       class="module-card block bg-white border border-slate-200 rounded-2xl p-6 shadow-sm hover:border-blue-300">

                        <div class="w-12 h-12 bg-blue-100 text-blue-700 rounded-xl flex items-center justify-center text-2xl">
                            ♙
                        </div>

                        <h3 class="font-extrabold text-slate-900 mt-4">
                            Student Management
                        </h3>

                        <p class="text-sm text-slate-500 mt-2">
                            Manage student accounts and student information.
                        </p>

                        <span class="inline-block mt-4 text-xs font-bold text-blue-700">
                            Manage Students →
                        </span>

                    </a>

                    <!-- ADMIN MANAGEMENT -->
                    <a href="{{ route('admin.admins.index') }}"
                       class="module-card block bg-white border border-slate-200 rounded-2xl p-6 shadow-sm hover:border-blue-300">

                        <div class="w-12 h-12 bg-indigo-100 text-indigo-700 rounded-xl flex items-center justify-center text-2xl">
                            ♟
                        </div>

                        <h3 class="font-extrabold text-slate-900 mt-4">
                            Admin Management
                        </h3>

                        <p class="text-sm text-slate-500 mt-2">
                            Create, view, edit, and delete administrator accounts.
                        </p>

                        <span class="inline-block mt-4 text-xs font-bold text-blue-700">
                            Manage Administrators →
                        </span>

                    </a>

                    <!-- COURSE MANAGEMENT -->
                    <a href="{{ route('admin.courses.index') }}"
                       class="module-card block bg-white border border-slate-200 rounded-2xl p-6 shadow-sm hover:border-blue-300">

                        <div class="w-12 h-12 bg-emerald-100 text-emerald-700 rounded-xl flex items-center justify-center text-2xl">
                            ▣
                        </div>

                        <h3 class="font-extrabold text-slate-900 mt-4">
                            Course Management
                        </h3>

                        <p class="text-sm text-slate-500 mt-2">
                            Add, view, edit, search, and delete courses.
                        </p>

                        <span class="inline-block mt-4 text-xs font-bold text-blue-700">
                            Manage Courses →
                        </span>

                    </a>

                    <!-- ACADEMIC RECORDS -->
                    <a href="{{ route('admin.records.index') }}"
                       class="module-card block bg-white border border-slate-200 rounded-2xl p-6 shadow-sm hover:border-purple-300">

                        <div class="w-12 h-12 bg-purple-100 text-purple-700 rounded-xl flex items-center justify-center text-2xl">
                            ▤
                        </div>

                        <h3 class="font-extrabold text-slate-900 mt-4">
                            Academic Records
                        </h3>

                        <p class="text-sm text-slate-500 mt-2">
                            Manage student grades and academic history.
                        </p>

                        <span class="inline-block mt-4 text-xs font-bold text-blue-700">
                            Manage Academic Records →
                        </span>

                    </a>

                    <!-- ENROLLMENT MANAGEMENT -->
                    <a href="{{ route('admin.enrollments.index') }}"
                       class="module-card block bg-white border border-slate-200 rounded-2xl p-6 shadow-sm hover:border-cyan-300">

                        <div class="w-12 h-12 bg-cyan-100 text-cyan-700 rounded-xl flex items-center justify-center text-2xl">
                            ▤
                        </div>

                        <h3 class="font-extrabold text-slate-900 mt-4">
                            Enrollment Management
                        </h3>

                        <p class="text-sm text-slate-500 mt-2">
                            View student enrollment requests and approve or reject pending applications.
                        </p>

                        <span class="inline-block mt-4 text-xs font-bold text-cyan-700">
                            Manage Enrollments →
                        </span>

                    </a>

                    <!-- ANNOUNCEMENTS -->
                    <a href="{{ route('admin.announcements.index') }}"
                       class="module-card block bg-white border border-slate-200 rounded-2xl p-6 shadow-sm hover:border-amber-300">

                        <div class="w-12 h-12 bg-amber-100 text-amber-700 rounded-xl flex items-center justify-center text-2xl">
                            ♧
                        </div>

                        <h3 class="font-extrabold text-slate-900 mt-4">
                            Announcements
                        </h3>

                        <p class="text-sm text-slate-500 mt-2">
                            Create, publish, edit, and manage important school announcements.
                        </p>

                        <span class="inline-block mt-4 text-xs font-bold text-amber-700">
                            Manage Announcements →
                        </span>

                    </a>

                    <!-- REPORTS -->
                    <a href="{{ route('admin.reports.index') }}"
                       class="module-card block bg-white border border-slate-200 rounded-2xl p-6 shadow-sm hover:border-rose-300">

                        <div class="w-12 h-12 bg-rose-100 text-rose-700 rounded-xl flex items-center justify-center text-2xl">
                            ▥
                        </div>

                        <h3 class="font-extrabold text-slate-900 mt-4">
                            Reports
                        </h3>

                        <p class="text-sm text-slate-500 mt-2">
                            View system statistics and academic records reports.
                        </p>

                        <span class="inline-block mt-4 text-xs font-bold text-rose-700">
                            View Reports →
                        </span>

                    </a>

                </div>

            </section>

            <!-- ACCOUNT INFORMATION -->
            <section id="settings"
                     class="mt-8 bg-white border border-slate-200 rounded-2xl p-6 shadow-sm">

                <h2 class="text-lg font-extrabold text-slate-900">
                    Administrator Account
                </h2>

                <div class="grid sm:grid-cols-2 gap-6 mt-5">

                    <div>
                        <p class="text-xs text-slate-400 uppercase font-bold">
                            Name
                        </p>

                        <p class="font-semibold text-slate-800 mt-1">
                            {{ auth()->user()->name }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs text-slate-400 uppercase font-bold">
                            Email
                        </p>

                        <p class="font-semibold text-slate-800 mt-1">
                            {{ auth()->user()->email }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs text-slate-400 uppercase font-bold">
                            Role
                        </p>

                        <p class="font-semibold text-slate-800 mt-1">
                            Administrator
                        </p>
                    </div>

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
