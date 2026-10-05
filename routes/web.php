<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AspirationController;

Route::get('/', function () {
    return redirect()->route('aspirations.index');
});

/*
|--------------------------------------------------------------------------
| Halaman Aspirasi Siswa
|--------------------------------------------------------------------------
*/

Route::resource('aspirations', AspirationController::class)
    ->only(['index', 'store']);


/*
|--------------------------------------------------------------------------
| Login Admin
|--------------------------------------------------------------------------
*/

Route::get('/admin/login', function () {
    return view('admin.login');
})->name('admin.login');

Route::post('/admin/login', function (\Illuminate\Http\Request $request) {

    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (
        $request->email === 'admin@suarakita.com' &&
        $request->password === 'admin123'
    ) {
        session(['admin_logged_in' => true]);

        return redirect()->route('aspirations.admin');
    }

    return back()
        ->withErrors([
            'email' => 'Email atau password admin salah.'
        ])
        ->withInput();

})->name('admin.login.submit');


/*
|--------------------------------------------------------------------------
| Logout Admin
|--------------------------------------------------------------------------
*/

Route::post('/admin/logout', function () {

    session()->forget('admin_logged_in');

    return redirect()->route('admin.login');

})->name('admin.logout');


/*
|--------------------------------------------------------------------------
| Admin
|--------------------------------------------------------------------------
*/

Route::get('/admin/aspirations', [AspirationController::class, 'admin'])
    ->name('aspirations.admin');

Route::patch('/admin/aspirations/{id}/status', [AspirationController::class, 'updateStatus'])
    ->name('aspirations.updateStatus');

Route::get('/admin/aspirations/{id}/edit', [AspirationController::class, 'edit'])
    ->name('aspirations.edit');

Route::put('/admin/aspirations/{id}', [AspirationController::class, 'update'])
    ->name('aspirations.update');

Route::delete('/admin/aspirations/{id}', [AspirationController::class, 'destroy'])
    ->name('aspirations.destroy');