<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
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

Route::get('/', function () {
    return view('landing-page');
});


Route::get('/edit-officer/{id}', [ManageUserController::class, 'editOfficer'])->name('ghazwanView.admin.edit.officer');

Route::get('/edit-user/{id}', [ManageUserController::class, 'editUser'])->name('ghazwanView.admin.edit.user');

Route::get('/manage-users', [ManageUserController::class, 'showUsers'])->name('ghazwanView.admin.manage.user');

Route::get('/manage-officers', [ManageUserController::class, 'showOfficers'])->name('ghazwanView.admin.manage.officer');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('ghazwanView.users.dashboard');

Route::get('/login', [LoginController::class, 'index'])->name('ghazwanView.login');

Route::post('/login/check', [LoginController::class, 'login'])->name('ghazwanForm.login');

Route::post('/registration', [RegisterController::class, 'create'])->name('ghazwanForm.register');

Route::get('/register', [RegisterController::class, 'index'])->name('ghazwanView.register');

Route::get('/register/user', [RegisterController::class, 'makeUserAccountView'])->name('ghazwanView.admin.user.add');

Route::post('/register/user/action', [RegisterController::class, 'makeUserAccount'])->name('ghazwanForm.admin.user.add');

Route::post('/register/user/edit/{id}', [RegisterController::class, 'editUserAccount'])->name('ghazwanForm.admin.user.edit');

Route::get('/register/officer', [RegisterController::class, 'makeOfficerAccountView'])->name('ghazwanView.admin.officer.add');

Route::post('/register/officer/action', [RegisterController::class, 'makeOfficerAccount'])->name('ghazwanForm.admin.officer.add');

Route::post('/register/officer/edit/{id}', [RegisterController::class, 'editOfficerAccount'])->name('ghazwanForm.admin.officer.edit');

