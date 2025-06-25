<?php

use App\Models\Activity;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ManageUserController;

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
Route::get('/logout', [LoginController::class, 'logout'])->name('ghazwanForm.logout');

Route::get('/', function () {
    return view('landing-page');
});

Route::group(['middleware' => ['auth:masyarakat', 'cekMasyarakat']], function () {
    Route::post('/submit-complaint', [ComplaintController::class, 'submitComplaint'])->name('ghazwanForm.user.submit');
    Route::get('/my-complaint', [ComplaintController::class, 'showUserComplaint'])->name('ghazwanForm.user.show.complaint');
    Route::post('/update-complaint/{id}', [ComplaintController::class, 'updateComplaint'])->name('ghazwanForm.update.complaint');
    Route::get('/delete-mycomplaint/{id}', [ComplaintController::class, 'deleteComplaint'])->name('ghazwanForm.user.delete.complaint');
});
Route::Group(['middleware' => ['auth:petugas', 'cekLevel:admin,petugas']], function () {

    Route::get('/delete-complaint/{id}', [ComplaintController::class, 'deleteComplaint'])->name('ghazwanForm.delete.complaint');
    Route::get('/activity-log', [ActivityController::class, 'showActivity'])->name('ghazwanShow.activity');

    Route::get('/print', [ReportController::class, 'printData'])->name('ghazwanPrint.report');

    Route::post('/report-filter', [ReportController::class, 'filterData'])->name('ghazwanData.filter');

    Route::get('/report', [ReportController::class, 'showReport'])->name('ghazwanView.admin.report');

    Route::get('/edit-officer/{id}', [ManageUserController::class, 'editOfficer'])->name('ghazwanView.admin.edit.officer');

    Route::get('/edit-user/{id}', [ManageUserController::class, 'editUser'])->name('ghazwanView.admin.edit.user');

    Route::get('/complaint', [ComplaintController::class, 'showComplaint'])->name('ghazwanView.admin.manage.complaint');

    Route::post('/complaint/search', [ComplaintController::class, 'searchComplaint'])->name('ghazwanView.admin.search.complaint');

    Route::get('/complaint-done', [ComplaintController::class, 'showComplaintDone'])->name('ghazwanView.admin.manage.complaint.done');

    Route::post('/complaint/process', [ComplaintController::class, 'processComplaint'])->name('ghazwanView.admin.process.complaint');

    Route::get('/manage-users', [ManageUserController::class, 'showUsers'])->name('ghazwanView.admin.manage.user');

    Route::get('/manage-officers', [ManageUserController::class, 'showOfficers'])->name('ghazwanView.admin.manage.officer');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('ghazwanView.admin.dashboard');

    Route::get('/verify', [RegisterController::class, 'viewUserAccount'])->name('ghazwanView.admin.verify.user');

    Route::get('/verify-account/{id}', [RegisterController::class, 'verifyUserAccount'])->name('ghazwanForm.admin.verify.user');

    Route::get('/reject-account/{id}', [RegisterController::class, 'rejectUserAccount'])->name('ghazwanForm.admin.reject.user');

    Route::get('/register/user', [RegisterController::class, 'makeUserAccountView'])->name('ghazwanView.admin.user.add');

    Route::post('/register/user/action', [RegisterController::class, 'makeUserAccount'])->name('ghazwanForm.admin.user.add');

    Route::post('/register/user/edit/{id}', [RegisterController::class, 'editUserAccount'])->name('ghazwanForm.admin.user.edit');

    Route::get('/register/officer', [RegisterController::class, 'makeOfficerAccountView'])->name('ghazwanView.admin.officer.add');

    Route::post('/register/officer/action', [RegisterController::class, 'makeOfficerAccount'])->name('ghazwanForm.admin.officer.add');

    Route::post('/register/officer/edit/{id}', [RegisterController::class, 'editOfficerAccount'])->name('ghazwanForm.admin.officer.edit');
});




Route::post('/login-to-submit', [LoginController::class, 'index2'])->name('ghazwanView.login-submit');

Route::get('/login', [LoginController::class, 'index'])->name('ghazwanView.login');

Route::post('/login/check', [LoginController::class, 'login'])->name('ghazwanForm.login');

Route::post('/registration', [RegisterController::class, 'create'])->name('ghazwanForm.register');

Route::get('/register', [RegisterController::class, 'index'])->name('ghazwanView.register');


