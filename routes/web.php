<?php
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and will be assigned to the
| "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified', 'activation'])->group(function () {
    Route::get('/dashboard', function () {
        switch (Auth::user()->role) {
            case 'admin':
                return view('admin.dashboard');
            case 'client':
                return view('client.dashboard');
            case 'commercial':
                return view('commercial.dashboard');
        }
    })->name('dashboard');
    Route::middleware('role:admin')->group(function () {
        
    });
    Route::middleware('role:client')->group(function () {
        
    });
    Route::middleware('role:commercial')->group(function () {
        
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
