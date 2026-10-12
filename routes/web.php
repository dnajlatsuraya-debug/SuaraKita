<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\AspirationController;

Route::get('/', function () {
    return redirect()->route('aspirations.index');
});

// HALAMAN UTAMA DAN FORM ASPIRASI
Route::get('/aspirations', [AspirationController::class, 'index'])
    ->name('aspirations.index');

Route::post('/aspirations', [AspirationController::class, 'store'])
    ->name('aspirations.store');

// EDIT ASPIRASI DENGAN KODE RAHASIA
Route::get('/aspirations/{id}/edit', [AspirationController::class, 'edit'])
    ->name('aspirations.edit');

Route::put('/aspirations/{id}', [AspirationController::class, 'update'])
    ->name('aspirations.update');

// UPVOTE
Route::post('/aspirations/{id}/upvote', [AspirationController::class, 'upvote'])
    ->name('aspirations.upvote');

// LOGIN ADMIN
Route::get('/admin/login', function () {
    if (session('admin_logged_in')) {
        return redirect()->route('aspirations.admin');
    }

    return view('admin.login');
})->name('admin.login');

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
            'email' => 'Email atau password admin salah.',
        ])
        ->withInput($request->only('email'));
})->name('admin.login.submit');

// LOGOUT ADMIN
Route::post('/admin/logout', function (Request $request) {
    $request->session()->forget('admin_logged_in');
    $request->session()->regenerateToken();

    return redirect()->route('admin.login');
})->name('admin.logout');

// HALAMAN DAN AKSI ADMIN
Route::get('/admin/aspirations', [AspirationController::class, 'admin'])
    ->name('aspirations.admin');

Route::patch('/admin/aspirations/{id}/status', [
    AspirationController::class,
    'updateStatus',
])->name('aspirations.updateStatus');

Route::delete('/admin/aspirations/{id}', [
    AspirationController::class,
    'destroy',
])->name('aspirations.destroy');
