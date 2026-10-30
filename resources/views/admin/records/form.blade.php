
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($record) ? 'Edit' : 'Add' }} Academic Record | SIRMS</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'DM Sans', sans-serif; }
    </style>
</head>

<body class="bg-slate-100 min-h-screen">

<div class="min-h-screen flex">

    <aside class="hidden md:flex w-64 bg-slate-950 text-white flex-col">
        <div class="p-6 border-b border-slate-800">
            <h1 class="text-xl font-extrabold">SIRMS</h1>
            <p class="text-xs text-slate-400">Administration Portal</p>
        </div>

        <nav class="p-4 flex-1 space-y-2">
            <a href="{{ route('dashboard') }}" class="block px-4 py-3 rounded-xl text-slate-300 hover:bg-slate-800">Dashboard</a>
            <a href="{{ route('admin.students.index') }}" class="block px-4 py-3 rounded-xl text-slate-300 hover:bg-slate-800">Student Management</a>
            <a href="{{ route('admin.admins.index') }}" class="block px-4 py-3 rounded-xl text-slate-300 hover:bg-slate-800">Admin Management</a>
            <a href="{{ route('admin.courses.index') }}" class="block px-4 py-3 rounded-xl text-slate-300 hover:bg-slate-800">Course Management</a>
            <a href="{{ route('admin.records.index') }}" class="block px-4 py-3 rounded-xl bg-blue-600 text-white font-bold">Academic Records</a>
        </nav>

        <div class="p-4 border-t border-slate-800">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="w-full text-left px-4 py-3 text-red-300 hover:bg-slate-800 rounded-xl">↪ Sign Out</button>
            </form>
        </div>
    </aside>

    <main class="flex-1 min-w-0">

        <header class="bg-white border-b border-slate-200 px-6 py-5">
            <p class="text-sm text-slate-500">Administration / Academic Records</p>
            <h2 class="text-xl font-extrabold text-slate-900">
                {{ isset($record) ? 'Edit Academic Record' : 'Add Academic Record' }}
            </h2>
        </header>

        <div class="p-6 lg:p-8 max-w-4xl mx-auto">

            <div class="bg-white border border-slate-200 rounded-2xl shadow-sm p-6 sm:p-8">

                <div class="mb-7">
                    <h1 class="text-2xl font-extrabold text-slate-900">
                        {{ isset($record) ? 'Update Academic Record' : 'Create Academic Record' }}
                    </h1>

                    <p class="text-sm text-slate-500 mt-2">
                        Enter the student's course and academic performance information.
                    </p>
                </div>

                @if($errors->any())
                    <div class="mb-6 bg-red-50 border border-red-200 text-red-700 rounded-xl p-4">
                        <p class="font-bold mb-2">Please check the following:</p>
                        <ul class="list-disc pl-5 text-sm space-y-1">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST"
                      action="{{ isset($record) ? route('admin.records.update', $record) : route('admin.records.store') }}"
                      class="space-y-5">

                    @csrf

                    @if(isset($record))
                        @method('PUT')
                    @endif

                    <!-- STUDENT -->
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">
                            Select Student
                        </label>

                        <select name="user_id" required
                                class="w-full border border-slate-300 rounded-xl px-4 py-3 bg-white focus:ring-2 focus:ring-blue-500 outline-none">

                            <option value="">Choose a student</option>

                            @foreach($students as $student)
                                <option value="{{ $student->id }}"
                                    {{ old('user_id', $record->user_id ?? '') == $student->id ? 'selected' : '' }}>
                                    {{ $student->name }} ({{ $student->student_id }})
                                </option>
                            @endforeach

                        </select>
                    </div>

                    <!-- COURSE -->
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">
                            Select Course
                        </label>

                        <select name="course_id" required
                                class="w-full border border-slate-300 rounded-xl px-4 py-3 bg-white focus:ring-2 focus:ring-blue-500 outline-none">

                            <option value="">Choose a course</option>

                            @foreach($courses as $course)
                                <option value="{{ $course->id }}"
                                    {{ old('course_id', $record->course_id ?? '') == $course->id ? 'selected' : '' }}>
                                    {{ $course->course_code }} - {{ $course->course_name }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    <!-- ACADEMIC YEAR -->
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">
                            Academic Year
                        </label>

                        <input type="text"
                               name="academic_year"
                               value="{{ old('academic_year', $record->academic_year ?? '') }}"
                               placeholder="Example: 2026-2027"
                               maxlength="20"
                               required
                               class="w-full border border-slate-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>

                    <!-- SEMESTER -->
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">
                            Semester
                        </label>

                        <select name="semester" required
                                class="w-full border border-slate-300 rounded-xl px-4 py-3 bg-white focus:ring-2 focus:ring-blue-500 outline-none">

                            <option value="">Select semester</option>

                            <option value="1st Semester" {{ old('semester', $record->semester ?? '') == '1st Semester' ? 'selected' : '' }}>
                                1st Semester
                            </option>

                            <option value="2nd Semester" {{ old('semester', $record->semester ?? '') == '2nd Semester' ? 'selected' : '' }}>
                                2nd Semester
                            </option>

                            <option value="Summer" {{ old('semester', $record->semester ?? '') == 'Summer' ? 'selected' : '' }}>
                                Summer
                            </option>

                        </select>
                    </div>

                    <!-- GRADE -->
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">
                            Grade
                        </label>

                        <input type="number"
                               name="grade"
                               value="{{ old('grade', $record->grade ?? '') }}"
                               placeholder="Enter grade (0-100)"
                               min="0"
                               max="100"
                               step="0.01"
                               class="w-full border border-slate-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none">

                        <p class="text-xs text-slate-400 mt-2">
                            Leave blank if the student has not yet received a grade.
                        </p>
                    </div>

                    <!-- REMARKS -->
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">
                            Remarks
                        </label>

                        <textarea name="remarks"
                                  rows="4"
                                  maxlength="2000"
                                  placeholder="Enter additional remarks or comments..."
                                  class="w-full border border-slate-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none">{{ old('remarks', $record->remarks ?? '') }}</textarea>
                    </div>

                    <!-- BUTTONS -->
                    <div class="flex flex-col sm:flex-row gap-3 pt-4">

                        <button type="submit"
                                class="flex-1 bg-blue-700 hover:bg-blue-800 text-white py-3 rounded-xl font-bold">
                            {{ isset($record) ? 'Save Changes' : 'Create Academic Record' }}
                        </button>

                        <a href="{{ route('admin.records.index') }}"
                           class="flex-1 text-center bg-slate-200 hover:bg-slate-300 text-slate-700 py-3 rounded-xl font-bold">
                            Cancel
                        </a>

                    </div>

                </form>

            </div>

        </div>

    </main>

</div>

</body>
</html>
