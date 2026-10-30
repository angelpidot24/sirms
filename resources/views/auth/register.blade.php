
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | SIRMS</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700;800&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'DM Sans', sans-serif; }
        .heading-font { font-family: 'Playfair Display', serif; }

        .pink-gradient {
            background: linear-gradient(135deg, #ec4899, #be185d);
        }

        .register-bg {
            background:
                radial-gradient(circle at 15% 20%, rgba(244,114,182,.20), transparent 30%),
                radial-gradient(circle at 85% 80%, rgba(251,207,232,.45), transparent 35%),
                #fffafd;
        }

        .input-field { transition: all .2s ease; }

        .input-field:focus {
            border-color: #ec4899;
            box-shadow: 0 0 0 3px rgba(236,72,153,.12);
            outline: none;
        }
    </style>
</head>

<body class="register-bg min-h-screen">

    <!-- NAVBAR -->
    <nav class="bg-white/90 border-b border-pink-100">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <div class="w-11 h-11 pink-gradient rounded-xl flex items-center justify-center text-white text-2xl font-bold shadow-lg">
                    S
                </div>

                <div>
                    <h1 class="font-extrabold text-xl text-gray-900">SIRMS</h1>
                    <p class="text-xs text-gray-500">Student Records Management</p>
                </div>
            </a>

            <a href="{{ route('login') }}"
               class="text-sm font-semibold text-pink-600 hover:text-pink-800">
                Already have an account? Login →
            </a>

        </div>
    </nav>

    <!-- REGISTRATION SECTION -->
    <main class="px-6 py-12 flex justify-center">

        <div class="max-w-5xl w-full bg-white rounded-[2rem] shadow-2xl shadow-pink-200/50 border border-pink-100 overflow-hidden grid lg:grid-cols-2">

            <!-- LEFT PANEL -->
            <div class="hidden lg:flex pink-gradient p-12 text-white flex-col justify-between relative overflow-hidden">

                <div class="absolute w-72 h-72 rounded-full border border-white/20 -top-24 -right-24"></div>
                <div class="absolute w-96 h-96 rounded-full border border-white/10 -bottom-40 -left-32"></div>

                <div class="relative z-10">
                    <span class="bg-white/20 px-4 py-2 rounded-full text-xs font-bold tracking-widest uppercase">
                        Join SIRMS
                    </span>

                    <h2 class="heading-font text-5xl leading-tight mt-10">
                        Create Your Account,
                        <span class="text-pink-200">Start Organizing.</span>
                    </h2>

                    <p class="mt-6 text-pink-100 leading-8">
                        Register your account to access the Student Information
                        and Records Management System.
                    </p>
                </div>

                <div class="relative z-10 bg-white/15 backdrop-blur-md rounded-2xl p-6 border border-white/20 mt-12">
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 bg-white/20 rounded-2xl flex items-center justify-center text-3xl">
                            🎓
                        </div>

                        <div>
                            <h3 class="font-bold text-lg">SIRMS Portal</h3>
                            <p class="text-sm text-pink-100">
                                Your records, organized in one place.
                            </p>
                        </div>
                    </div>
                </div>

            </div>

            <!-- RIGHT PANEL -->
            <div class="p-8 sm:p-12">

                <div class="max-w-md mx-auto">

                    <div class="mb-8">
                        <span class="text-pink-600 text-xs font-bold tracking-widest uppercase">
                            Account Registration
                        </span>

                        <h1 class="heading-font text-4xl text-gray-900 mt-3">
                            Create Account
                        </h1>

                        <p class="text-gray-500 mt-3 text-sm">
                            Fill in your information to register.
                        </p>
                    </div>

                    <!-- SUCCESS MESSAGE -->
                    @if (session('status'))
                        <div class="mb-6 bg-green-50 border border-green-200 text-green-700 rounded-xl p-4 text-sm">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- VALIDATION ERRORS -->
                    @if ($errors->any())
                        <div class="mb-6 bg-red-50 border border-red-200 text-red-700 rounded-xl p-4 text-sm">
                            <ul class="list-disc pl-5 space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- REGISTRATION FORM -->
                    <form action="{{ route('register.store') }}" method="POST" class="space-y-5">
                        @csrf

                        <!-- FULL NAME -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">
                                Full Name
                            </label>

                            <input
                                type="text"
                                name="name"
                                value="{{ old('name') }}"
                                placeholder="Enter your full name"
                                required
                                autocomplete="name"
                                class="input-field w-full px-4 py-3.5 bg-gray-50 border border-gray-200 rounded-xl text-sm"
                            >
                        </div>

                        <!-- STUDENT ID -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">
                                Student ID
                            </label>

                            <input
                                type="text"
                                name="student_id"
                                value="{{ old('student_id') }}"
                                placeholder="Enter your student ID"
                                required
                                class="input-field w-full px-4 py-3.5 bg-gray-50 border border-gray-200 rounded-xl text-sm"
                            >
                        </div>

                        <!-- EMAIL -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">
                                Email Address
                            </label>

                            <input
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                placeholder="Enter your email address"
                                required
                                autocomplete="email"
                                class="input-field w-full px-4 py-3.5 bg-gray-50 border border-gray-200 rounded-xl text-sm"
                            >
                        </div>

                        <!-- PASSWORD -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">
                                Password
                            </label>

                            <div class="relative">
                                <input
                                    type="password"
                                    id="password"
                                    name="password"
                                    placeholder="Create a password"
                                    required
                                    minlength="8"
                                    autocomplete="new-password"
                                    class="input-field w-full px-4 py-3.5 pr-16 bg-gray-50 border border-gray-200 rounded-xl text-sm"
                                >

                                <button
                                    type="button"
                                    onclick="togglePassword('password', this)"
                                    class="absolute right-4 top-1/2 -translate-y-1/2 text-xs font-bold text-pink-600">
                                    Show
                                </button>
                            </div>

                            <p class="text-xs text-gray-400 mt-2">
                                Password must contain at least 8 characters.
                            </p>
                        </div>

                        <!-- CONFIRM PASSWORD -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">
                                Confirm Password
                            </label>

                            <div class="relative">
                                <input
                                    type="password"
                                    id="password_confirmation"
                                    name="password_confirmation"
                                    placeholder="Confirm your password"
                                    required
                                    minlength="8"
                                    autocomplete="new-password"
                                    class="input-field w-full px-4 py-3.5 pr-16 bg-gray-50 border border-gray-200 rounded-xl text-sm"
                                >

                                <button
                                    type="button"
                                    onclick="togglePassword('password_confirmation', this)"
                                    class="absolute right-4 top-1/2 -translate-y-1/2 text-xs font-bold text-pink-600">
                                    Show
                                </button>
                            </div>
                        </div>

                        <!-- TERMS -->
                        <div class="flex items-start gap-3">
                            <input
                                type="checkbox"
                                name="terms"
                                id="terms"
                                value="1"
                                required
                                class="mt-1 w-4 h-4 accent-pink-600"
                            >

                            <label for="terms" class="text-xs text-gray-500 leading-6">
                                I confirm that the information I provided is accurate
                                and agree to the system's terms and privacy policy.
                            </label>
                        </div>

                        <!-- REGISTER BUTTON -->
                        <button
                            type="submit"
                            class="pink-gradient w-full py-4 rounded-xl text-white font-bold shadow-lg shadow-pink-200 hover:shadow-xl hover:scale-[1.02] transition">
                            Create My Account →
                        </button>

                    </form>

                    <div class="mt-7 text-center">
                        <p class="text-sm text-gray-500">
                            Already have an account?
                            <a href="{{ route('login') }}" class="text-pink-600 font-bold hover:text-pink-800">
                                Sign In
                            </a>
                        </p>
                    </div>

                    <p class="text-xs text-gray-400 text-center mt-8">
                        © {{ date('Y') }} SIRMS. All Rights Reserved.
                    </p>

                </div>
            </div>

        </div>
    </main>

    <!-- PASSWORD VISIBILITY -->
    <script>
        function togglePassword(id, button) {
            const input = document.getElementById(id);

            if (input.type === 'password') {
                input.type = 'text';
                button.textContent = 'Hide';
            } else {
                input.type = 'password';
                button.textContent = 'Show';
            }
        }
    </script>

</body>
</html>
