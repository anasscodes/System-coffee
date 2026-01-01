<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DrinkController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;
use Carbon\Carbon;
use App\Models\Order;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', function () {

    $today = Carbon::today();

    $ordersToday = Order::whereDate('created_at', $today)
        ->where('user_id', auth()->id())
        ->get();

    $todayRevenue = $ordersToday
        ->where('status', 'paid')
        ->sum('total');

    $paidCount = $ordersToday->where('status', 'paid')->count();
    $pendingCount = $ordersToday->where('status', 'pending')->count();

    return view('dashboard', compact(
        'todayRevenue',
        'paidCount',
        'pendingCount'
    ));
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {

    // ✅ ROUTES ديال Customers
    Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');
    Route::get('/customers/create', [CustomerController::class, 'create'])->name('customers.create');
    Route::post('/customers', [CustomerController::class, 'store'])->name('customers.store');

    // ✅ ROUTES  ديالorders  
    Route::resource('orders', OrderController::class);

    // Route::patch('/orders/{order}/status', [OrderController::class, 'updateStatus'])
    // ->name('orders.status');
    Route::patch('/orders/{order}/status', [OrderController::class, 'updateStatus'])
    ->name('orders.updateStatus');


    Route::get('/orders/{order}', [OrderController::class, 'show'])
    ->name('orders.show');

    Route::get('/orders/{order}/edit', [OrderController::class, 'edit'])
    ->name('orders.edit');

    Route::put('/orders/{order}', [OrderController::class, 'update'])
    ->name('orders.update');



    // ✅ ROUTES  ديالDrink   
    Route::resource('drinks', DrinkController::class);




    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::resource('customers', CustomerController::class);
    Route::resource('drinks', DrinkController::class);


});

require __DIR__.'/auth.php';


