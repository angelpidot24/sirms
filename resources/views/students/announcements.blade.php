
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Announcements | SIRMS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-pink-50 text-slate-800">

<div class="min-h-screen md:flex">

    <aside class="w-full md:w-64 bg-white border-r border-pink-100 p-6">
        <h1 class="text-2xl font-extrabold text-pink-600 mb-2">SIRMS</h1>
        <p class="text-xs text-slate-400 mb-8">Student Portal</p>

        <nav class="space-y-2">
            <a href="{{ route('student.dashboard') }}"
               class="block rounded-xl px-4 py-3 text-slate-600 hover:bg-pink-50">
                Dashboard
            </a>

            <a href="{{ route('students.profile') }}"
               class="block rounded-xl px-4 py-3 text-slate-600 hover:bg-pink-50">
                My Profile
            </a>

            <a href="{{ route('student.records') }}"
               class="block rounded-xl px-4 py-3 text-slate-600 hover:bg-pink-50">
                Academic Records
            </a>

            <a href="{{ route('student.courses') }}"
               class="block rounded-xl px-4 py-3 text-slate-600 hover:bg-pink-50">
                My Courses
            </a>

            <a href="{{ route('student.announcements') }}"
               class="block rounded-xl px-4 py-3 bg-pink-100 text-pink-700 font-semibold">
                Announcements
            </a>
        </nav>

        <form action="{{ route('logout') }}" method="POST" class="mt-8">
            @csrf
            <button type="submit"
                    class="w-full rounded-xl bg-pink-600 px-4 py-3 font-semibold text-white hover:bg-pink-700">
                Logout
            </button>
        </form>
    </aside>

    <main class="flex-1 p-6 md:p-10">

        <div class="mb-8">
            <p class="text-sm font-semibold text-pink-500">STUDENT PORTAL</p>
            <h2 class="mt-2 text-3xl font-extrabold">School Announcements</h2>
            <p class="mt-2 text-slate-500">
                Stay updated with the latest school announcements and important notices.
            </p>
        </div>

        <form action="{{ route('student.announcements') }}" method="GET"
              class="mb-8 flex flex-col gap-3 sm:flex-row">
            <input
                type="text"
                name="search"
                value="{{ $search ?? request('search') }}"
                placeholder="Search announcements..."
                class="w-full rounded-xl border border-pink-100 bg-white px-4 py-3 outline-none focus:border-pink-400"
            >

            <button type="submit"
                    class="rounded-xl bg-pink-600 px-6 py-3 font-semibold text-white hover:bg-pink-700">
                Search
            </button>

            <a href="{{ route('student.announcements') }}"
               class="rounded-xl border border-pink-200 bg-white px-6 py-3 text-center font-semibold text-pink-600 hover:bg-pink-50">
                Reset
            </a>
        </form>

        <div class="mb-6 rounded-2xl border border-pink-100 bg-white p-5">
            <p class="text-sm text-slate-500">Published Announcements</p>
            <p class="mt-1 text-3xl font-extrabold text-pink-600">
                {{ $totalAnnouncements ?? (isset($announcements) ? $announcements->total() : 0) }}
            </p>
        </div>

        <div class="space-y-5">

            @forelse($announcements as $announcement)

                <article class="rounded-2xl border border-pink-100 bg-white p-6 shadow-sm">
                    <div class="mb-3 flex flex-wrap items-center justify-between gap-3">
                        <span class="rounded-full bg-pink-100 px-3 py-1 text-xs font-bold text-pink-700">
                            Published
                        </span>

                        <span class="text-sm text-slate-400">
                            {{ optional($announcement->published_at ?? $announcement->created_at)->format('F d, Y') }}
                        </span>
                    </div>

                    <h3 class="text-xl font-bold text-slate-800">
                        {{ $announcement->title }}
                    </h3>

                    <p class="mt-3 whitespace-pre-line leading-7 text-slate-600">
                        {{ $announcement->content }}
                    </p>
                </article>

            @empty

                <div class="rounded-2xl border border-dashed border-pink-200 bg-white p-12 text-center">
                    <div class="mb-3 text-4xl">📢</div>
                    <h3 class="text-lg font-bold text-slate-700">
                        No announcements found
                    </h3>
                    <p class="mt-2 text-sm text-slate-500">
                        There are currently no published announcements to display.
                    </p>
                </div>

            @endforelse

        </div>

        @if(isset($announcements))
            <div class="mt-8">
                {{ $announcements->links() }}
            </div>
        @endif

    </main>
</div>

</body>
</html>
