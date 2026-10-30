
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard | SIRMS</title>

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

        <!-- NAVIGATION -->
        <nav class="p-4 flex-1 space-y-2">

            <p class="text-xs font-bold uppercase tracking-widest text-gray-400 px-3 py-3">
                Student Menu
            </p>

            <a href="{{ route('student.dashboard') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl bg-pink-100 text-pink-700 font-bold">
                <span>▦</span>
                Dashboard
            </a>

            <a href="{{ route('students.profile') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-600 hover:bg-pink-50 hover:text-pink-700 transition">
                <span>♙</span>
                My Profile
            </a>

            <a href="{{ route('student.records') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-600 hover:bg-pink-50 hover:text-pink-700 transition">
                <span>▤</span>
                Academic Records
            </a>

            <a href="{{ route('student.courses') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-600 hover:bg-pink-50 hover:text-pink-700 transition">
                <span>▣</span>
                My Courses
            </a>

            <a href="{{ route('student.announcements') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-600 hover:bg-pink-50 hover:text-pink-700 transition">
                <span>♧</span>
                Announcements
            </a>

        </nav>

        <!-- LOGOUT -->
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
                <p class="text-sm text-gray-500">Student Portal / Dashboard</p>
                <h2 class="text-xl font-extrabold text-gray-900">My Dashboard</h2>
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

            <!-- WELCOME SECTION -->
            <section class="pink-gradient rounded-3xl p-8 text-white shadow-lg shadow-pink-200">

                <p class="text-pink-100 text-sm font-semibold">
                    WELCOME BACK!
                </p>

                <h1 class="heading-font text-3xl sm:text-4xl mt-2">
                    Hello, {{ auth()->user()->name }}!
                </h1>

                <p class="text-pink-100 mt-3 max-w-xl">
                    Welcome to your SIRMS student portal. You can access your personal information, courses, enrollment requests, academic records, and school announcements here.
                </p>

                <div class="mt-6 inline-block bg-white/20 rounded-xl px-4 py-2 text-sm">
                    Student ID: {{ auth()->user()->student_id ?? 'Not assigned' }}
                </div>

            </section>

            <!-- ACADEMIC OVERVIEW -->
            <section class="mt-8">

                <h2 class="text-xl font-extrabold text-gray-900">
                    My Academic Overview
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Your academic information at a glance.
                </p>

                <div class="grid sm:grid-cols-2 xl:grid-cols-3 gap-5 mt-5">

                    <!-- COURSES -->
                    <div class="bg-white border border-pink-100 rounded-2xl p-6 shadow-sm">

                        <div class="w-12 h-12 bg-pink-100 text-pink-600 rounded-xl flex items-center justify-center text-2xl">
                            ▣
                        </div>

                        <p class="text-sm text-gray-500 mt-5">
                            My Course Enrollment
                        </p>

                        <h3 class="text-3xl font-extrabold text-gray-900 mt-1">
                            View Courses
                        </h3>

                        <p class="text-xs text-gray-400 mt-2">
                            Browse courses and check your enrollment status.
                        </p>

                        <a href="{{ route('student.courses') }}"
                           class="text-xs text-pink-600 font-bold mt-3 inline-block hover:text-pink-800">
                            Browse Courses →
                        </a>

                    </div>

                    <!-- ACADEMIC RECORDS -->
                    <div class="bg-white border border-pink-100 rounded-2xl p-6 shadow-sm">

                        <div class="w-12 h-12 bg-purple-100 text-purple-600 rounded-xl flex items-center justify-center text-2xl">
                            ▤
                        </div>

                        <p class="text-sm text-gray-500 mt-5">
                            Academic Records
                        </p>

                        <h3 class="text-3xl font-extrabold text-gray-900 mt-1">
                            View Records
                        </h3>

                        <p class="text-xs text-gray-400 mt-2">
                            Check your grades and academic history.
                        </p>

                        <a href="{{ route('student.records') }}"
                           class="text-xs text-pink-600 font-bold mt-3 inline-block hover:text-pink-800">
                            View Records →
                        </a>

                    </div>

                    <!-- ANNOUNCEMENTS SUMMARY -->
                    <div class="bg-white border border-pink-100 rounded-2xl p-6 shadow-sm">

                        <div class="w-12 h-12 bg-amber-100 text-amber-600 rounded-xl flex items-center justify-center text-2xl">
                            ♧
                        </div>

                        <p class="text-sm text-gray-500 mt-5">
                            Published Announcements
                        </p>

                        <h3 class="text-3xl font-extrabold text-gray-900 mt-1">
                            {{ $announcements->count() }}
                        </h3>

                        <p class="text-xs text-gray-400 mt-2">
                            Latest announcements available to students.
                        </p>

                        <a href="{{ route('student.announcements') }}"
                           class="text-xs text-pink-600 font-bold mt-3 inline-block hover:text-pink-800">
                            View Announcements →
                        </a>

                    </div>

                </div>

            </section>

            <!-- MY PROFILE -->
            <section id="profile" class="mt-8 bg-white border border-pink-100 rounded-2xl p-6 shadow-sm">

                <div class="flex flex-wrap justify-between items-center gap-3">

                    <div>
                        <h2 class="text-lg font-extrabold text-gray-900">
                            My Profile
                        </h2>

                        <p class="text-sm text-gray-500 mt-1">
                            Your registered account information.
                        </p>
                    </div>

                    <a href="{{ route('students.profile') }}"
                       class="bg-pink-500 hover:bg-pink-600 text-white text-sm font-bold px-5 py-2.5 rounded-xl transition">
                        Edit Profile →
                    </a>

                </div>

                <div class="flex flex-wrap items-center gap-5 mt-6">

                    <div class="w-20 h-20 rounded-full bg-pink-100 text-pink-600 flex items-center justify-center text-3xl font-bold overflow-hidden">

                        @if(auth()->user()->profile_photo_path)

                            <img src="{{ asset('storage/' . auth()->user()->profile_photo_path) }}"
                                 alt="Profile photo"
                                 class="w-full h-full object-cover">

                        @else

                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}

                        @endif

                    </div>

                    <div>

                        <h3 class="font-extrabold text-gray-900 text-lg">
                            {{ auth()->user()->name }}
                        </h3>

                        <p class="text-sm text-pink-600 font-semibold">
                            Student Account
                        </p>

                        <p class="text-sm text-gray-500 mt-1">
                            {{ auth()->user()->email }}
                        </p>

                    </div>

                </div>

                <div class="grid sm:grid-cols-2 gap-6 mt-6 border-t border-pink-100 pt-6">

                    <div>
                        <p class="text-xs text-gray-400 uppercase font-bold">
                            Full Name
                        </p>

                        <p class="font-semibold text-gray-800 mt-1">
                            {{ auth()->user()->name }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs text-gray-400 uppercase font-bold">
                            Student ID
                        </p>

                        <p class="font-semibold text-gray-800 mt-1">
                            {{ auth()->user()->student_id ?? 'Not assigned' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs text-gray-400 uppercase font-bold">
                            Email Address
                        </p>

                        <p class="font-semibold text-gray-800 mt-1">
                            {{ auth()->user()->email }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs text-gray-400 uppercase font-bold">
                            Account Type
                        </p>

                        <p class="font-semibold text-gray-800 mt-1">
                            Student
                        </p>
                    </div>

                </div>

            </section>

            <!-- ACADEMIC RECORDS AND COURSES -->
            <div class="grid lg:grid-cols-2 gap-5 mt-6">

                <!-- ACADEMIC RECORDS -->
                <section id="records" class="bg-white border border-pink-100 rounded-2xl p-6">

                    <div class="flex flex-wrap justify-between items-center gap-3">

                        <div>
                            <h2 class="font-extrabold text-gray-900">
                                Academic Records
                            </h2>

                            <p class="text-sm text-gray-500 mt-2">
                                View your grades and academic history.
                            </p>
                        </div>

                        <a href="{{ route('student.records') }}"
                           class="bg-pink-500 hover:bg-pink-600 text-white text-sm font-bold px-5 py-2.5 rounded-xl transition">
                            View Records →
                        </a>

                    </div>

                </section>

                <!-- MY COURSES -->
                <section id="courses" class="bg-white border border-pink-100 rounded-2xl p-6">

                    <div class="flex items-center gap-3">

                        <div class="w-11 h-11 bg-pink-100 text-pink-600 rounded-xl flex items-center justify-center text-xl">
                            ▣
                        </div>

                        <div>
                            <h2 class="font-extrabold text-gray-900">
                                My Courses
                            </h2>

                            <p class="text-xs text-gray-400">
                                Courses and enrollment
                            </p>
                        </div>

                    </div>

                    <p class="text-sm text-gray-500 mt-4">
                        Browse the available courses offered by your school. You can submit an enrollment request and monitor its approval status through your student portal.
                    </p>

                    <div class="mt-5 bg-pink-50 rounded-xl p-4">

                        <p class="text-sm text-pink-700 font-semibold">
                            Course Enrollment
                        </p>

                        <p class="text-xs text-gray-500 mt-1">
                            Submit your enrollment request and wait for administrator approval.
                        </p>

                    </div>

                    <a href="{{ route('student.courses') }}"
                       class="inline-block mt-5 bg-pink-500 hover:bg-pink-600 text-white text-sm font-bold px-5 py-3 rounded-xl transition">
                        Browse Courses & Enroll →
                    </a>

                </section>

            </div>

            <!-- DYNAMIC ANNOUNCEMENTS -->
            <section id="announcements" class="mt-6 bg-white border border-pink-100 rounded-2xl p-6 shadow-sm">

                <div class="flex flex-wrap justify-between items-center gap-3">

                    <div>
                        <h2 class="text-xl font-extrabold text-gray-900">
                            Latest School Announcements
                        </h2>

                        <p class="text-sm text-gray-500 mt-1">
                            Important updates published by the school administrator.
                        </p>
                    </div>

                    <a href="{{ route('student.announcements') }}"
                       class="bg-pink-500 hover:bg-pink-600 text-white text-sm font-bold px-5 py-2.5 rounded-xl transition">
                        View All Announcements →
                    </a>

                </div>

                <div class="mt-6 space-y-4">

                    @forelse($announcements as $announcement)

                        <article class="border border-pink-100 rounded-xl p-5 hover:bg-pink-50/50 transition">

                            <div class="flex flex-wrap justify-between items-start gap-3">

                                <div class="flex-1 min-w-0">

                                    <div class="flex items-center gap-2 mb-2">

                                        <span class="bg-pink-100 text-pink-700 text-xs font-bold px-3 py-1 rounded-full">
                                            School Announcement
                                        </span>

                                        <span class="text-xs text-gray-400">
                                            {{ optional($announcement->published_at ?? $announcement->created_at)->format('M d, Y') }}
                                        </span>

                                    </div>

                                    <h3 class="text-lg font-extrabold text-gray-900">
                                        {{ $announcement->title }}
                                    </h3>

                                </div>

                                <span class="text-green-600 text-xs font-bold bg-green-50 px-3 py-1 rounded-full">
                                    Published
                                </span>

                            </div>

                            <div class="text-sm text-gray-600 mt-3 leading-relaxed whitespace-pre-line">
                                {{ \Illuminate\Support\Str::limit($announcement->content, 250) }}
                            </div>

                        </article>

                    @empty

                        <div class="bg-amber-50 border border-amber-100 rounded-xl p-6 text-center">

                            <div class="text-3xl mb-3">
                                ♧
                            </div>

                            <h3 class="font-bold text-amber-800">
                                No announcements available
                            </h3>

                            <p class="text-sm text-gray-500 mt-2">
                                There are currently no published announcements. Please check again later for school updates.
                            </p>

                        </div>

                    @endforelse

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
