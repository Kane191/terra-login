<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VueController;
use App\Http\Controllers\auth\RegisterController;
use App\Http\Controllers\auth\LoginController;
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
Route::get('vue/register', [VueController::class, 'register'])->name('register');
Route::post("vue/save_user",[VueController::class, 'save_user'])->name("save_user");
Route::get("register",[RegisterController::class, 'index']);
Route::post("register/user",[RegisterController::class, 'register_user']);
Route::get("login", [LoginController::class, 'login_index']);
Route::post("login/user", [LoginController::class, 'authenticate']);
Route::get('/home', function () {
    return view('welcome');
});

