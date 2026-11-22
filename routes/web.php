<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\AspirationController;

// Halaman utama
Route::get('/', function () {
    return redirect()->route('aspirations.index');
});

// Halaman aspirasi
Route::get('/aspirations', [AspirationController::class, 'index'])
    ->name('aspirations.index');

// Mengirim aspirasi
Route::post('/aspirations', [AspirationController::class, 'store'])
    ->name('aspirations.store');

// Mengedit aspirasi
Route::get('/aspirations/{id}/edit', [AspirationController::class, 'edit'])
    ->name('aspirations.edit');

Route::put('/aspirations/{id}', [AspirationController::class, 'update'])
    ->name('aspirations.update');

// Memberikan vote
Route::post('/aspirations/{id}/upvote', [AspirationController::class, 'upvote'])
    ->name('aspirations.upvote');


// ==============================
// ADMIN
// ==============================

// Halaman login admin
Route::get('/admin/login', function () {
    if (session('admin_logged_in')) {
        return redirect()->route('aspirations.admin');
    }

    return view('admin.login');
})->name('admin.login');

// Proses login admin
Route::post('/admin/login', function (Request $request) {

    $request->validate([
        'email' => 'required|email',
        'password' => 'required|string',
    ]);

    if (
        $request->email === 'admin@suarakita.com' &&
        $request->password === 'admin123'
    ) {
        $request->session()->regenerate();

        session(['admin_logged_in' => true]);

        return redirect()->route('aspirations.admin');
    }

    return back()
        ->withErrors([
            'email' => 'Email atau password admin salah.'
        ])
        ->withInput($request->only('email'));

})->name('admin.login.submit');

// Logout admin
Route::post('/admin/logout', function (Request $request) {

    $request->session()->forget('admin_logged_in');

    $request->session()->regenerateToken();

    return redirect()->route('admin.login');

})->name('admin.logout');


// Halaman dashboard admin
Route::get('/admin/aspirations', [AspirationController::class, 'admin'])
    ->name('aspirations.admin');

// Mengubah status aspirasi
Route::patch('/admin/aspirations/{id}/status', [AspirationController::class, 'updateStatus'])
    ->name('aspirations.updateStatus');

// Menghapus aspirasi
Route::delete('/admin/aspirations/{id}', [AspirationController::class, 'destroy'])
    ->name('aspirations.destroy');


// ==============================
// LAPORAN BULANAN
// ==============================

// Halaman laporan bulanan
Route::get('/admin/laporan', [AspirationController::class, 'report'])
    ->name('aspirations.report');

// Ekspor laporan ke Excel (CSV)
Route::get('/admin/laporan/excel', [AspirationController::class, 'exportReportExcel'])
    ->name('aspirations.report.excel');