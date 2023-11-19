<?php

// use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authcontroller;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

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
    return view('/register');
});

// Route::get('/login', function () {
//     return 'ini halaman login';
// })->name('login');

// untuk logout
Route::post('/logout', [Authcontroller::class, 'logout']);

// login autentikasi
Route::get('/login', [Authcontroller::class, 'loginku'])->name('login'); //index adalah parameter di Logincontroller
Route::post('/login', [Authcontroller::class, 'authenticate']); //auth adalah parameter di Logincontroller

// registrasi
Route::get('/register', [AuthController::class, 'register']);
Route::post('/register', [AuthController::class, 'registerProses']);
// email verify
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');
// jika berhasil maka tombol verify yg ada di email mengarah ke login
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    // Dispatch event Verified manually to update the user's verified_at timestamp
    return redirect('/login')->with('success', 'email berhasil diverifikasi.');;
})->middleware(['auth', 'signed'])->name('verification.verify');

// menu profile
Route::resource(
    '/profile',
    ProfileController::class
)->middleware(['auth', 'verified']);
