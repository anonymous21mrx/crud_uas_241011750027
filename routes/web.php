<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TempatKulinerController;
use App\Http\Controllers\MenuController;
use App\Models\TempatKuliner;

Route::get('/', function () {
    $tempatKuliners = TempatKuliner::all();
    return view('welcome', compact('tempatKuliners'));
});

Route::get('/migrate', function () {
    try {
        \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
        return 'Migrations completed successfully. <a href="/">Go to Home</a>';
    } catch (\Exception $e) {
        return 'Error during migration: ' . $e->getMessage();
    }
});

Route::get('/tempat-kuliner/{id}', function ($id) {
    $kuliner = TempatKuliner::findOrFail($id);
    return view('detail', compact('kuliner'));
})->name('tempat-kuliner.show');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/tempat-kuliner/export-pdf', [TempatKulinerController::class, 'exportPdf'])->name('tempat-kuliner.export-pdf');
    Route::resource('tempat-kuliner', TempatKulinerController::class);
    Route::resource('menu', MenuController::class);
});
