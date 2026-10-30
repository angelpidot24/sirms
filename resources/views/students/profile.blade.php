<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile | SIRMS</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'DM Sans', sans-serif; }
        .sidebar-link { transition: .2s ease; }
        .sidebar-link:hover { background: #fce7f3; color: #be185d; }
    </style>
</head>

<body class="min-h-screen bg-[#fff7fb] text-slate-800">

<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <aside class="hidden w-64 shrink-0 border-r border-pink-100 bg-white p-6 md:flex md:flex-col">
        <div class="mb-10">
            <div class="flex items-center gap-3">
                <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-pink-500 text-xl font-extrabold text-white">
                    S
                </div>
                <div>
                    <h1 class="text-xl font-extrabold text-slate-800">SIRMS</h1>
                    <p class="text-xs text-slate-400">Student Portal</p>
                </div>
            </div>
        </div>

        <p class="mb-3 text-xs font-bold uppercase tracking-wider text-slate-400">Student Menu</p>

        <nav class="space-y-2">
            <a href="{{ route('student.dashboard') }}"
               class="sidebar-link flex items-center gap-3 rounded-xl px-4 py-3 font-semibold text-slate-600">
                <span>▦</span> Dashboard
            </a>

            <a href="{{ route('students.profile') }}"
               class="flex items-center gap-3 rounded-xl bg-pink-500 px-4 py-3 font-semibold text-white">
                <span>♙</span> My Profile
            </a>

            <a href="{{ route('student.dashboard') }}#records"
               class="sidebar-link flex items-center gap-3 rounded-xl px-4 py-3 font-semibold text-slate-600">
                <span>▤</span> Academic Records
            </a>

            <a href="{{ route('student.dashboard') }}#announcements"
               class="sidebar-link flex items-center gap-3 rounded-xl px-4 py-3 font-semibold text-slate-600">
                <span>▧</span> Announcements
            </a>
        </nav>

        <div class="mt-auto border-t border-pink-100 pt-5">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="w-full rounded-xl px-4 py-3 text-left font-semibold text-rose-500 transition hover:bg-rose-50">
                    ↪ Log Out
                </button>
            </form>
        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="min-w-0 flex-1">

        <!-- TOP BAR -->
        <header class="flex flex-wrap items-center justify-between gap-4 border-b border-pink-100 bg-white px-6 py-5 md:px-10">
            <div>
                <p class="text-sm font-medium text-pink-500">Student Portal</p>
                <h2 class="text-2xl font-extrabold text-slate-800">My Profile</h2>
            </div>

            <div class="flex items-center gap-3">
                <div class="text-right">
                    <p class="font-bold text-slate-800">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-slate-400">Student Account</p>
                </div>

                <div class="flex h-11 w-11 items-center justify-center overflow-hidden rounded-full bg-pink-100 font-bold text-pink-600">
                    @if(auth()->user()->profile_photo_path)
                        <img src="{{ asset('storage/' . auth()->user()->profile_photo_path) }}"
                             alt="Profile photo"
                             class="h-full w-full object-cover">
                    @else
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    @endif
                </div>
            </div>
        </header>

        <div class="mx-auto max-w-6xl space-y-6 p-6 md:p-10">

            <!-- INTRO -->
            <section>
                <h3 class="text-xl font-extrabold text-slate-800">Account Settings</h3>
                <p class="mt-1 text-sm text-slate-500">
                    Manage your personal information and account security.
                </p>
            </section>

            @if(session('success'))
                <div class="rounded-xl border border-green-200 bg-green-50 px-5 py-4 text-sm font-semibold text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('password_success'))
                <div class="rounded-xl border border-green-200 bg-green-50 px-5 py-4 text-sm font-semibold text-green-700">
                    {{ session('password_success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="rounded-xl border border-red-200 bg-red-50 px-5 py-4 text-sm text-red-700">
                    <p class="mb-2 font-bold">Please check the following:</p>
                    <ul class="list-inside list-disc space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- PROFILE CARD -->
            <section class="overflow-hidden rounded-3xl border border-pink-100 bg-white shadow-sm">
                <div class="bg-gradient-to-r from-pink-500 to-rose-400 px-7 py-7 text-white">
                    <p class="text-sm font-medium text-pink-100">Personal Information</p>
                    <h3 class="mt-1 text-2xl font-extrabold">Your Profile</h3>
                    <p class="mt-2 text-sm text-pink-50">
                        Keep your student account information updated.
                    </p>
                </div>

                <form action="{{ route('students.profile.update') }}"
                      method="POST"
                      enctype="multipart/form-data"
                      class="space-y-6 p-6 md:p-8">
                    @csrf
                    @method('PUT')

                    <div class="flex flex-wrap items-center gap-5">
                        <div class="flex h-24 w-24 items-center justify-center overflow-hidden rounded-full border-4 border-pink-100 bg-pink-50 text-3xl font-extrabold text-pink-500">
                            @if(auth()->user()->profile_photo_path)
                                <img src="{{ asset('storage/' . auth()->user()->profile_photo_path) }}"
                                     alt="Profile photo"
                                     class="h-full w-full object-cover">
                            @else
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            @endif
                        </div>

                        <div>
                            <h4 class="font-bold text-slate-800">Profile Photo</h4>
                            <p class="mt-1 text-sm text-slate-500">JPG, PNG, or WEBP. Maximum size: 2 MB.</p>
                            <input type="file"
                                   name="profile_photo"
                                   accept=".jpg,.jpeg,.png,.webp"
                                   class="mt-3 block w-full max-w-xs text-sm text-slate-600 file:mr-3 file:rounded-lg file:border-0 file:bg-pink-100 file:px-4 file:py-2 file:font-semibold file:text-pink-700 hover:file:bg-pink-200">
                            @error('profile_photo')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid gap-5 md:grid-cols-2">
                        <div>
                            <label class="mb-2 block text-sm font-bold text-slate-700">Full Name</label>
                            <input type="text"
                                   name="name"
                                   value="{{ old('name', auth()->user()->name) }}"
                                   required
                                   class="w-full rounded-xl border border-slate-200 px-4 py-3 outline-none transition focus:border-pink-400 focus:ring-2 focus:ring-pink-100">
                            @error('name')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-bold text-slate-700">Email Address</label>
                            <input type="email"
                                   name="email"
                                   value="{{ old('email', auth()->user()->email) }}"
                                   required
                                   class="w-full rounded-xl border border-slate-200 px-4 py-3 outline-none transition focus:border-pink-400 focus:ring-2 focus:ring-pink-100">
                            @error('email')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-bold text-slate-700">Student ID</label>
                            <input type="text"
                                   value="{{ auth()->user()->student_id }}"
                                   readonly
                                   class="w-full cursor-not-allowed rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-500">
                            <p class="mt-1 text-xs text-slate-400">Contact the administrator if this needs correction.</p>
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-bold text-slate-700">Account Role</label>
                            <input type="text"
                                   value="{{ ucfirst(auth()->user()->role) }}"
                                   readonly
                                   class="w-full cursor-not-allowed rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-500">
                        </div>
                    </div>

                    <div class="flex justify-end border-t border-slate-100 pt-5">
                        <button type="submit"
                                class="rounded-xl bg-pink-500 px-7 py-3 font-bold text-white shadow-sm transition hover:bg-pink-600">
                            Save Changes
                        </button>
                    </div>
                </form>
            </section>

            <!-- CHANGE PASSWORD -->
            <section class="rounded-3xl border border-pink-100 bg-white p-6 shadow-sm md:p-8">
                <div class="mb-6">
                    <h3 class="text-xl font-extrabold text-slate-800">Change Password</h3>
                    <p class="mt-1 text-sm text-slate-500">
                        Update your password to help keep your account secure.
                    </p>
                </div>

                <form action="{{ route('students.password.update') }}"
                      method="POST"
                      class="space-y-5">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="mb-2 block text-sm font-bold text-slate-700">Current Password</label>
                        <input type="password"
                               name="current_password"
                               required
                               autocomplete="current-password"
                               class="w-full rounded-xl border border-slate-200 px-4 py-3 outline-none focus:border-pink-400 focus:ring-2 focus:ring-pink-100">
                        @error('current_password')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid gap-5 md:grid-cols-2">
                        <div>
                            <label class="mb-2 block text-sm font-bold text-slate-700">New Password</label>
                            <input type="password"
                                   name="password"
                                   required
                                   autocomplete="new-password"
                                   class="w-full rounded-xl border border-slate-200 px-4 py-3 outline-none focus:border-pink-400 focus:ring-2 focus:ring-pink-100">
                            @error('password')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-bold text-slate-700">Confirm New Password</label>
                            <input type="password"
                                   name="password_confirmation"
                                   required
                                   autocomplete="new-password"
                                   class="w-full rounded-xl border border-slate-200 px-4 py-3 outline-none focus:border-pink-400 focus:ring-2 focus:ring-pink-100">
                        </div>
                    </div>

                    <div class="flex justify-end border-t border-slate-100 pt-5">
                        <button type="submit"
                                class="rounded-xl bg-slate-800 px-7 py-3 font-bold text-white transition hover:bg-slate-900">
                            Update Password
                        </button>
                    </div>
                </form>
            </section>

            <p class="pb-5 text-center text-xs text-slate-400">
                SIRMS · Student Information and Records Management System
            </p>

        </div>
    </main>
</div>

</body>
</html>