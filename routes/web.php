<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;

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

Route::get('/',[CustomAuthController::class, 'login'] )->middleware('alreadyLoggedIn');

Route::get('/login', [CustomAuthController::class, 'login'])->middleware('alreadyLoggedIn');
Route::get('/registration', [CustomAuthController::class, 'registration'])->middleware('alreadyLoggedIn');
Route::post('/register-user',[CustomAuthController::class, 'registerUser'])->name('register-user');
Route::post('/login-user',[CustomAuthController::class, 'loginUser'])->name('login-user');
Route::get('/userdashboard',[CustomAuthController::class, 'userdashboard'])->middleware('isLoggedIn');
Route::get('/admindashboard',[CustomAuthController::class, 'admindashboard'])->middleware('isLoggedIn');

// Route::get('/users', [CustomAuthController::class, 'admindashboard']);
// Route::get('/registration', [CustomAuthController::class, 'registerUser']);

Route::get('admindashboard/create', [CustomAuthController::class, 'create']);
Route::post('admindashboard/create', [CustomAuthController::class, 'store']);

Route::get('admindashboard/{id}/edit', [CustomAuthController::class, 'edit']);
Route::put('admindashboard/{id}/edit', [CustomAuthController::class, 'update']);

Route::get('admindashboard/{id}/delete', [CustomAuthController::class, 'destroy']);

Route::get('/logout', [CustomAuthController::class, 'logout']);