<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\VerificationController;
use Illuminate\Support\Facades\Artisan;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',function(){
    return view('auth.login');
});

Route::get('/admin',function(){
    return view('admin.dashboard');
});

Route::get('/register',[AuthController::class,'registerView'])->name('registerView');
Route::post('/register',[AuthController::class,'register'])->name('register');

Route::get('/verify/{token}',[VerificationController::class,'verify'])->name('verify');


Route::get('/login',[AuthController::class,'loginView'])->name('loginView');
Route::post('/login',[AuthController::class,'login'])->name('login');

Route::get('/forget-password',[AuthController::class,'forgetPasswordView'])->name('forgetPasswordView');
Route::post('/forget-password',[AuthController::class,'forgetPassword'])->name('forgetPassword');

Route::get('/reset-password/{token}',[AuthController::class,'resetPasswordView'])->name('resetPasswordView');
Route::post('/reset-password',[AuthController::class,'resetPassword'])->name('resetPassword');
Route::get('/password-updated',[AuthController::class,'PasswordUpdated'])->name('passwordUpdated');


Route::get('/dashboard', function () {
    return 'User Dashboard';
})->name('user.dashboard'); 

Route::get('/admin/dashboard', function () {
    return 'Admin Dashboard';
})->name('admin.dashboard');