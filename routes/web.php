<?php

use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ProfileController;
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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [FrontendController::class, 'index'])->name('frontend.home');
Route::get('/profile/{slug}', [FrontendController::class, 'show'])->name('frontend.show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Dashboard (for both super admin & researcher)
Route::middleware(['auth', 'role:super_admin|researcher'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// Only super admin
Route::middleware(['auth', 'role:super_admin'])->group(function () {
    Route::get('/admin/researchers', function () {
        return 'Researcher management page';
    })->name('admin.researchers');
});

//frontend routes

//temp routes
Route::get('temp', [FrontendController::class, 'temp'])->name('temp');

require __DIR__.'/auth.php';
