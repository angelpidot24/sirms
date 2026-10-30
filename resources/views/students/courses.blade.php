
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Courses | SIRMS</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700;800&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'DM Sans', sans-serif;
        }

        .heading-font {
            font-family: 'Playfair Display', serif;
        }

        .pink-gradient {
            background: linear-gradient(135deg, #ec4899, #be185d);
        }
    </style>
</head>

<body class="bg-pink-50/50 min-h-screen">

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
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-600 hover:bg-pink-50 hover:text-pink-700 transition">
                <span>▦</span> Dashboard
            </a>

            <a href="{{ route('students.profile') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-600 hover:bg-pink-50 hover:text-pink-700 transition">
                <span>♙</span> My Profile
            </a>

            <a href="{{ route('student.records') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-600 hover:bg-pink-50 hover:text-pink-700 transition">
                <span>▤</span> Academic Records
            </a>

            <a href="{{ route('student.courses') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl bg-pink-100 text-pink-700 font-bold">
                <span>▣</span> My Courses
            </a>

            <a href="{{ route('student.dashboard') }}#announcements"
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-600 hover:bg-pink-50 hover:text-pink-700 transition">
                <span>♧</span> Announcements
            </a>

        </nav>

        <div class="p-4 border-t border-pink-100">
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit"
                        class="w-full text-left px-4 py-3 rounded-xl text-red-600 hover:bg-red-50 font-semibold transition">
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
                <p class="text-sm text-gray-500">Student Portal / My Courses</p>
                <h2 class="text-xl font-extrabold text-gray-900">My Courses</h2>
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

            <!-- WELCOME BANNER -->
            <section class="pink-gradient rounded-3xl p-8 text-white shadow-lg shadow-pink-200">

                <p class="text-pink-100 text-sm font-semibold uppercase tracking-wider">
                    Course Registration
                </p>

                <h1 class="heading-font text-3xl sm:text-4xl mt-2">
                    Explore Your Courses
                </h1>

                <p class="text-pink-100 mt-3 max-w-2xl">
                    Browse the available courses and submit your enrollment requests through your SIRMS student portal.
                </p>

                <div class="mt-6 inline-block bg-white/20 rounded-xl px-4 py-2 text-sm">
                    Student ID: {{ auth()->user()->student_id ?? 'Not assigned' }}
                </div>

            </section>

            <!-- ALERT MESSAGES -->
            @if(session('success'))
                <div class="mt-6 bg-green-50 border border-green-200 text-green-700 px-5 py-4 rounded-xl">
                    <p class="font-semibold">{{ session('success') }}</p>
                </div>
            @endif

            @if(session('error'))
                <div class="mt-6 bg-red-50 border border-red-200 text-red-700 px-5 py-4 rounded-xl">
                    <p class="font-semibold">{{ session('error') }}</p>
                </div>
            @endif

            @if($errors->any())
                <div class="mt-6 bg-red-50 border border-red-200 text-red-700 px-5 py-4 rounded-xl">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <!-- SUMMARY CARDS -->
            <section class="mt-8">

                <h2 class="text-xl font-extrabold text-gray-900">
                    Enrollment Overview
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Your course registration summary.
                </p>

                <div class="grid sm:grid-cols-2 xl:grid-cols-3 gap-5 mt-5">

                    <div class="bg-white border border-pink-100 rounded-2xl p-6 shadow-sm">
                        <div class="w-12 h-12 bg-pink-100 text-pink-600 rounded-xl flex items-center justify-center text-2xl">
                            ▣
                        </div>

                        <p class="text-sm text-gray-500 mt-5">
                            Available Courses
                        </p>

                        <h3 class="text-3xl font-extrabold text-gray-900 mt-1">
                            {{ $totalCourses }}
                        </h3>

                        <p class="text-xs text-gray-400 mt-2">
                            Courses listed in SIRMS
                        </p>
                    </div>

                    <div class="bg-white border border-pink-100 rounded-2xl p-6 shadow-sm">
                        <div class="w-12 h-12 bg-purple-100 text-purple-600 rounded-xl flex items-center justify-center text-2xl">
                            ▤
                        </div>

                        <p class="text-sm text-gray-500 mt-5">
                            My Enrollment Requests
                        </p>

                        <h3 class="text-3xl font-extrabold text-gray-900 mt-1">
                            {{ $totalEnrollments }}
                        </h3>

                        <p class="text-xs text-gray-400 mt-2">
                            Courses you have requested
                        </p>
                    </div>

                    <div class="bg-white border border-pink-100 rounded-2xl p-6 shadow-sm">
                        <div class="w-12 h-12 bg-green-100 text-green-600 rounded-xl flex items-center justify-center text-2xl">
                            ✓
                        </div>

                        <p class="text-sm text-gray-500 mt-5">
                            Approved Courses
                        </p>

                        <h3 class="text-3xl font-extrabold text-gray-900 mt-1">
                            {{ $approvedEnrollments }}
                        </h3>

                        <p class="text-xs text-gray-400 mt-2">
                            Enrollment requests approved
                        </p>
                    </div>

                </div>

            </section>

            <!-- MY ENROLLMENTS -->
            <section class="mt-8 bg-white border border-pink-100 rounded-2xl shadow-sm overflow-hidden">

                <div class="p-6 border-b border-pink-100">
                    <h2 class="text-lg font-extrabold text-gray-900">
                        My Enrollment Requests
                    </h2>

                    <p class="text-sm text-gray-500 mt-1">
                        Track the status of the courses you have requested.
                    </p>
                </div>

                @if($myEnrollments->count() > 0)

                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left">

                            <thead class="bg-pink-50 text-gray-600 uppercase text-xs">
                                <tr>
                                    <th class="px-6 py-4 font-bold">Course Code</th>
                                    <th class="px-6 py-4 font-bold">Course Name</th>
                                    <th class="px-6 py-4 font-bold">Date Requested</th>
                                    <th class="px-6 py-4 font-bold">Status</th>
                                    <th class="px-6 py-4 font-bold">Action</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-pink-50">

                                @foreach($myEnrollments as $enrollment)

                                    <tr class="hover:bg-pink-50/50 transition">

                                        <td class="px-6 py-4 font-bold text-pink-700 whitespace-nowrap">
                                            {{ $enrollment->course->course_code ?? 'N/A' }}
                                        </td>

                                        <td class="px-6 py-4 font-semibold text-gray-800">
                                            {{ $enrollment->course->course_name ?? 'Course unavailable' }}
                                        </td>

                                        <td class="px-6 py-4 text-gray-600 whitespace-nowrap">
                                            {{ $enrollment->created_at->format('M d, Y') }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">

                                            @if($enrollment->status === 'Approved')
                                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold">
                                                    Approved
                                                </span>
                                            @elseif($enrollment->status === 'Rejected')
                                                <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-bold">
                                                    Rejected
                                                </span>
                                            @else
                                                <span class="bg-amber-100 text-amber-700 px-3 py-1 rounded-full text-xs font-bold">
                                                    Pending
                                                </span>
                                            @endif

                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">

                                            @if($enrollment->status === 'Pending')

                                                <form method="POST"
                                                      action="{{ route('student.courses.cancel', $enrollment) }}"
                                                      onsubmit="return confirm('Are you sure you want to cancel this enrollment request?')">

                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit"
                                                            class="text-red-600 hover:text-red-800 font-bold">
                                                        Cancel
                                                    </button>

                                                </form>

                                            @else

                                                <span class="text-gray-400 text-xs">
                                                    No action
                                                </span>

                                            @endif

                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>
                    </div>

                @else

                    <div class="p-8 text-center">
                        <div class="w-16 h-16 bg-pink-100 text-pink-500 rounded-full flex items-center justify-center text-3xl mx-auto">
                            ▤
                        </div>

                        <h3 class="font-extrabold text-gray-900 mt-4">
                            No Enrollment Requests Yet
                        </h3>

                        <p class="text-sm text-gray-500 mt-2">
                            Browse the available courses below to submit your first enrollment request.
                        </p>
                    </div>

                @endif

            </section>

            <!-- AVAILABLE COURSES -->
            <section class="mt-8">

                <div class="flex flex-wrap justify-between items-center gap-3">

                    <div>
                        <h2 class="text-xl font-extrabold text-gray-900">
                            Available Courses
                        </h2>

                        <p class="text-sm text-gray-500 mt-1">
                            Choose a course to submit your enrollment request.
                        </p>
                    </div>

                    <span class="bg-pink-100 text-pink-700 text-xs font-bold px-4 py-2 rounded-full">
                        {{ $courses->total() }} Courses
                    </span>

                </div>

                <!-- SEARCH -->
                <form method="GET" action="{{ route('student.courses') }}"
                      class="mt-5 flex flex-col sm:flex-row gap-3">

                    <input
                        type="text"
                        name="search"
                        value="{{ $search }}"
                        placeholder="Search by course code or course name..."
                        class="flex-1 bg-white border border-pink-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-pink-300">

                    <button type="submit"
                            class="pink-gradient text-white font-bold px-6 py-3 rounded-xl hover:opacity-90 transition">
                        Search Courses
                    </button>

                    @if($search)
                        <a href="{{ route('student.courses') }}"
                           class="bg-white border border-pink-200 text-gray-600 font-bold px-6 py-3 rounded-xl text-center hover:bg-pink-50 transition">
                            Clear
                        </a>
                    @endif

                </form>

                <!-- COURSE CARDS -->
                <div class="grid md:grid-cols-2 xl:grid-cols-3 gap-5 mt-6">

                    @forelse($courses as $course)

                        @php
                            $enrollment = $course->enrollments->first();
                        @endphp

                        <div class="bg-white border border-pink-100 rounded-2xl p-6 shadow-sm hover:shadow-md transition flex flex-col">

                            <div class="flex justify-between items-start gap-3">

                                <div class="w-12 h-12 bg-pink-100 text-pink-600 rounded-xl flex items-center justify-center text-2xl">
                                    ▣
                                </div>

                                @if($enrollment)

                                    @if($enrollment->status === 'Approved')
                                        <span class="bg-green-100 text-green-700 text-xs font-bold px-3 py-1 rounded-full">
                                            Approved
                                        </span>
                                    @elseif($enrollment->status === 'Rejected')
                                        <span class="bg-red-100 text-red-700 text-xs font-bold px-3 py-1 rounded-full">
                                            Rejected
                                        </span>
                                    @else
                                        <span class="bg-amber-100 text-amber-700 text-xs font-bold px-3 py-1 rounded-full">
                                            Pending
                                        </span>
                                    @endif

                                @else

                                    <span class="bg-pink-50 text-pink-600 text-xs font-bold px-3 py-1 rounded-full">
                                        Available
                                    </span>

                                @endif

                            </div>

                            <p class="text-xs text-pink-600 font-extrabold uppercase tracking-wider mt-5">
                                {{ $course->course_code }}
                            </p>

                            <h3 class="text-lg font-extrabold text-gray-900 mt-2">
                                {{ $course->course_name }}
                            </h3>

                            <p class="text-sm text-gray-500 mt-3 leading-relaxed flex-1">
                                {{ $course->description ?: 'No course description provided.' }}
                            </p>

                            <div class="border-t border-pink-100 mt-5 pt-5">

                                @if($enrollment)

                                    <button type="button"
                                            disabled
                                            class="w-full bg-gray-100 text-gray-400 font-bold py-3 rounded-xl cursor-not-allowed">
                                        Already Requested
                                    </button>

                                @else

                                    <form method="POST"
                                          action="{{ route('student.courses.enroll', $course) }}"
                                          onsubmit="return confirm('Do you want to submit an enrollment request for {{ addslashes($course->course_name) }}?')">

                                        @csrf

                                        <button type="submit"
                                                class="w-full pink-gradient hover:opacity-90 text-white font-bold py-3 rounded-xl transition">
                                            Enroll in This Course →
                                        </button>

                                    </form>

                                @endif

                            </div>

                        </div>

                    @empty

                        <div class="md:col-span-2 xl:col-span-3 bg-white border border-pink-100 rounded-2xl p-10 text-center">

                            <div class="w-16 h-16 bg-pink-100 text-pink-500 rounded-full flex items-center justify-center text-3xl mx-auto">
                                ▣
                            </div>

                            <h3 class="font-extrabold text-gray-900 mt-4">
                                No Courses Found
                            </h3>

                            <p class="text-sm text-gray-500 mt-2">
                                There are no available courses matching your search.
                            </p>

                        </div>

                    @endforelse

                </div>

                <!-- PAGINATION -->
                <div class="mt-6">
                    {{ $courses->links() }}
                </div>

            </section>

            <!-- INFORMATION -->
            <section class="mt-8 bg-pink-50 border border-pink-100 rounded-2xl p-5">

                <div class="flex gap-3">

                    <div class="text-pink-600 text-xl">ℹ</div>

                    <div>
                        <h3 class="font-bold text-pink-800">
                            Enrollment Information
                        </h3>

                        <p class="text-sm text-gray-600 mt-1">
                            Submitting an enrollment request does not automatically confirm your enrollment. Your request will remain pending until the administrator reviews it. You can cancel a pending request at any time.
                        </p>
                    </div>

                </div>

            </section>

            <!-- FOOTER -->
            <footer class="text-center text-xs text-gray-400 mt-10">
                © {{ date('Y') }} SIRMS Student Portal. All Rights Reserved.
            </footer>

        </div>

    </main>

</div>

</body>
</html>
