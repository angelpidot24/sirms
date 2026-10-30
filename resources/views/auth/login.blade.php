
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | SIRMS</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.googleapis.com">
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

        .login-bg {
            background:
                radial-gradient(circle at 15% 20%, rgba(244,114,182,.20), transparent 30%),
                radial-gradient(circle at 85% 80%, rgba(251,207,232,.45), transparent 35%),
                #fffafd;
        }

        .input-field {
            transition: all .2s ease;
        }

        .input-field:focus {
            border-color: #ec4899;
            box-shadow: 0 0 0 3px rgba(236,72,153,.12);
            outline: none;
        }
    </style>
</head>

<body class="login-bg min-h-screen">

    <!-- NAVBAR -->
    <nav class="bg-white/90 backdrop-blur-md border-b border-pink-100">
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

            <a href="{{ route('home') }}" class="text-sm font-semibold text-gray-600 hover:text-pink-600 transition">
                ← Back to Home
            </a>

        </div>
    </nav>

    <!-- LOGIN SECTION -->
    <main class="min-h-[calc(100vh-145px)] flex items-center justify-center px-6 py-12">

        <div class="max-w-6xl w-full grid lg:grid-cols-2 bg-white rounded-[2rem] overflow-hidden shadow-2xl shadow-pink-200/50 border border-pink-100">

            <!-- LEFT PANEL -->
            <div class="hidden lg:flex pink-gradient p-14 text-white flex-col justify-between relative overflow-hidden">

                <div class="absolute w-72 h-72 rounded-full border border-white/20 -top-24 -right-24"></div>
                <div class="absolute w-96 h-96 rounded-full border border-white/10 -bottom-40 -left-32"></div>

                <div class="relative z-10">

                    <span class="inline-block bg-white/20 px-4 py-2 rounded-full text-xs font-bold tracking-widest uppercase">
                        Welcome Back
                    </span>

                    <h2 class="heading-font text-5xl leading-tight mt-10">
                        Your Student Records,
                        <span class="text-pink-200">All in One Place.</span>
                    </h2>

                    <p class="mt-6 text-pink-100 leading-8">
                        Access your student information management portal.
                        Manage records, organize academic information, and
                        experience a simpler way of handling student data.
                    </p>

                </div>

                <div class="relative z-10 mt-16">

                    <div class="bg-white/15 backdrop-blur-md rounded-2xl p-6 border border-white/20">

                        <div class="flex items-center gap-4">

                            <div class="w-14 h-14 rounded-2xl bg-white/20 flex items-center justify-center text-3xl">
                                🎓
                            </div>

                            <div>
                                <h3 class="font-bold text-lg">SIRMS Portal</h3>
                                <p class="text-sm text-pink-100">
                                    Student Information and Records Management System
                                </p>
                            </div>

                        </div>

                    </div>

                    <p class="text-xs text-pink-100 mt-8">
                        Secure access. Organized records. Better management.
                    </p>

                </div>

            </div>

            <!-- RIGHT PANEL -->
            <div class="p-8 sm:p-12 lg:p-16 flex flex-col justify-center">

                <div class="max-w-md w-full mx-auto">

                    <!-- MOBILE LOGO -->
                    <div class="lg:hidden flex justify-center mb-8">
                        <div class="w-16 h-16 pink-gradient rounded-2xl flex items-center justify-center text-white text-3xl font-bold shadow-lg">
                            S
                        </div>
                    </div>

                    <!-- HEADING -->
                    <div class="mb-9">

                        <span class="text-pink-600 text-xs font-bold tracking-widest uppercase">
                            Account Access
                        </span>

                        <h1 class="heading-font text-4xl sm:text-5xl text-gray-900 mt-3">
                            Welcome Back!
                        </h1>

                        <p class="text-gray-500 mt-4 leading-7">
                            Please enter your account credentials to access the SIRMS portal.
                        </p>

                    </div>

                    <!-- VALIDATION ERRORS -->
                    @if ($errors->any())
                        <div class="mb-6 bg-red-50 border border-red-200 text-red-700 rounded-xl p-4 text-sm">
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                    <!-- SUCCESS MESSAGE -->
                    @if (session('status'))
                        <div class="mb-6 bg-green-50 border border-green-200 text-green-700 rounded-xl p-4 text-sm">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- LOGIN FORM -->
                    <form action="{{ route('login.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <!-- EMAIL -->
                        <div>

                            <label for="email" class="block text-sm font-bold text-gray-700 mb-2">
                                Email Address
                            </label>

                            <div class="relative">

                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                                    ✉
                                </span>

                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    placeholder="Enter your email address"
                                    required
                                    autocomplete="email"
                                    autofocus
                                    class="input-field w-full pl-12 pr-4 py-4 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-800"
                                >

                            </div>

                        </div>

                        <!-- PASSWORD -->
                        <div>

                            <label for="password" class="block text-sm font-bold text-gray-700 mb-2">
                                Password
                            </label>

                            <div class="relative">

                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                                    🔒
                                </span>

                                <input
                                    type="password"
                                    id="password"
                                    name="password"
                                    placeholder="Enter your password"
                                    required
                                    autocomplete="current-password"
                                    class="input-field w-full pl-12 pr-14 py-4 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-800"
                                >

                                <button
                                    type="button"
                                    id="togglePassword"
                                    class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-pink-600 text-sm font-semibold"
                                >
                                    Show
                                </button>

                            </div>

                        </div>

                        <!-- REMEMBER ME -->
                        <div class="flex items-center justify-between">

                            <label class="flex items-center gap-2 text-sm text-gray-600 cursor-pointer">

                                <input
                                    type="checkbox"
                                    name="remember"
                                    value="1"
                                    class="w-4 h-4 accent-pink-600 rounded"
                                >

                                Remember me

                            </label>

                            <a href="#" class="text-sm font-semibold text-pink-600 hover:text-pink-800">
                                Forgot password?
                            </a>

                        </div>

                        <!-- LOGIN BUTTON -->
                        <button
                            type="submit"
                            class="pink-gradient w-full py-4 rounded-xl text-white font-bold shadow-lg shadow-pink-200 hover:shadow-xl hover:scale-[1.02] transition"
                        >
                            Sign In to SIRMS →
                        </button>

                        <!-- REGISTER LINK -->
                        <div class="mt-5 text-center">

                            <p class="text-sm text-gray-500">
                                Don't have an account?

                                <a href="{{ route('register') }}" class="text-pink-600 font-bold hover:text-pink-800">
                                    Create Account
                                </a>
                            </p>

                        </div>

                    </form>

                    <!-- SECURITY MESSAGE -->
                    <div class="mt-9 text-center">

                        <p class="text-xs text-gray-400 leading-6">
                            Authorized access only. Your account credentials
                            should remain private and secure.
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </main>

    <!-- FOOTER -->
    <footer class="py-5 text-center">

        <p class="text-xs text-gray-400">
            © {{ date('Y') }} SIRMS. All Rights Reserved.
        </p>

    </footer>

    <!-- PASSWORD VISIBILITY -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const togglePassword = document.getElementById('togglePassword');
            const password = document.getElementById('password');

            if (togglePassword && password) {
                togglePassword.addEventListener('click', function () {

                    if (password.type === 'password') {
                        password.type = 'text';
                        this.textContent = 'Hide';
                    } else {
                        password.type = 'password';
                        this.textContent = 'Show';
                    }

                });
            }

        });
    </script>

</body>
</html>
