<?php

use App\Http\Controllers\PrinterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
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



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth','web')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/', function () {
        return redirect('users');
    });
    Route::resources([
        'users' => UserController::class,
        'roles' => RoleController::class,
    ]);

    Route::get('/getPrinters', [PrinterController::class, 'getPrinters'])->name('getPrinters');
    Route::post('/setPrinter', [PrinterController::class, 'setPrinter']);
    Route::get('/showPrint', [PrinterController::class, 'showPrint'])->name('showPrint');
    Route::post('/printRaw', [PrinterController::class, 'printRaw']);
});

require __DIR__.'/auth.php';
