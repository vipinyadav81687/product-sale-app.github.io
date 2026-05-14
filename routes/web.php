<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\VerificationController;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\Admin\AppController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\MainController;



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
Route::get('/',[MainController::class,'index'])->name('index');
// Route::get('/',function(){
//     return view('auth.login');
// });

// Route::get('/admin',function(){
//     return view('admin.dashboard');
// });

Route::group(['middleware' => ['isAuthenticated']], function(){

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

Route::get('/mail-verification',[AuthController::class,'mailVerificationView'])->name('mailVerificationView');
Route::post('/mail-verification',[AuthController::class,'mailVerification'])->name('mailVerification');


});

Route::group(['middleware' => ['onlyAuthenticated']], function(){

Route::get('/dashboard', function () {
    return 'User Dashboard';
})->name('user.dashboard'); 

});

Route::group(['middleware' => ['onlyAuthenticated','onlyAdmin']], function(){
Route::get('/admin/dashboard', [AppController::class,'index'])->name('admin.dashboard');
Route::post('update-app-data', [AppController::class,'updateAppData'])->name('updateAppData');

//menu route
Route::get('admin/menus',[MenuController::class,'index'])->name('admin.menus');
Route::post('app-menu-create',[MenuController::class,'store'])->name('admin.menu.store');

});
