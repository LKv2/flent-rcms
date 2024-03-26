<?php

use App\Http\Controllers\CategorieController;
use App\Http\Controllers\MarqueController;
use App\Http\Controllers\carController;
use App\Http\Controllers\bookingController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\locationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\chargeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProlongationController;
use App\chargels\Prolongation;
use App\Http\Controllers\ModeController;
use App\Http\Controllers\PayPalController;
use App\Http\Controllers\TaskController;
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
            case 'booking':
                return view('booking.dashboard');
            case 'commercial':
                return view('commercial.dashboard');
        }
    })->name('dashboard');
    Route::middleware('role:admin')->group(function () {
    });
    Route::middleware('role:booking')->group(function () {
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
Route::match(['get', 'post'], '/get-available-cars', [CarController::class, 'updateAvailableCars'])->name('update.available.cars');

Route::get('/locations', [locationController::class, 'index'])->name('locations.index');
Route::get('/locations/create', [locationController::class, 'create'])->name('locations.create');
Route::post('/locations', [locationController::class, 'store'])->name('locations.store');
Route::get('/locations/{location}/edit', [locationController::class, 'edit'])->name('locations.edit');
Route::post('/locations/{location}', [locationController::class, 'update'])->name('locations.update');
Route::get('/locations/{location}', [locationController::class, 'destroy'])->name('locations.destroy');
Route::get('/getlocationls/{id}', [locationController::class, 'getlocationlOfBrand']);

Route::get('/modes', [ModeController::class, 'index'])->name('modes.index');
Route::get('/modes/create', [ModeController::class, 'create'])->name('modes.create');
Route::post('/modes', [ModeController::class, 'store'])->name('modes.store');
Route::get('/modes/{mode}/edit', [ModeController::class, 'edit'])->name('modes.edit');
Route::post('/modes/{mode}', [ModeController::class, 'update'])->name('modes.update');
Route::get('/modes/{mode}', [ModeController::class, 'destroy'])->name('modes.destroy');
Route::get('/getModels/{id}', [ModeController::class, 'getModelOfBrand']);

Route::get('/charges', [chargeController::class, 'index'])->name('charges.index');
Route::post('/charges', [chargeController::class, 'store'])->name('charges.store');
Route::get('/charges/{charge}', [chargeController::class, 'destroy'])->name('charges.destroy');

Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');
Route::get('/clients/create', [clientController::class, 'create'])->name('clients.create');
Route::post('/clients', [clientController::class, 'store'])->name('clients.store');
Route::get('/clients/{client}/edit', [clientController::class, 'edit'])->name('clients.edit');
Route::put('/clients/{client}', [clientController::class, 'update'])->name('clients.update');
Route::get('/clients/{client}/delete', [clientController::class, 'destroy'])->name('clients.destroy');
Route::get('/clients/{client}', [clientController::class, 'show'])->name('clients.show');
Route::get('/clients/document/{id}/{type}', [ClientController::class, 'document'])->name('clients.document');

Route::get('/bookings', [bookingController::class, 'index'])->name('bookings.index');
Route::get('/bookings/create', [bookingController::class, 'create'])->name('bookings.create');
Route::post('/bookings', [bookingController::class, 'store'])->name('bookings.store');
Route::get('/bookings/{booking}', [bookingController::class, 'show'])->name('bookings.show');
Route::get('/bookings/{booking}/edit', [bookingController::class, 'edit'])->name('bookings.edit');
Route::put('/bookings/{booking}', [bookingController::class, 'update'])->name('bookings.update');
Route::post('/bookings/{booking}/cancel', [bookingController::class, 'cancel'])->name('bookings.cancel');
Route::post('/bookings/{booking}/confirm', [bookingController::class, 'confirm'])->name('bookings.confirm');
Route::get('/bookings/{booking}/payement', [PaymentController::class, 'index'])->name('bookings.payement');
Route::post('/bookings/{booking}/payement', [PaymentController::class, 'store'])->name('bookings.payment.store');
Route::get('/bookings/{booking}/prolongation', [ProlongationController::class, 'index'])->name('bookings.prolongation');
Route::post('/bookings/{booking}/prolongation', [ProlongationController::class, 'store'])->name('bookings.prolongation.store');
Route::get('/bookings/{booking}/invoice', [bookingController::class, 'invoice'])->name('bookings.invoice');
Route::get('/bookings/{booking}/contract', [bookingController::class, 'contract'])->name('bookings.contract');
Route::get('/bookings/{id}/confirm', [BookingController::class, 'process'])->name('booings.confirmation');

Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
Route::post('/task/add', [TaskController::class, 'store'])->name('tasks.store');
Route::match(['POST', 'GET'], '/task/{id}/done', [TaskController::class, 'done'])->name('tasks.done');
Route::match(['POST', 'GET'], '/tasks/{date}', [TaskController::class, 'getTasksByDate'])->name('tasks.by.date');
Route::match(['POST', 'GET'], '/update-task-status/{id}', [TaskController::class, 'updateStatus'])->name('task.updateStatus');

Route::get('process-transaction/{id}', [PayPalController::class, 'process'])->name('Transaction.process');
Route::get('success-transaction/{id}/', [PayPalController::class, 'success'])->name('Transaction.success');
Route::get('cancel-transaction/{id}/', [PayPalController::class, 'cancel'])->name('Transaction.cancel');


require __DIR__ . '/auth.php';
