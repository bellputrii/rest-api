<?php

use App\Http\Controllers\Auth\LoginRegisterController;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\SendEmailController;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\UserDaftarController;
use App\Http\Controllers\SendDaftarController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/admin', function () {
    return view('auth/admin');
});

Route::get('restricted', function () {
    return redirect()->route('welcome')->withSuccess("Anda berusia lebih dari 18 tahun!");
})->middleware('checkage');

Route::get('admin', function () {
    return redirect()->route('welcome')->withSuccess("Selamat datang pada laman admin!");
})->middleware('admin');

Route::controller(LoginRegisterController::class)->group(function() {
    Route::get('/register','register')->name('register');
    Route::post('/store','store')->name('store');
    Route::get('/login','login')->name('login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::get('/dashboard','dashboard')->name('dashboard');
    Route::get('/users','users')->name('users123');
    Route::post('/logout','logout')->name('logout');
});


Route::post('/gallery', 'GalleryController@store')->name('gallery.store');

Route::resource('gallery', GalleryController::class);

Route::resource('create', GalleryController::class);

Route::resource('edit', GalleryController::class);


Route::get('send-email', [SendEmailController::class, 'index'])->name('kirim-email');

Route::post('post-email', [SendEmailController::class, 'store'])->name('post-email');

// Send Daftar Controller
Route::get('/user-register', [SendDaftarController::class, 'index'])->name('user-register');
Route::post('/user-registered', [SendDaftarController::class, 'store'])->name('user-registered');


Route::get('/test-email', function () {
    Mail::raw('Testing email configuration', function ($message) {
        $message->to('beldaputri5@gmail.com')
                ->subject('Test Email');
    });

    return 'Test email sent!';
});
