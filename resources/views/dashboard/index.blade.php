
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIRMS | Dashboard</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700;800&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'DM Sans', sans-serif;
            background: #fff8fb;
            color: #3d2935;
        }

        .sidebar {
            width: 250px;
            min-height: 100vh;
            background: white;
            border-right: 1px solid #f4dce8;
            position: fixed;
            top: 0;
            left: 0;
            padding: 28px 20px;
            z-index: 10;
        }

        .main {
            margin-left: 250px;
            padding: 30px 38px;
        }

        .brand {
            font-family: 'Playfair Display', serif;
            font-size: 25px;
            font-weight: 700;
            color: #d94f88;
        }

        .nav-link {
            display: block;
            padding: 13px 15px;
            margin: 7px 0;
            border-radius: 12px;
            text-decoration: none;
            color: #806b77;
            font-size: 14px;
            font-weight: 600;
            transition: .2s;
        }

        .nav-link:hover,
        .nav-link.active {
            background: #fce7f1;
            color: #d94685;
        }

        .welcome {
            background: linear-gradient(120deg, #e96b9d, #f5a8c6);
            padding: 32px;
            border-radius: 22px;
            color: white;
            margin-top: 25px;
        }

        .welcome h1 {
            font-family: 'Playfair Display', serif;
            font-size: 30px;
            margin: 0 0 8px;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 18px;
            margin: 25px 0;
        }

        .stat-card,
        .content-card {
            background: white;
            padding: 23px;
            border: 1px solid #f4e3eb;
            border-radius: 18px;
            box-shadow: 0 5px 20px rgba(130, 60, 90, .04);
        }

        .stat-card p {
            color: #927d89;
            font-size: 13px;
            margin: 0 0 12px;
        }

        .stat-card h2 {
            color: #d94f88;
            font-size: 28px;
            margin: 0;
        }

        .section-title {
            font-family: 'Playfair Display', serif;
            font-size: 22px;
            margin: 0 0 18px;
        }

        .table-wrap {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 500px;
        }

        th, td {
            padding: 15px 12px;
            border-bottom: 1px solid #f5e8ee;
            text-align: left;
            font-size: 13px;
        }

        th {
            color: #a18493;
            font-weight: 700;
        }

        td {
            color: #66515d;
        }

        .status {
            background: #fce7f1;
            color: #d94685;
            padding: 5px 11px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
        }

        .quick-actions {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
        }

        .action {
            padding: 20px;
            background: #fff5f9;
            border: 1px solid #f7dce9;
            border-radius: 15px;
            text-decoration: none;
            color: #bd477b;
            font-weight: 700;
            font-size: 14px;
            transition: .2s;
        }

        .action:hover {
            background: #fce7f1;
            transform: translateY(-2px);
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
        }

        .avatar {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: #fce7f1;
            color: #d94685;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
        }

        .logout {
            border: none;
            background: #fff0f5;
            color: #c7477d;
            padding: 11px 15px;
            border-radius: 10px;
            font-weight: 700;
            cursor: pointer;
        }

        .logout:hover {
            background: #fce0ec;
        }

        @media (max-width: 1000px) {
            .stats {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 700px) {
            .sidebar {
                position: relative;
                width: 100%;
                min-height: auto;
                border-right: none;
                border-bottom: 1px solid #f4dce8;
            }

            .main {
                margin-left: 0;
                padding: 22px 16px;
            }

            .stats,
            .quick-actions {
                grid-template-columns: 1fr;
            }

            .topbar {
                align-items: flex-start;
                flex-direction: column;
            }

            .welcome h1 {
                font-size: 25px;
            }
        }
    </style>
</head>

<body>

    <!-- SIDEBAR -->
    <aside class="sidebar">

        <div class="brand">SIRMS.</div>

        <p style="font-size:11px;color:#b49aa8;margin-top:5px;letter-spacing:1px;">
            STUDENT MANAGEMENT
        </p>

        <nav style="margin-top:35px;">

            <a href="{{ route('dashboard') }}" class="nav-link active">
                ◈ &nbsp; Dashboard
            </a>

            <a href="#" class="nav-link">
                ♙ &nbsp; Student Records
            </a>

            <a href="#" class="nav-link">
                ▣ &nbsp; Enrollment
            </a>

            <a href="#" class="nav-link">
                ▤ &nbsp; Courses
            </a>

            <a href="#" class="nav-link">
                ◷ &nbsp; Reports
            </a>

            <a href="#" class="nav-link">
                ⚙ &nbsp; Settings
            </a>

        </nav>

        <div style="margin-top:50px;">
            <form action="{{ route('logout') }}" method="POST">
                @csrf

                <button type="submit" class="logout" style="width:100%;">
                    ↪ &nbsp; Sign Out
                </button>
            </form>
        </div>

    </aside>


    <!-- MAIN CONTENT -->
    <main class="main">

        <!-- TOP BAR -->
        <div class="topbar">

            <div>
                <p style="color:#a18493;font-size:13px;margin:0;">
                    Student Information and Records Management System
                </p>

                <h2 style="margin:5px 0;font-size:23px;">
                    Dashboard
                </h2>
            </div>

            <div style="display:flex;align-items:center;gap:12px;">

                <div class="avatar">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>

                <div>
                    <strong style="font-size:14px;">
                        {{ auth()->user()->name }}
                    </strong>

                    <p style="font-size:12px;color:#a18493;margin:2px 0;">
                        {{ auth()->user()->email }}
                    </p>
                </div>

            </div>

        </div>


        <!-- WELCOME BANNER -->
        <section class="welcome">

            <p style="font-size:13px;margin:0 0 8px;">
                WELCOME BACK!
            </p>

            <h1>Hello, {{ auth()->user()->name }}!</h1>

            <p style="margin:0;font-size:14px;opacity:.95;">
                Welcome to your Student Information and Records Management System.
                Manage student information and academic records in one place.
            </p>

        </section>


        <!-- STATISTICS -->
        <section class="stats">

            <div class="stat-card">
                <p>Total Students</p>
                <h2>0</h2>
            </div>

            <div class="stat-card">
                <p>Enrolled Students</p>
                <h2>0</h2>
            </div>

            <div class="stat-card">
                <p>Total Courses</p>
                <h2>0</h2>
            </div>

            <div class="stat-card">
                <p>Pending Requests</p>
                <h2>0</h2>
            </div>

        </section>


        <!-- RECENT STUDENTS -->
        <section class="content-card" style="margin-bottom:25px;">

            <h2 class="section-title">Recent Student Records</h2>

            <div class="table-wrap">
                <table>

                    <thead>
                        <tr>
                            <th>Student ID</th>
                            <th>Student Name</th>
                            <th>Email Address</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td colspan="4" style="text-align:center;padding:30px;">
                                No student records available yet.
                            </td>
                        </tr>
                    </tbody>

                </table>
            </div>

        </section>


        <!-- QUICK ACTIONS -->
        <section class="content-card">

            <h2 class="section-title">Quick Actions</h2>

            <div class="quick-actions">

                <a href="#" class="action">
                    ＋ Add New Student
                </a>

                <a href="#" class="action">
                    ▣ Manage Enrollment
                </a>

                <a href="#" class="action">
                    ▤ View Reports
                </a>

            </div>

        </section>


        <footer style="text-align:center;color:#b49aa8;font-size:12px;margin-top:30px;">
            © {{ date('Y') }} SIRMS. Student Information and Records Management System.
        </footer>

    </main>

</body>
</html>
