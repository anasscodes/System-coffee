<?php
use App\Http\Controllers\ReceiptController;
use App\Http\Controllers\FeedbackController;
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

    $user = auth()->user();
    $today = Carbon::today();

    if ($user->isAdmin()) {
        $ordersToday = Order::whereDate('created_at', $today)->get();
    } else {
        $ordersToday = Order::whereDate('created_at', $today)
            ->where('user_id', $user->id)
            ->get();
    }

    $todayRevenue = $ordersToday->where('status', 'paid')->sum('total');
    $paidCount = $ordersToday->where('status', 'paid')->count();
    $pendingCount = $ordersToday->where('status', 'pending')->count();

// 📊 Revenue last 7 days
$revenueByDay = Order::selectRaw('DATE(created_at) as day, SUM(total) as total')
    ->where('status', 'paid')
    ->where('user_id', $user->id)
    ->whereDate('created_at', '>=', Carbon::now()->subDays(6))
    ->groupBy('day')
    ->orderBy('day')
    ->get();

    return view('dashboard', compact(
    'todayRevenue',
    'paidCount',
    'pendingCount',
    'revenueByDay'
));

})->middleware(['auth'])->name('dashboard');


Route::middleware('auth')->group(function () {

    // ✅ ROUTES ديال Customers
    Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');
    Route::get('/customers/create', [CustomerController::class, 'create'])->name('customers.create');
    Route::post('/customers', [CustomerController::class, 'store'])->name('customers.store');

    

    // ✅ ROUTES  ديالorders  
    Route::resource('orders', OrderController::class);


    Route::patch('/orders/{order}/status', [OrderController::class, 'updateStatus'])
    ->name('orders.updateStatus');


    Route::get('/orders/{order}', [OrderController::class, 'show'])
    ->name('orders.show');

    Route::get('/orders/{order}/edit', [OrderController::class, 'edit'])
    ->name('orders.edit');

    Route::put('/orders/{order}', [OrderController::class, 'update'])
    ->name('orders.update');

    Route::get('/orders/{order}/receipt', [OrderController::class, 'receipt'])
    ->name('orders.receipt');

    Route::get('/reports', [OrderController::class, 'reports'])
    ->name('reports.index');

    Route::get('/orders/{order}/pdf', [OrderController::class, 'pdf'])
    ->name('orders.pdf');

    Route::get('/receipt/{token}', [OrderController::class, 'receiptByToken'])
    ->name('orders.receipt.token');




    // ✅ ROUTES  ديالDrink   
    Route::resource('drinks', DrinkController::class);




    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


   


});



Route::get('/receipt/{token}', [ReceiptController::class, 'show'])
    ->name('receipt.show');

Route::post('/receipt/{token}/feedback', [ReceiptController::class, 'storeFeedback'])
    ->name('receipt.feedback');



require __DIR__.'/auth.php';


