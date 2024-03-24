<?php

use App\Http\Controllers\CategorieController;
use App\Http\Controllers\MarqueController;
use App\Http\Controllers\carController;
use App\Http\Controllers\clientController;
use App\Http\Controllers\ModeController;
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
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/delete', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/categories', [CategorieController::class, 'index'])->name('categories.index');
Route::get('/categories/create', [CategorieController::class, 'create'])->name('categories.create');
Route::post('/categories', [CategorieController::class, 'store'])->name('categories.store');
Route::get('/categories/{categorie}/edit', [CategorieController::class, 'edit'])->name('categories.edit');
Route::post('/categories/{categorie}', [CategorieController::class, 'update'])->name('categories.update');
Route::get('/categories/{categorie}', [CategorieController::class, 'destroy'])->name('categories.destroy');

Route::get('/marques', [MarqueController::class, 'index'])->name('marques.index');
Route::get('/marques/create', [MarqueController::class, 'create'])->name('marques.create');
Route::post('/marques', [MarqueController::class, 'store'])->name('marques.store');
Route::get('/marques/{marque}/edit', [MarqueController::class, 'edit'])->name('marques.edit');
Route::post('/marques/{marque}', [MarqueController::class, 'update'])->name('marques.update');
Route::get('/marques/{marque}', [MarqueController::class, 'destroy'])->name('marques.destroy');

Route::get('/cars', [carController::class, 'index'])->name('cars.index');
Route::get('/cars/create', [carController::class, 'create'])->name('cars.create');
Route::post('/cars', [carController::class, 'store'])->name('cars.store');
Route::get('/cars/{car}', [carController::class, 'show'])->name('cars.show');
Route::get('/cars/{car}/edit', [carController::class, 'edit'])->name('cars.edit');
Route::post('/cars/{car}', [carController::class, 'update'])->name('cars.update');
Route::get('/cars/{car}/delete', [carController::class, 'destroy'])->name('cars.destroy');

Route::get('/modes', [ModeController::class, 'index'])->name('modes.index');
Route::get('/modes/create', [ModeController::class, 'create'])->name('modes.create');
Route::post('/modes', [ModeController::class, 'store'])->name('modes.store');
Route::get('/modes/{mode}/edit', [ModeController::class, 'edit'])->name('modes.edit');
Route::post('/modes/{mode}', [ModeController::class, 'update'])->name('modes.update');
Route::get('/modes/{mode}', [ModeController::class, 'destroy'])->name('modes.destroy');
Route::get('/getModels/{id}', [ModeController::class, 'getModelOfBrand']);

Route::get('/clients', [clientController::class, 'index'])->name('clients.index');
Route::get('/clients/create', [clientController::class, 'create'])->name('clients.create');
Route::post('/clients', [clientController::class, 'store'])->name('clients.store');
Route::get('/clients/{client}/edit', [clientController::class, 'edit'])->name('clients.edit');
Route::put('/clients/{client}', [clientController::class, 'update'])->name('clients.update');
Route::get('/clients/{client}/delete', [clientController::class, 'destroy'])->name('clients.destroy');
Route::get('/clients/{client}', [clientController::class, 'show'])->name('clients.show');
Route::get('/clients/document/{id}/{type}', [ClientController::class, 'document'])->name('clients.document');


require __DIR__ . '/auth.php';
