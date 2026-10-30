
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($student) ? 'Edit Student' : 'Add Student' }} | SIRMS</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-100 text-slate-800">

<div class="min-h-screen">

    <!-- HEADER -->
    <header class="border-b border-slate-200 bg-slate-900 px-6 py-5 text-white">
        <div class="mx-auto flex max-w-5xl items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold">SIRMS</h1>
                <p class="mt-1 text-xs tracking-widest text-slate-400">
                    ADMINISTRATION PANEL
                </p>
            </div>

            <a href="{{ route('admin.students.index') }}"
               class="rounded-lg bg-slate-700 px-4 py-2 text-sm font-medium hover:bg-slate-600">
                ← Back to Students
            </a>
        </div>
    </header>

    <!-- FORM CONTENT -->
    <main class="mx-auto max-w-3xl px-5 py-10">

        <div class="mb-7">
            <p class="text-sm font-bold uppercase tracking-wider text-blue-600">
                Student Management
            </p>

            <h2 class="mt-2 text-3xl font-bold text-slate-900">
                {{ isset($student) ? 'Edit Student Information' : 'Add New Student' }}
            </h2>

            <p class="mt-2 text-sm text-slate-500">
                {{ isset($student) ? 'Update the student account information below.' : 'Register a new student account in the system.' }}
            </p>
        </div>

        <!-- VALIDATION ERRORS -->
        @if($errors->any())
            <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-5 text-sm text-red-700">
                <p class="mb-2 font-bold">Please correct the following errors:</p>

                <ul class="list-inside list-disc space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- STUDENT FORM -->
        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm md:p-9">

            <div class="mb-7 flex items-center gap-4 border-b border-slate-100 pb-6">
                <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-blue-50 text-2xl text-blue-600">
                    ♙
                </div>

                <div>
                    <h3 class="font-bold text-slate-900">
                        Student Account Details
                    </h3>
                    <p class="mt-1 text-xs text-slate-500">
                        Enter accurate student information.
                    </p>
                </div>
            </div>

            <form
                action="{{ isset($student) ? route('admin.students.update', $student->id) : route('admin.students.store') }}"
                method="POST"
                class="space-y-6">

                @csrf

                @if(isset($student))
                    @method('PUT')
                @endif

                <!-- STUDENT ID -->
                <div>
                    <label for="student_id" class="mb-2 block text-sm font-semibold text-slate-700">
                        Student ID <span class="text-red-500">*</span>
                    </label>

                    <input
                        type="text"
                        id="student_id"
                        name="student_id"
                        value="{{ old('student_id', $student->student_id ?? '') }}"
                        placeholder="Enter student ID"
                        required
                        class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-50">

                    @error('student_id')
                        <p class="mt-2 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- FULL NAME -->
                <div>
                    <label for="name" class="mb-2 block text-sm font-semibold text-slate-700">
                        Full Name <span class="text-red-500">*</span>
                    </label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name', $student->name ?? '') }}"
                        placeholder="Enter complete name"
                        required
                        class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-50">

                    @error('name')
                        <p class="mt-2 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- EMAIL -->
                <div>
                    <label for="email" class="mb-2 block text-sm font-semibold text-slate-700">
                        Email Address <span class="text-red-500">*</span>
                    </label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email', $student->email ?? '') }}"
                        placeholder="example@email.com"
                        required
                        class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-50">

                    @error('email')
                        <p class="mt-2 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- PASSWORD -->
                <div>
                    <label for="password" class="mb-2 block text-sm font-semibold text-slate-700">
                        Password

                        @if(isset($student))
                            <span class="font-normal text-slate-400">
                                (Leave blank to keep the current password)
                            </span>
                        @else
                            <span class="text-red-500">*</span>
                        @endif
                    </label>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        {{ isset($student) ? '' : 'required' }}
                        minlength="8"
                        autocomplete="new-password"
                        placeholder="Enter password"
                        class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-50">

                    @error('password')
                        <p class="mt-2 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- CONFIRM PASSWORD -->
                <div>
                    <label for="password_confirmation" class="mb-2 block text-sm font-semibold text-slate-700">
                        Confirm Password

                        @if(!isset($student))
                            <span class="text-red-500">*</span>
                        @endif
                    </label>

                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        {{ isset($student) ? '' : 'required' }}
                        minlength="8"
                        autocomplete="new-password"
                        placeholder="Confirm password"
                        class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-50">
                </div>

                <!-- ACCOUNT TYPE -->
                <div class="rounded-xl border border-blue-100 bg-blue-50 p-4">
                    <p class="text-xs font-semibold uppercase tracking-wider text-blue-600">
                        Account Type
                    </p>

                    <p class="mt-1 text-sm font-bold text-blue-900">
                        Student Account
                    </p>

                    <p class="mt-1 text-xs text-blue-700">
                        The account will automatically be assigned the student role.
                    </p>
                </div>

                <!-- BUTTONS -->
                <div class="flex flex-wrap gap-3 border-t border-slate-100 pt-6">

                    <button
                        type="submit"
                        class="rounded-xl bg-blue-600 px-7 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700">

                        {{ isset($student) ? 'Save Changes' : 'Create Student Account' }}

                    </button>

                    <a href="{{ route('admin.students.index') }}"
                       class="rounded-xl border border-slate-300 px-7 py-3 text-sm font-semibold text-slate-600 transition hover:bg-slate-50">
                        Cancel
                    </a>

                </div>

            </form>

        </div>

        <p class="mt-6 text-center text-xs text-slate-400">
            © {{ date('Y') }} SIRMS Administration
        </p>

    </main>

</div>

</body>
</html>
