
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SIRMS | Student Information and Records Management System</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700;800&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">

    <style>
        .heading-font {
            font-family: 'Playfair Display', serif;
        }

        .hero-bg {
            background:
                radial-gradient(circle at 85% 20%, rgba(244,114,182,.16), transparent 28%),
                radial-gradient(circle at 15% 85%, rgba(251,207,232,.4), transparent 30%),
                #fffafd;
        }

        .pink-gradient {
            background: linear-gradient(135deg, #ec4899, #be185d);
        }
    </style>
</head>

<body class="bg-white text-gray-800">

    <!-- NAVBAR -->
    <nav class="sticky top-0 z-50 bg-white/95 backdrop-blur-md border-b border-pink-100">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

            <a href="#home" class="flex items-center gap-3">
                <div class="w-12 h-12 pink-gradient rounded-xl flex items-center justify-center text-white text-2xl font-bold shadow-lg">
                    S
                </div>

                <div>
                    <h1 class="font-extrabold text-xl text-gray-900">SIRMS</h1>
                    <p class="text-xs text-gray-500">Student Records Management</p>
                </div>
            </a>

            <div class="hidden md:flex items-center gap-8 font-semibold text-sm">
                <a href="#home" class="hover:text-pink-600">Home</a>
                <a href="#about" class="hover:text-pink-600">About</a>
                <a href="#features" class="hover:text-pink-600">Features</a>
                <a href="#contact" class="hover:text-pink-600">Contact</a>
            </div>

            <div class="flex items-center gap-3">
                <a href="{{ url('/login') }}"
                   class="pink-gradient text-white px-6 py-3 rounded-full font-bold text-sm shadow-lg hover:opacity-90 transition">
                    Login →
                </a>

                <button id="menuButton" class="md:hidden text-pink-600 text-2xl" aria-label="Toggle menu">
                    ☰
                </button>
            </div>
        </div>

        <div id="mobileMenu" class="hidden md:hidden px-6 pb-5 space-y-4 bg-white">
            <a href="#home" class="block">Home</a>
            <a href="#about" class="block">About</a>
            <a href="#features" class="block">Features</a>
            <a href="#contact" class="block">Contact</a>
        </div>
    </nav>

    <!-- HERO -->
    <section id="home" class="hero-bg min-h-[680px] flex items-center">
        <div class="max-w-7xl mx-auto px-6 py-20 grid lg:grid-cols-2 gap-16 items-center">

            <div>
                <span class="inline-block bg-pink-100 text-pink-700 px-5 py-2 rounded-full text-xs font-bold uppercase tracking-widest">
                    ✦ Smart School Management
                </span>

                <h1 class="heading-font text-5xl md:text-7xl leading-tight mt-8 text-gray-900">
                    Managing Student Records,
                    <span class="text-pink-600">Made Simple.</span>
                </h1>

                <p class="mt-7 text-gray-500 text-lg leading-8 max-w-xl">
                    Welcome to the Student Information and Records Management System.
                    A centralized digital platform designed to organize, maintain,
                    and manage student information efficiently and securely.
                </p>

                <div class="flex flex-wrap gap-4 mt-9">
                    <a href="{{ url('/login') }}"
                       class="pink-gradient text-white px-8 py-4 rounded-full font-bold shadow-lg hover:scale-105 transition">
                        Get Started →
                    </a>

                    <a href="#about"
                       class="border border-pink-200 bg-white text-pink-700 px-8 py-4 rounded-full font-bold hover:bg-pink-50 transition">
                        Learn More
                    </a>
                </div>

                <div class="grid grid-cols-3 gap-5 mt-14 max-w-md">
                    <div>
                        <h3 class="text-2xl font-extrabold text-gray-900">Secure</h3>
                        <p class="text-sm text-gray-500 mt-1">Data Protection</p>
                    </div>

                    <div>
                        <h3 class="text-2xl font-extrabold text-gray-900">Simple</h3>
                        <p class="text-sm text-gray-500 mt-1">Easy Management</p>
                    </div>

                    <div>
                        <h3 class="text-2xl font-extrabold text-gray-900">Fast</h3>
                        <p class="text-sm text-gray-500 mt-1">Quick Access</p>
                    </div>
                </div>
            </div>

            <!-- DASHBOARD PREVIEW -->
            <div class="relative">
                <div class="absolute inset-5 bg-pink-200 rounded-[3rem] rotate-6 opacity-50"></div>

                <div class="relative bg-white rounded-[2.5rem] shadow-2xl shadow-pink-200/60 p-8 border border-pink-100">

                    <div class="flex justify-between items-center mb-8">
                        <div>
                            <p class="text-sm text-gray-400">Welcome to</p>
                            <h2 class="text-2xl font-extrabold text-gray-900">Student Dashboard</h2>
                        </div>

                        <div class="w-14 h-14 bg-pink-100 rounded-2xl flex items-center justify-center text-3xl">
                            🎓
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">

                        <div class="bg-pink-50 rounded-2xl p-6">
                            <div class="text-3xl mb-4">👩‍🎓</div>
                            <p class="text-gray-500 text-sm">Student Records</p>
                            <h3 class="font-bold text-xl text-pink-700 mt-2">Organized</h3>
                        </div>

                        <div class="bg-purple-50 rounded-2xl p-6">
                            <div class="text-3xl mb-4">📚</div>
                            <p class="text-gray-500 text-sm">Academic Records</p>
                            <h3 class="font-bold text-xl text-purple-700 mt-2">Managed</h3>
                        </div>

                        <div class="bg-blue-50 rounded-2xl p-6">
                            <div class="text-3xl mb-4">🔒</div>
                            <p class="text-gray-500 text-sm">Data Security</p>
                            <h3 class="font-bold text-xl text-blue-700 mt-2">Protected</h3>
                        </div>

                        <div class="bg-orange-50 rounded-2xl p-6">
                            <div class="text-3xl mb-4">⚡</div>
                            <p class="text-gray-500 text-sm">System Access</p>
                            <h3 class="font-bold text-xl text-orange-700 mt-2">Efficient</h3>
                        </div>

                    </div>

                    <div class="mt-6 p-5 bg-gray-50 rounded-2xl flex items-center gap-4">
                        <div class="w-12 h-12 pink-gradient rounded-full flex items-center justify-center text-white text-xl">
                            ✓
                        </div>

                        <div>
                            <h4 class="font-bold text-gray-800">Everything in One Place</h4>
                            <p class="text-xs text-gray-500 mt-1">
                                A smarter way to manage student information.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- ABOUT -->
    <section id="about" class="py-24 bg-white">
        <div class="max-w-5xl mx-auto px-6 text-center">

            <span class="text-pink-600 font-bold text-sm uppercase tracking-widest">
                About Our System
            </span>

            <h2 class="heading-font text-4xl md:text-5xl mt-5 text-gray-900">
                A Better Way to Manage Student Information
            </h2>

            <p class="text-gray-500 leading-8 mt-7 max-w-3xl mx-auto">
                SIRMS is a web-based system developed to simplify the management
                of student information and academic records. It provides an organized
                digital environment where authorized users can maintain, update,
                retrieve, and manage student data with ease.
            </p>

        </div>
    </section>

    <!-- FEATURES -->
    <section id="features" class="py-24 bg-pink-50/60">
        <div class="max-w-7xl mx-auto px-6">

            <div class="text-center mb-16">
                <span class="text-pink-600 font-bold text-sm uppercase tracking-widest">
                    What We Offer
                </span>

                <h2 class="heading-font text-4xl md:text-5xl mt-5 text-gray-900">
                    System Features
                </h2>

                <p class="text-gray-500 mt-4">
                    Everything you need for organized student records management.
                </p>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-7">

                @php
                    $features = [
                        ['👩‍🎓', 'Student Management', 'Register, update, view, and manage student profiles and personal information.', 'pink'],
                        ['📋', 'Academic Records', 'Keep academic information and student records organized in one place.', 'purple'],
                        ['🔐', 'Secure Login', 'Provide authorized users with controlled access to the system.', 'blue'],
                        ['🔎', 'Quick Search', 'Find student information quickly through organized record searching.', 'orange'],
                        ['📊', 'Dashboard Overview', 'View important student management information through a centralized dashboard.', 'green'],
                        ['💾', 'Data Organization', 'Maintain structured student information for easier record management.', 'yellow'],
                    ];
                @endphp

                @foreach($features as $feature)
                    <div class="bg-white p-8 rounded-3xl shadow-sm border border-pink-100 hover:-translate-y-2 hover:shadow-xl transition">
                        <div class="w-14 h-14 bg-{{ $feature[3] }}-100 rounded-2xl flex items-center justify-center text-3xl mb-6">
                            {{ $feature[0] }}
                        </div>

                        <h3 class="font-bold text-xl text-gray-900">
                            {{ $feature[1] }}
                        </h3>

                        <p class="text-gray-500 text-sm leading-7 mt-3">
                            {{ $feature[2] }}
                        </p>
                    </div>
                @endforeach

            </div>
        </div>
    </section>

    <!-- CALL TO ACTION -->
    <section id="contact" class="py-24 bg-white">
        <div class="max-w-5xl mx-auto px-6">

            <div class="pink-gradient rounded-[2.5rem] p-10 md:p-16 text-center text-white shadow-xl shadow-pink-200">

                <h2 class="heading-font text-4xl md:text-5xl">
                    Ready to Get Started?
                </h2>

                <p class="text-pink-100 mt-5 max-w-2xl mx-auto leading-7">
                    Access the Student Information and Records Management System
                    and experience a more organized way of managing student records.
                </p>

                <a href="{{ url('/login') }}"
                   class="inline-block mt-8 bg-white text-pink-700 px-9 py-4 rounded-full font-bold hover:bg-pink-50 hover:scale-105 transition shadow-lg">
                    Access the System →
                </a>

            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="bg-gray-950 text-gray-400 py-10">
        <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row justify-between items-center gap-5">

            <div class="text-center md:text-left">
                <h2 class="text-white font-extrabold text-xl">SIRMS</h2>
                <p class="text-xs mt-2">
                    Student Information and Records Management System
                </p>
            </div>

            <p class="text-xs text-center">
                © {{ date('Y') }} SIRMS. All Rights Reserved.
            </p>

        </div>
    </footer>

</body>
</html>
