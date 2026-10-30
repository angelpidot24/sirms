<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ isset($course) ? 'Edit Course' : 'Add Course' }} | SIRMS</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'DM Sans', sans-serif;
        }
    </style>
</head>

<body class="min-h-screen bg-slate-100">

<div class="min-h-screen flex">

    <!-- SIDEBAR -->
    <aside class="hidden md:flex w-64 bg-slate-950 text-white flex-col">

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

        <nav class="p-4 flex-1 space-y-2">

            <a href="{{ route('dashboard') }}"
               class="block px-4 py-3 rounded-xl text-slate-300 hover:bg-slate-800">
                ▦ Dashboard
            </a>

            <a href="{{ route('admin.students.index') }}"
               class="block px-4 py-3 rounded-xl text-slate-300 hover:bg-slate-800">
                ♙ Student Management
            </a>

            <a href="{{ route('admin.admins.index') }}"
               class="block px-4 py-3 rounded-xl text-slate-300 hover:bg-slate-800">
                ♟ Admin Management
            </a>

            <a href="{{ route('admin.courses.index') }}"
               class="block px-4 py-3 rounded-xl bg-blue-600 text-white font-bold">
                ▣ Course Management
            </a>

        </nav>

        <div class="p-4 border-t border-slate-800">
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit"
                        class="w-full text-left px-4 py-3 rounded-xl text-red-300 hover:bg-slate-800">
                    ↪ Sign Out
                </button>
            </form>
        </div>

    </aside>

    <!-- MAIN CONTENT -->
    <main class="flex-1 min-w-0">

        <header class="bg-white border-b border-slate-200 px-6 py-5">

            <p class="text-sm text-slate-500">
                Administration / Course Management / {{ isset($course) ? 'Edit' : 'Add' }}
            </p>

            <h2 class="text-xl font-extrabold text-slate-900 mt-1">
                {{ isset($course) ? 'Edit Course' : 'Add New Course' }}
            </h2>

        </header>

        <div class="p-6 lg:p-8 max-w-4xl mx-auto">

            <a href="{{ route('admin.courses.index') }}"
               class="inline-flex items-center gap-2 text-sm font-bold text-blue-700 hover:text-blue-900 mb-6">
                ← Back to Course Management
            </a>

            <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">

                <!-- FORM HEADER -->
                <div class="bg-slate-950 p-6 text-white">

                    <div class="flex items-center gap-4">

                        <div class="w-14 h-14 rounded-xl bg-blue-600 flex items-center justify-center text-3xl">
                            ▣
                        </div>

                        <div>
                            <h1 class="text-xl font-extrabold">
                                {{ isset($course) ? 'Update Course Information' : 'Create a New Course' }}
                            </h1>

                            <p class="text-sm text-slate-300 mt-1">
                                Enter the course details below.
                            </p>
                        </div>

                    </div>

                </div>

                <!-- FORM -->
                <form
                    method="POST"
                    action="{{ isset($course) ? route('admin.courses.update', $course) : route('admin.courses.store') }}"
                    class="p-6 sm:p-8 space-y-6">

                    @csrf

                    @if(isset($course))
                        @method('PUT')
                    @endif

                    <!-- VALIDATION ERRORS -->
                    @if($errors->any())
                        <div class="rounded-xl border border-red-200 bg-red-50 p-4 text-red-800">

                            <p class="font-bold mb-2">
                                Please correct the following errors:
                            </p>

                            <ul class="list-disc pl-5 space-y-1 text-sm">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>

                        </div>
                    @endif

                    <!-- COURSE CODE -->
                    <div>

                        <label for="course_code" class="block text-sm font-bold text-slate-700 mb-2">
                            Course Code <span class="text-red-500">*</span>
                        </label>

                        <input
                            type="text"
                            id="course_code"
                            name="course_code"
                            value="{{ old('course_code', $course->course_code ?? '') }}"
                            placeholder="Example: BSIT"
                            maxlength="50"
                            required
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                        >

                        @error('course_code')
                            <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                        @enderror

                        <p class="text-xs text-slate-400 mt-2">
                            Each course must have a unique course code.
                        </p>

                    </div>

                    <!-- COURSE NAME -->
                    <div>

                        <label for="course_name" class="block text-sm font-bold text-slate-700 mb-2">
                            Course Name <span class="text-red-500">*</span>
                        </label>

                        <input
                            type="text"
                            id="course_name"
                            name="course_name"
                            value="{{ old('course_name', $course->course_name ?? '') }}"
                            placeholder="Example: Bachelor of Science in Information Technology"
                            maxlength="255"
                            required
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                        >

                        @error('course_name')
                            <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                        @enderror

                    </div>

                    <!-- DESCRIPTION -->
                    <div>

                        <label for="description" class="block text-sm font-bold text-slate-700 mb-2">
                            Description
                        </label>

                        <textarea
                            id="description"
                            name="description"
                            rows="5"
                            maxlength="2000"
                            placeholder="Enter a brief description of the course..."
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                        >{{ old('description', $course->description ?? '') }}</textarea>

                        @error('description')
                            <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                        @enderror

                        <p class="text-xs text-slate-400 mt-2">
                            Optional. Maximum 2,000 characters.
                        </p>

                    </div>

                    <!-- BUTTONS -->
                    <div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-3 pt-4 border-t border-slate-200">

                        <a href="{{ route('admin.courses.index') }}"
                           class="text-center rounded-xl border border-slate-300 px-6 py-3 font-bold text-slate-600 hover:bg-slate-50">
                            Cancel
                        </a>

                        <button
                            type="submit"
                            class="rounded-xl bg-blue-700 hover:bg-blue-800 text-white px-6 py-3 font-bold shadow-sm">

                            {{ isset($course) ? 'Save Changes' : 'Create Course' }}

                        </button>

                    </div>

                </form>

            </div>

            <footer class="text-center text-xs text-slate-400 mt-8">
                © {{ date('Y') }} SIRMS Administration Portal.
            </footer>

        </div>

    </main>

</div>

</body>
</html>