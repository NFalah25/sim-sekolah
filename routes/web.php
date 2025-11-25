<?php

use App\Http\Controllers\AchievementController;
use App\Http\Controllers\ExtracurricularController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/new', function () {
    return view('new');
});
Route::get('/new2', function () {
    return view('new2');
});
Route::get('/visi-misi', [HomeController::class, 'visiMisi'])->name('landing.visi-misi');
Route::get('/fasilitas', [HomeController::class, 'fasilitas'])->name('landing.fasilitas');
Route::get('/guru', [HomeController::class, 'guru'])->name('landing.guru');
Route::get('/berita', [HomeController::class, 'berita'])->name('landing.berita');
Route::get('/ekstrakurikuler', [HomeController::class, 'ekstrakurikuler'])->name('landing.ekstrakurikuler');
Route::get('/prestasi', [HomeController::class, 'prestasi'])->name('landing.prestasi');
Route::get('/pengumuman', [HomeController::class, 'pengumuman'])->name('landing.pengumuman');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::group(['prefix' => 'admin'], function () {
        Route::resource('fasilitas', FacilityController::class);
        Route::resource('berita', NewsController::class);
        Route::post('berita/draft', [NewsController::class, 'storeDraft'])->name('berita.storeDraft');
        Route::put('berita/draft', [NewsController::class, 'updateDraft'])->name('berita.updateDraft');
        Route::resource('prestasi', AchievementController::class);
        Route::resource('ekstrakurikuler', ExtracurricularController::class);
        Route::resource('guru', TeacherController::class);
        Route::resource('user', UserController::class);
        Route::resource('acara', EventController::class);
    });

    Route::get('/stisla', function () {
        return view('app.Template');
    })->name('stisla');
});
