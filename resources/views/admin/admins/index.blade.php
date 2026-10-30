
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Management | SIRMS</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'DM Sans', sans-serif;
        }
    </style>
</head>

<body class="bg-slate-100 min-h-screen">

<div class="min-h-screen flex">

    <!-- SIDEBAR -->
    <aside class="hidden md:flex w-64 bg-slate-950 text-white flex-col shrink-0">

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

        <!-- NAVIGATION -->
        <nav class="p-4 flex-1 space-y-2">

            <p class="text-xs uppercase tracking-widest text-slate-500 font-bold px-3 py-3">
                Main Menu
            </p>

            <a href="{{ route('dashboard') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-300 hover:bg-slate-800 hover:text-white transition">
                <span>▦</span>
                Dashboard
            </a>

            <a href="{{ route('admin.students.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-300 hover:bg-slate-800 hover:text-white transition">
                <span>♙</span>
                Student Management
            </a>

            <a href="{{ route('admin.admins.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl bg-blue-600 text-white font-bold shadow-lg shadow-blue-950/30">
                <span>♟</span>
                Admin Management
            </a>

            <a href="{{ route('admin.courses.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-300 hover:bg-slate-800 hover:text-white transition">
                <span>▣</span>
                Course Management
            </a>

            <a href="{{ route('admin.records.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-300 hover:bg-slate-800 hover:text-white transition">
                <span>▤</span>
                Academic Records
            </a>

            <a href="{{ route('admin.announcements.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-300 hover:bg-slate-800 hover:text-white transition">
                <span>♧</span>
                Announcements
            </a>

            <a href="{{ route('admin.reports.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-300 hover:bg-slate-800 hover:text-white transition">
                <span>▥</span>
                Reports
            </a>

        </nav>

        <!-- LOGOUT -->
        <div class="p-4 border-t border-slate-800">

            <div class="px-4 py-3 mb-2">
                <p class="text-sm font-bold text-white truncate">
                    {{ auth()->user()->name }}
                </p>

                <p class="text-xs text-slate-400">
                    Administrator
                </p>
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit"
                        class="w-full text-left px-4 py-3 rounded-xl text-red-300 hover:bg-slate-800 font-semibold transition">
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
                    Administration / Admin Management
                </p>

                <h2 class="text-xl font-extrabold text-slate-900">
                    Admin Management
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

            <!-- PAGE TITLE -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">

                <div>
                    <h1 class="text-3xl font-extrabold text-slate-900">
                        Administrator Accounts
                    </h1>

                    <p class="text-sm text-slate-500 mt-2">
                        Manage SIRMS administrator accounts and access.
                    </p>
                </div>

                <a href="{{ route('admin.admins.create') }}"
                   class="inline-flex justify-center items-center bg-blue-700 hover:bg-blue-800 text-white px-5 py-3 rounded-xl font-bold shadow-sm">
                    + Add Administrator
                </a>

            </div>

            <!-- SUCCESS MESSAGE -->
            @if(session('success'))
                <div class="mb-5 p-4 rounded-xl bg-green-100 text-green-800 border border-green-200">
                    {{ session('success') }}
                </div>
            @endif

            <!-- ERROR MESSAGE -->
            @if(session('error'))
                <div class="mb-5 p-4 rounded-xl bg-red-100 text-red-800 border border-red-200">
                    {{ session('error') }}
                </div>
            @endif

            <!-- ADMIN TABLE -->
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

                <div class="p-5 border-b border-slate-200 flex justify-between items-center">
                    <div>
                        <h3 class="font-extrabold text-slate-900">
                            Administrator List
                        </h3>

                        <p class="text-sm text-slate-500 mt-1">
                            Total Administrators: {{ $admins->total() }}
                        </p>
                    </div>
                </div>

                <div class="overflow-x-auto">

                    <table class="w-full text-left">

                        <thead class="bg-slate-50 text-xs uppercase text-slate-500">
                            <tr>
                                <th class="px-6 py-4">ID</th>
                                <th class="px-6 py-4">Administrator</th>
                                <th class="px-6 py-4">Email Address</th>
                                <th class="px-6 py-4">Role</th>
                                <th class="px-6 py-4 text-center">Actions</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-slate-100">

                            @forelse($admins as $admin)

                                <tr class="hover:bg-slate-50">

                                    <td class="px-6 py-4 text-sm text-slate-500">
                                        {{ $admin->id }}
                                    </td>

                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">

                                            <div class="w-10 h-10 rounded-full bg-blue-100 text-blue-700 flex items-center justify-center font-extrabold">
                                                {{ strtoupper(substr($admin->name, 0, 1)) }}
                                            </div>

                                            <span class="font-bold text-slate-800">
                                                {{ $admin->name }}
                                            </span>

                                        </div>
                                    </td>

                                    <td class="px-6 py-4 text-sm text-slate-600">
                                        {{ $admin->email }}
                                    </td>

                                    <td class="px-6 py-4">
                                        <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-xs font-bold">
                                            Administrator
                                        </span>
                                    </td>

                                    <td class="px-6 py-4">

                                        <div class="flex justify-center items-center gap-2">

                                            <a href="{{ route('admin.admins.edit', $admin->id) }}"
                                               class="px-3 py-2 rounded-lg bg-amber-100 text-amber-700 text-xs font-bold hover:bg-amber-200">
                                                Edit
                                            </a>

                                            @if($admin->id !== auth()->id())

                                                <form action="{{ route('admin.admins.destroy', $admin->id) }}"
                                                      method="POST"
                                                      onsubmit="return confirm('Are you sure you want to delete this administrator?')">

                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit"
                                                            class="px-3 py-2 rounded-lg bg-red-100 text-red-700 text-xs font-bold hover:bg-red-200">
                                                        Delete
                                                    </button>

                                                </form>

                                            @else

                                                <span class="text-xs text-slate-400 px-2">
                                                    Current Account
                                                </span>

                                            @endif

                                        </div>

                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center text-slate-500">
                                        No administrator accounts found.
                                    </td>
                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

                <!-- PAGINATION -->
                <div class="p-5 border-t border-slate-200">
                    {{ $admins->links() }}
                </div>

            </div>

            <!-- FOOTER -->
            <footer class="text-center text-xs text-slate-400 mt-10">
                © {{ date('Y') }} SIRMS Administration Portal. All Rights Reserved.
            </footer>

        </div>

    </main>

</div>

</body>
</html>
