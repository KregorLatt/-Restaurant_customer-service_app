<?php
use App\Http\Controllers\MenuItemController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\OrderStatusController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('MenuItem', MenuItemController::class)
    ->middleware(['auth', 'verified']);

Route::resource('orders', OrdersController::class)
    ->middleware(['auth', 'verified']);

Route::get('/OrderStatus', [OrderStatusController::class, 'index'])->name('OrderStatus.index');
Route::patch('/OrderStatus/{order}', [OrderStatusController::class, 'update'])->name('OrderStatus.update');
Route::post('/OrderStatus/{order}', [OrderStatusController::class, 'done'])->name('orders.done');
Route::post('/orders/{order}', [OrdersController::class, 'delivered'])->name('orders.delivered');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


});

require __DIR__.'/auth.php';
