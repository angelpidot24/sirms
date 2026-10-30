
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($admin) ? 'Edit Administrator' : 'Add Administrator' }} | SIRMS</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-100 min-h-screen">

<div class="min-h-screen flex">

    <!-- SIDEBAR -->
    <aside class="hidden md:flex w-64 bg-slate-950 text-white flex-col">

        <div class="p-6 border-b border-slate-800">
            <h1 class="text-2xl font-extrabold">SIRMS</h1>
            <p class="text-xs text-slate-400 mt-1">Administration Portal</p>
        </div>

        <nav class="p-4 space-y-2 flex-1">

            <a href="{{ route('dashboard') }}"
               class="block px-4 py-3 rounded-xl text-slate-300 hover:bg-slate-800">
                ▦ Dashboard
            </a>

            <a href="{{ route('admin.students.index') }}"
               class="block px-4 py-3 rounded-xl text-slate-300 hover:bg-slate-800">
                ♙ Student Management
            </a>

            <a href="{{ route('admin.admins.index') }}"
               class="block px-4 py-3 rounded-xl bg-blue-600 font-bold">
                ♟ Admin Management
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
                Administration / Admin Management
            </p>
            <h2 class="text-xl font-extrabold text-slate-900">
                {{ isset($admin) ? 'Edit Administrator' : 'Add Administrator' }}
            </h2>
        </header>

        <div class="p-6 lg:p-8 max-w-3xl mx-auto">

            <div class="bg-white border border-slate-200 rounded-2xl shadow-sm p-6 sm:p-8">

                <h1 class="text-2xl font-extrabold text-slate-900">
                    {{ isset($admin) ? 'Update Administrator Account' : 'Create Administrator Account' }}
                </h1>

                <p class="text-sm text-slate-500 mt-2">
                    Enter the administrator account details.
                </p>

                @if($errors->any())

                    <div class="mt-6 p-4 rounded-xl bg-red-50 border border-red-200 text-red-700">

                        <p class="font-bold mb-2">
                            Please correct the following errors:
                        </p>

                        <ul class="list-disc pl-5 text-sm space-y-1">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>

                    </div>

                @endif

                <form
                    action="{{ isset($admin) ? route('admin.admins.update', $admin->id) : route('admin.admins.store') }}"
                    method="POST"
                    class="mt-7 space-y-5">

                    @csrf

                    @if(isset($admin))
                        @method('PUT')
                    @endif

                    <!-- NAME -->
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">
                            Full Name
                        </label>

                        <input type="text"
                               name="name"
                               value="{{ old('name', $admin->name ?? '') }}"
                               required
                               class="w-full border border-slate-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                               placeholder="Enter administrator name">
                    </div>

                    <!-- EMAIL -->
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">
                            Email Address
                        </label>

                        <input type="email"
                               name="email"
                               value="{{ old('email', $admin->email ?? '') }}"
                               required
                               class="w-full border border-slate-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                               placeholder="Enter email address">
                    </div>

                    <!-- PASSWORD -->
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">
                            Password
                        </label>

                        <input type="password"
                               name="password"
                               {{ isset($admin) ? '' : 'required' }}
                               minlength="8"
                               class="w-full border border-slate-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                               placeholder="{{ isset($admin) ? 'Leave blank to keep current password' : 'Create a password' }}">

                        @if(isset($admin))
                            <p class="text-xs text-slate-500 mt-2">
                                Leave blank if you do not want to change the password.
                            </p>
                        @else
                            <p class="text-xs text-slate-500 mt-2">
                                Password must contain at least 8 characters.
                            </p>
                        @endif
                    </div>

                    <!-- CONFIRM PASSWORD -->
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">
                            Confirm Password
                        </label>

                        <input type="password"
                               name="password_confirmation"
                               {{ isset($admin) ? '' : 'required' }}
                               minlength="8"
                               class="w-full border border-slate-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                               placeholder="Confirm password">
                    </div>

                    <!-- ROLE -->
                    <div class="bg-blue-50 border border-blue-100 rounded-xl p-4">
                        <p class="text-sm font-bold text-blue-800">
                            Account Role: Administrator
                        </p>

                        <p class="text-xs text-blue-700 mt-1">
                            The system automatically assigns administrator access.
                        </p>
                    </div>

                    <!-- BUTTONS -->
                    <div class="flex flex-col sm:flex-row gap-3 pt-3">

                        <button type="submit"
                                class="flex-1 bg-blue-700 hover:bg-blue-800 text-white font-bold py-3 rounded-xl">
                            {{ isset($admin) ? 'Save Changes' : 'Create Administrator' }}
                        </button>

                        <a href="{{ route('admin.admins.index') }}"
                           class="flex-1 text-center bg-slate-200 hover:bg-slate-300 text-slate-700 font-bold py-3 rounded-xl">
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
