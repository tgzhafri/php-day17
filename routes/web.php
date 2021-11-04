<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//prefix means url will start with admin/...
Route::prefix('admin')->group(function () {
    Route::any('/', [AuthController::class, 'login'])->name('login');
    Route::any('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::group([
        'middleware' => 'auth',
    
    ], function () {
        Route::any('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

        Route::any('/user', [AdminController::class, 'user'])->name('admin.user');
        Route::any('/userEdit/{id}', [AdminController::class, 'userEdit'])->name('userEdit');
        Route::any('/userRegister', [AdminController::class, 'userRegister'])->name('userRegister');
        Route::any('/userDestroy/{id}', [AdminController::class, 'userDestroy'])->name('userDestroy');
    
        Route::any('/department', [AdminController::class, 'department'])->name('admin.department');
        Route::any('/departmentEdit/{id}', [AdminController::class, 'departmentEdit'])->name('departmentEdit');
        Route::any('/departmentRegister', [AdminController::class, 'departmentRegister'])->name('departmentRegister');
        Route::any('/departmentDestroy/{id}', [AdminController::class, 'departmentDestroy'])->name('departmentDestroy');

    
        Route::any('/job', [AdminController::class, 'job'])->name('admin.job');
        Route::any('/jobEdit/{id}', [AdminController::class, 'jobEdit'])->name('jobEdit');
        Route::any('/jobRegister', [AdminController::class, 'jobRegister'])->name('jobRegister');
        Route::any('/jobDestroy/{id}', [AdminController::class, 'jobDestroy'])->name('jobDestroy');

    });




});

// Route::middleware(['auth'])->group(function () {
//     Route::get('/users', [UserController::class, 'index'])->name('users');

//     Route::any('/company/edit/{id}', [CompanyController::class, 'edit'])
//     ->middleware('signed2')
//     ->name('company.edit');
// });