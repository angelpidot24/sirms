
<?php

use Illuminate\Support\Facades\Route;

use App\Models\User;
use App\Models\Course;
use App\Models\AcademicRecord;
use App\Models\Announcement;

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;

use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\AcademicRecordController;
use App\Http\Controllers\Admin\AnnouncementController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\EnrollmentController;

use App\Http\Controllers\StudentProfileController;
use App\Http\Controllers\StudentAcademicRecordController;
use App\Http\Controllers\StudentCourseController;
use App\Http\Controllers\StudentAnnouncementController;


// ==========================================
// HOME PAGE
// ==========================================

Route::get('/', function () {
    return view('welcome');
})->name('home');


// ==========================================
// LOGIN AND REGISTER
// ==========================================

Route::middleware('guest')->group(function () {

    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');

    Route::get('/register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('/login', [AuthenticatedSessionController::class, 'store'])
        ->name('login.store');

    Route::post('/register', [RegisteredUserController::class, 'store'])
        ->name('register.store');

});


// ==========================================
// AUTHENTICATED ROUTES
// ==========================================

Route::middleware('auth')->group(function () {


    // ======================================
    // MAIN DASHBOARD
    // ======================================

    Route::get('/dashboard', function () {

        $user = auth()->user();

        // ADMIN DASHBOARD
        if ($user->role === 'admin') {

            return view('admin.dashboard', [
                'totalStudents' => User::where('role', 'student')->count(),
                'totalAdmins' => User::where('role', 'admin')->count(),
                'totalCourses' => Course::count(),
                'totalRecords' => AcademicRecord::count(),
            ]);

        }

        // STUDENT DASHBOARD
        if ($user->role === 'student') {

            return redirect()->route('student.dashboard');

        }

        abort(403, 'Unauthorized account role.');

    })->name('dashboard');


    // ======================================
    // STUDENT DASHBOARD
    // ======================================

    Route::get('/student/dashboard', function () {

        abort_unless(auth()->user()->role === 'student', 403);

        $announcements = Announcement::where('status', 'Published')
            ->orderByDesc('published_at')
            ->orderByDesc('created_at')
            ->take(5)
            ->get();

        return view('students.dashboard', compact('announcements'));

    })->name('student.dashboard');


    // ======================================
    // STUDENT PROFILE
    // ======================================

    Route::get('/student/profile', [StudentProfileController::class, 'index'])
        ->name('students.profile');

    Route::put('/student/profile', [StudentProfileController::class, 'update'])
        ->name('students.profile.update');

    Route::put('/student/profile/password', [StudentProfileController::class, 'updatePassword'])
        ->name('students.password.update');


    // ======================================
    // STUDENT ACADEMIC RECORDS
    // ======================================

    Route::get('/student/records', [StudentAcademicRecordController::class, 'index'])
        ->name('student.records');


    // ======================================
    // STUDENT COURSES
    // ======================================

    Route::get('/student/courses', [StudentCourseController::class, 'index'])
        ->name('student.courses');

    Route::post('/student/courses/{course}/enroll', [StudentCourseController::class, 'enroll'])
        ->name('student.courses.enroll');

    Route::delete('/student/courses/{enrollment}/cancel', [StudentCourseController::class, 'cancel'])
        ->name('student.courses.cancel');


    // ======================================
    // STUDENT ANNOUNCEMENTS
    // ======================================

    Route::get('/student/announcements', [StudentAnnouncementController::class, 'index'])
        ->name('student.announcements');


    // ======================================
    // ADMIN MODULES
    // ======================================

    Route::prefix('admin')
        ->name('admin.')
        ->group(function () {

            // STUDENT MANAGEMENT

            Route::get('/students', [StudentController::class, 'index'])
                ->name('students.index');

            Route::get('/students/create', [StudentController::class, 'create'])
                ->name('students.create');

            Route::post('/students', [StudentController::class, 'store'])
                ->name('students.store');

            Route::get('/students/{student}/edit', [StudentController::class, 'edit'])
                ->name('students.edit');

            Route::put('/students/{student}', [StudentController::class, 'update'])
                ->name('students.update');

            Route::delete('/students/{student}', [StudentController::class, 'destroy'])
                ->name('students.destroy');


            // ADMIN ACCOUNT MANAGEMENT

            Route::get('/admins', [AdminController::class, 'index'])
                ->name('admins.index');

            Route::get('/admins/create', [AdminController::class, 'create'])
                ->name('admins.create');

            Route::post('/admins', [AdminController::class, 'store'])
                ->name('admins.store');

            Route::get('/admins/{admin}/edit', [AdminController::class, 'edit'])
                ->name('admins.edit');

            Route::put('/admins/{admin}', [AdminController::class, 'update'])
                ->name('admins.update');

            Route::delete('/admins/{admin}', [AdminController::class, 'destroy'])
                ->name('admins.destroy');


            // COURSE MANAGEMENT

            Route::get('/courses', [CourseController::class, 'index'])
                ->name('courses.index');

            Route::get('/courses/create', [CourseController::class, 'create'])
                ->name('courses.create');

            Route::post('/courses', [CourseController::class, 'store'])
                ->name('courses.store');

            Route::get('/courses/{course}/edit', [CourseController::class, 'edit'])
                ->name('courses.edit');

            Route::put('/courses/{course}', [CourseController::class, 'update'])
                ->name('courses.update');

            Route::delete('/courses/{course}', [CourseController::class, 'destroy'])
                ->name('courses.destroy');


            // ACADEMIC RECORDS MANAGEMENT

            Route::get('/records', [AcademicRecordController::class, 'index'])
                ->name('records.index');

            Route::get('/records/create', [AcademicRecordController::class, 'create'])
                ->name('records.create');

            Route::post('/records', [AcademicRecordController::class, 'store'])
                ->name('records.store');

            Route::get('/records/{record}/edit', [AcademicRecordController::class, 'edit'])
                ->name('records.edit');

            Route::put('/records/{record}', [AcademicRecordController::class, 'update'])
                ->name('records.update');

            Route::delete('/records/{record}', [AcademicRecordController::class, 'destroy'])
                ->name('records.destroy');


            // ANNOUNCEMENTS MANAGEMENT

            Route::get('/announcements', [AnnouncementController::class, 'index'])
                ->name('announcements.index');

            Route::get('/announcements/create', [AnnouncementController::class, 'create'])
                ->name('announcements.create');

            Route::post('/announcements', [AnnouncementController::class, 'store'])
                ->name('announcements.store');

            Route::get('/announcements/{announcement}/edit', [AnnouncementController::class, 'edit'])
                ->name('announcements.edit');

            Route::put('/announcements/{announcement}', [AnnouncementController::class, 'update'])
                ->name('announcements.update');

            Route::delete('/announcements/{announcement}', [AnnouncementController::class, 'destroy'])
                ->name('announcements.destroy');


            // ENROLLMENT MANAGEMENT

            Route::get('/enrollments', [EnrollmentController::class, 'index'])
                ->name('enrollments.index');

            Route::patch('/enrollments/{enrollment}/status', [EnrollmentController::class, 'updateStatus'])
                ->name('enrollments.updateStatus');


            // REPORTS

            Route::get('/reports', [ReportController::class, 'index'])
                ->name('reports.index');

        });


    // ======================================
    // LOGOUT
    // ======================================

    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');

});
