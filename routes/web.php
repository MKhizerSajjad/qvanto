<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VednorController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CounselorController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ExaminationController;
use App\Http\Controllers\CasesController;
use App\Http\Controllers\CaseDetailController;
use App\Http\Controllers\SalaryController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


// Route::get('/dashboard', function () {
//     return view('admin/dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');
    Route::get('/home', [DashboardController::class, 'index'])->name('home');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // validations according to loggedin user type
    Route::resource('vendor', VednorController::class);
    Route::resource('lead', LeadController::class);

    Route::prefix('lead')->group(function () {
        Route::get('{lead}/comment', [LeadController::class, 'comment'])->name('lead.comment');
        Route::put('{lead}/comment-update', [LeadController::class, 'commentUpdate'])->name('lead.commentUpdate');
    });
    Route::resource('admins', AdminController::class);
    Route::resource('employee', EmployeeController::class);
    Route::resource('counselor', CounselorController::class);
    Route::resource('customer', CustomerController::class);
    Route::resource('appointment', AppointmentController::class);
    Route::resource('examination', ExaminationController::class);
    // Route::get('/case/{appiontment}', [CasesController::class, 'create'])->name('casreStart');
    Route::resource('case', CasesController::class);
    Route::resource('case-detail', CaseDetailController::class);
    Route::resource('salary', SalaryController::class);
    Route::get('/get-salary-detail/{employee}', [SalaryController::class, 'getSalaryDetail'])->name('get-salary-detail');
});

require __DIR__.'/auth.php';
