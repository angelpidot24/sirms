<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enrollment Management | SIRMS</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'DM Sans', sans-serif;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            border-radius: 12px;
            color: #cbd5e1;
            transition: .2s;
        }

        .sidebar-link:hover,
        .sidebar-active {
            background: #334155;
            color: white;
        }
    </style>
</head>

<body class="bg-slate-100 min-h-screen">

<div class="min-h-screen flex">

    <!-- SIDEBAR -->
    <aside class="hidden md:flex w-64 bg-slate-900 text-white flex-col">

        <div class="p-6 border-b border-slate-700">
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 bg-blue-600 rounded-xl flex items-center justify-center text-xl font-extrabold">
                    S
                </div>

                <div>
                    <h1 class="text-xl font-extrabold">SIRMS</h1>
                    <p class="text-xs text-slate-400">Administration Panel</p>
                </div>
            </div>
        </div>

        <nav class="p-4 flex-1 space-y-2">

            <p class="text-xs font-bold uppercase tracking-widest text-slate-500 px-3 py-3">
                Main Menu
            </p>

            <a href="{{ route('dashboard') }}" class="sidebar-link">
                <span>▦</span>
                Dashboard
            </a>

            <a href="{{ route('admin.students.index') }}" class="sidebar-link">
                <span>♙</span>
                Student Management
            </a>

            <a href="{{ route('admin.admins.index') }}" class="sidebar-link">
                <span>♧</span>
                Admin Management
            </a>

            <a href="{{ route('admin.courses.index') }}" class="sidebar-link">
                <span>▣</span>
                Course Management
            </a>

            <a href="{{ route('admin.enrollments.index') }}" class="sidebar-link sidebar-active">
                <span>▤</span>
                Enrollment Management
            </a>

            <a href="{{ route('admin.records.index') }}" class="sidebar-link">
                <span>▥</span>
                Academic Records
            </a>

            <a href="{{ route('admin.announcements.index') }}" class="sidebar-link">
                <span>♧</span>
                Announcements
            </a>

            <a href="{{ route('admin.reports.index') }}" class="sidebar-link">
                <span>▧</span>
                Reports
            </a>

        </nav>

        <div class="p-4 border-t border-slate-700">
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit"
                        class="w-full text-left px-4 py-3 rounded-xl text-red-300 hover:bg-red-500/10 font-semibold transition">
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
                <p class="text-sm text-slate-500">Administration / Enrollment Management</p>
                <h2 class="text-xl font-extrabold text-slate-900">Enrollment Requests</h2>
            </div>

            <div class="text-right">
                <p class="text-sm font-bold text-slate-800">
                    {{ auth()->user()->name }}
                </p>
                <p class="text-xs text-blue-600">Administrator</p>
            </div>

        </header>

        <div class="p-6 lg:p-8 max-w-7xl mx-auto">

            <!-- PAGE INTRO -->
            <section class="bg-slate-900 rounded-2xl p-7 text-white">

                <p class="text-blue-300 text-sm font-semibold">
                    STUDENT SERVICES
                </p>

                <h1 class="text-3xl font-extrabold mt-2">
                    Enrollment Management
                </h1>

                <p class="text-slate-300 text-sm mt-3 max-w-2xl">
                    Review student course enrollment requests. Approve or reject pending requests and monitor their current status.
                </p>

            </section>

            <!-- SUCCESS MESSAGE -->
            @if(session('success'))
                <div class="mt-6 bg-green-50 border border-green-200 text-green-700 rounded-xl p-4 text-sm font-semibold">
                    {{ session('success') }}
                </div>
            @endif

            <!-- VALIDATION ERRORS -->
            @if($errors->any())
                <div class="mt-6 bg-red-50 border border-red-200 text-red-700 rounded-xl p-4">
                    <p class="font-bold text-sm">Please check the following:</p>
                    <ul class="list-disc ml-5 mt-2 text-sm">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- STATISTICS -->
            <section class="grid sm:grid-cols-2 xl:grid-cols-4 gap-5 mt-7">

                <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm">
                    <p class="text-sm text-slate-500">Total Requests</p>
                    <h3 class="text-3xl font-extrabold text-slate-900 mt-2">
                        {{ $totalEnrollments }}
                    </h3>
                </div>

                <div class="bg-white border border-amber-200 rounded-2xl p-5 shadow-sm">
                    <p class="text-sm text-amber-600">Pending Requests</p>
                    <h3 class="text-3xl font-extrabold text-amber-600 mt-2">
                        {{ $pendingEnrollments }}
                    </h3>
                </div>

                <div class="bg-white border border-green-200 rounded-2xl p-5 shadow-sm">
                    <p class="text-sm text-green-600">Approved</p>
                    <h3 class="text-3xl font-extrabold text-green-600 mt-2">
                        {{ $approvedEnrollments }}
                    </h3>
                </div>

                <div class="bg-white border border-red-200 rounded-2xl p-5 shadow-sm">
                    <p class="text-sm text-red-600">Rejected</p>
                    <h3 class="text-3xl font-extrabold text-red-600 mt-2">
                        {{ $rejectedEnrollments }}
                    </h3>
                </div>

            </section>

            <!-- ENROLLMENT TABLE -->
            <section class="mt-8 bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">

                <div class="p-6 border-b border-slate-200">

                    <h2 class="text-lg font-extrabold text-slate-900">
                        Student Enrollment Requests
                    </h2>

                    <p class="text-sm text-slate-500 mt-1">
                        Review the details and update the status of each request.
                    </p>

                    <!-- SEARCH AND FILTER -->
                    <form method="GET"
                          action="{{ route('admin.enrollments.index') }}"
                          class="flex flex-col md:flex-row gap-3 mt-5">

                        <input
                            type="text"
                            name="search"
                            value="{{ $search }}"
                            placeholder="Search student, ID, email, or course..."
                            class="flex-1 border border-slate-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-300"
                        >

                        <select
                            name="status"
                            class="border border-slate-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-300">

                            <option value="">All Statuses</option>
                            <option value="Pending" {{ $status === 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="Approved" {{ $status === 'Approved' ? 'selected' : '' }}>Approved</option>
                            <option value="Rejected" {{ $status === 'Rejected' ? 'selected' : '' }}>Rejected</option>

                        </select>

                        <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-6 py-3 rounded-xl transition">
                            Filter
                        </button>

                        @if($search || $status)
                            <a href="{{ route('admin.enrollments.index') }}"
                               class="bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold px-5 py-3 rounded-xl text-center transition">
                                Clear
                            </a>
                        @endif

                    </form>

                </div>

                <div class="overflow-x-auto">

                    <table class="w-full text-sm text-left">

                        <thead class="bg-slate-50 text-slate-600 uppercase text-xs">
                            <tr>
                                <th class="px-6 py-4">Student</th>
                                <th class="px-6 py-4">Student ID</th>
                                <th class="px-6 py-4">Course</th>
                                <th class="px-6 py-4">Date Requested</th>
                                <th class="px-6 py-4">Status</th>
                                <th class="px-6 py-4">Action</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-slate-100">

                            @forelse($enrollments as $enrollment)

                                <tr class="hover:bg-slate-50">

                                    <td class="px-6 py-4">
                                        <p class="font-bold text-slate-800">
                                            {{ $enrollment->student->name ?? 'Student not available' }}
                                        </p>
                                        <p class="text-xs text-slate-400 mt-1">
                                            {{ $enrollment->student->email ?? 'No email' }}
                                        </p>
                                    </td>

                                    <td class="px-6 py-4 text-slate-600">
                                        {{ $enrollment->student->student_id ?? 'Not assigned' }}
                                    </td>

                                    <td class="px-6 py-4">
                                        <p class="font-bold text-slate-800">
                                            {{ $enrollment->course->course_code ?? 'N/A' }}
                                        </p>
                                        <p class="text-xs text-slate-500 mt-1">
                                            {{ $enrollment->course->course_name ?? 'Course not available' }}
                                        </p>
                                    </td>

                                    <td class="px-6 py-4 text-slate-600">
                                        {{ $enrollment->created_at->format('M d, Y') }}
                                        <p class="text-xs text-slate-400 mt-1">
                                            {{ $enrollment->created_at->format('h:i A') }}
                                        </p>
                                    </td>

                                    <td class="px-6 py-4">

                                        @if($enrollment->status === 'Pending')
                                            <span class="inline-flex bg-amber-100 text-amber-700 px-3 py-1.5 rounded-full text-xs font-bold">
                                                Pending
                                            </span>
                                        @elseif($enrollment->status === 'Approved')
                                            <span class="inline-flex bg-green-100 text-green-700 px-3 py-1.5 rounded-full text-xs font-bold">
                                                Approved
                                            </span>
                                        @else
                                            <span class="inline-flex bg-red-100 text-red-700 px-3 py-1.5 rounded-full text-xs font-bold">
                                                Rejected
                                            </span>
                                        @endif

                                    </td>

                                    <td class="px-6 py-4">

                                        @if($enrollment->status === 'Pending')

                                            <div class="flex flex-wrap gap-2">

                                                <form method="POST"
                                                      action="{{ route('admin.enrollments.updateStatus', $enrollment) }}"
                                                      onsubmit="return confirm('Approve this student enrollment request?')">
                                                    @csrf
                                                    @method('PATCH')

                                                    <input type="hidden" name="status" value="Approved">

                                                    <button type="submit"
                                                            class="bg-green-600 hover:bg-green-700 text-white text-xs font-bold px-3 py-2 rounded-lg transition">
                                                        Approve
                                                    </button>
                                                </form>

                                                <form method="POST"
                                                      action="{{ route('admin.enrollments.updateStatus', $enrollment) }}"
                                                      onsubmit="return confirm('Reject this student enrollment request?')">
                                                    @csrf
                                                    @method('PATCH')

                                                    <input type="hidden" name="status" value="Rejected">

                                                    <button type="submit"
                                                            class="bg-red-600 hover:bg-red-700 text-white text-xs font-bold px-3 py-2 rounded-lg transition">
                                                        Reject
                                                    </button>
                                                </form>

                                            </div>

                                        @else

                                            <span class="text-xs text-slate-400 font-semibold">
                                                No action available
                                            </span>

                                        @endif

                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center">

                                        <div class="text-4xl text-slate-300">▤</div>

                                        <h3 class="font-extrabold text-slate-700 mt-4">
                                            No Enrollment Requests Found
                                        </h3>

                                        <p class="text-sm text-slate-400 mt-2">
                                            Student enrollment requests will appear here.
                                        </p>

                                    </td>
                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

                <!-- PAGINATION -->
                @if($enrollments->hasPages())
                    <div class="p-5 border-t border-slate-100">
                        {{ $enrollments->links() }}
                    </div>
                @endif

            </section>

            <!-- INFORMATION -->
            <section class="mt-6 bg-blue-50 border border-blue-100 rounded-2xl p-5">

                <h3 class="font-bold text-blue-800">
                    Enrollment Management Reminder
                </h3>

                <p class="text-sm text-blue-700 mt-2">
                    Review the student's information and requested course before approving or rejecting an enrollment. Only pending requests can be processed from this page.
                </p>

            </section>

            <footer class="text-center text-xs text-slate-400 mt-10">
                © {{ date('Y') }} SIRMS Administration Panel. All Rights Reserved.
            </footer>

        </div>

    </main>

</div>

</body>
</html>