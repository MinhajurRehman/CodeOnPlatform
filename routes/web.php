<?php

use App\Http\Controllers\adminLogin;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ThreadController;
use Illuminate\Support\Facades\Route;

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

// User Routes

// Login Routes
Route::get('/', [LoginController::class, 'login']);
Route::post('registeruser', [LoginController::class, 'registerUser']);
Route::post('loginuser', [LoginController::class, 'loginUser'])->name('loginuser');
Route::get('logout', [LoginController::class, 'logout']);

// social media login's integration
// Route::get('/auth/github/redirect',[LoginController::class,'githubredirect'])->name('githublogin');
// Route::get('/auth/github/callback',[LoginController::class,'githubcallback']);

// Route::get('/auth/google/redirect',[LoginController::class,'googleredirect'])->name('googlelogin');
// Route::get('/auth/google/callback',[LoginController::class,'googlecallback']);

Route::get('/thread', [ThreadController::class, 'thread']);
Route::post('/thread', [ThreadController::class, 'thread_store']);

Route::post('/comment', [ThreadController::class, 'comments'])->name('commentsave');

Route::post('/complaint', [ThreadController::class, 'complaint'])->name('reports');

Route::get('/leaderboard', function () {
    return view('leaderboard');
});

Route::get('/challenge', function () {
    return view('challenge');
});

Route::get('/profile', function () {
    return view('profile');
});

Route::get('/search', function () {
    return view('search');
});

Route::get('/setting', function () {
    return view('setting');
});

Route::get('/tournament', function () {
    return view('tournament');
});

// Admin Routes
Route::get('/AdminPanel', function () {
    return view('Admin.adminLogin');
});
Route::post('/AdminPanel', [adminLogin::class, 'adminlogin']);

Route::get('/admin-Dashboard', function () {
    return view('Admin.adminDashboard');
});
