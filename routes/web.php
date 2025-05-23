<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\InstituteController;
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

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Dashboard (for both super admin & researcher)
Route::middleware(['auth', 'role:super_admin|researcher'])->group(function () {
    
});

// Only super admin
Route::middleware(['auth', 'role:super_admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/dashboard/institutes', [InstituteController::class, 'index'])->name('admin.institutes');    
    Route::get('/dashboard/divisions', [DivisionController::class, 'index'])->name('admin.divisions');    
    Route::get('/dashboard/designations', [DesignationController::class, 'index'])->name('admin.designations');    

    //institutes apis
    Route::get('api/institutes/', [InstituteController::class, 'apiIndex']);
    Route::post('api/institutes/', [InstituteController::class, 'apiStore']);
    Route::get('api/institutes/{id}', [InstituteController::class, 'apiShow']);
    Route::put('api/institutes/{id}', [InstituteController::class, 'apiUpdate']);
    Route::delete('api/institutes/{id}', [InstituteController::class, 'apiDestroy']);

    //divisions apis
    Route::get('api/divisions/', [DivisionController::class, 'apiIndex']);
    Route::post('api/divisions/', [DivisionController::class, 'apiStore']);
    Route::get('api/divisions/{id}', [DivisionController::class, 'apiShow']);
    Route::put('api/divisions/{id}', [DivisionController::class, 'apiUpdate']); 
    Route::delete('api/divisions/{id}', [DivisionController::class, 'apiDestroy']);

    //designations apis
    Route::get('api/designations/', [DesignationController::class, 'apiIndex']);
    Route::post('api/designations/', [DesignationController::class, 'apiStore']);
    Route::get('api/designations/{id}', [DesignationController::class, 'apiShow']);
    Route::put('api/designations/{id}', [DesignationController::class, 'apiUpdate']); 
    Route::delete('api/designations/{id}', [DesignationController::class, 'apiDestroy']);
});

//frontend routes

//temp routes
Route::get('temp', [FrontendController::class, 'temp'])->name('temp');

require __DIR__.'/auth.php';
