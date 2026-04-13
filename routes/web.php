<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
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


Route::get('/run', function () {
    Artisan::call('migrate');
    return "Done";
});
