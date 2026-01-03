<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Drink;
use App\Models\Customer;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();

    if ($user->isAdmin() || $user->isCashier()) {
        // يشوف جميع الطلبات
        $orders = Order::with(['drinks', 'customer'])
            ->latest()
            ->get();
    } else {
        // server يشوف غير ديالو
        $orders = Order::with(['drinks', 'customer'])
            ->where('user_id', $user->id)
            ->latest()
            ->get();
    }

    return view('orders.index', compact('orders'));
    //     $orders = Order::with(['drinks', 'customer'])
    //     ->where('user_id', auth()->id())
    //     ->latest()
    //     ->get();

    // return view('orders.index', compact('orders'));
   
    }



    public function reports()
{
    $today = Carbon::today();
    $month = Carbon::now()->month;

    $orders = Order::where('status', 'paid');

    $dailyRevenue = (clone $orders)
        ->whereDate('created_at', $today)
        ->sum('total');

    $monthlyRevenue = (clone $orders)
        ->whereMonth('created_at', $month)
        ->sum('total');

    $paidCount = Order::where('status', 'paid')->count();
    $pendingCount = Order::where('status', 'pending')->count();

    return view('reports.index', compact(
        'dailyRevenue',
        'monthlyRevenue',
        'paidCount',
        'pendingCount'
    ));
}

public function pdf(Order $order)
{
    abort_if($order->user_id !== auth()->id(), 403);

    $order->load('drinks');

    $pdf = Pdf::loadView('orders.pdf', compact('order'));

    return $pdf->download('order-'.$order->id.'.pdf');
}

    public function create()
    {
        $drinks = Drink::all();
    return view('orders.create', compact('drinks'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
          $request->validate([
        'drinks' => 'required|array',
        'quantities' => 'required|array',
        'table_number' => 'nullable|integer',
        'customer_phone' => 'nullable|string',
    ]);

    // 🧠 logic ديال customer
    $customerId = null;

    if ($request->filled('customer_phone')) {
        $customer = Customer::firstOrCreate(
            ['phone' => $request->customer_phone],
            [
                'name' => null,
                'user_id' => auth()->id(),
            ]
        );

        $customerId = $customer->id;
    }

    // ✨ إنشاء order
    $order = Order::create([
        'user_id' => auth()->id(),
        'customer_id' => $customerId,
        'table_number' => $request->table_number,
        'total' => 0,
        'status' => 'pending',
    ]);

    $total = 0;

    foreach ($request->drinks as $drinkId) {
        $quantity = $request->quantities[$drinkId] ?? 0;
        $drink = Drink::find($drinkId);

        if ($drink && $quantity > 0) {
            $order->drinks()->attach($drinkId, [
                'quantity' => $quantity
            ]);

            $total += $drink->price * $quantity;
        }
    }

    $order->update(['total' => $total]);

    return redirect()
    ->route('orders.show', $order)
    ->with('success', 'Order created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
         // security: غير صاحب الحساب
    if ($order->user_id !== auth()->id()) {
        abort(403);
    }

    $order->load('drinks');

    return view('orders.show', compact('order'));
    }



    public function receipt(Order $order)
{
    abort_if($order->user_id !== auth()->id(), 403);

    $order->load(['drinks', 'customer']);

    return view('orders.receipt', compact('order'));
}



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        abort_if($order->user_id !== auth()->id(), 403);
    abort_if($order->status !== 'pending', 403);

    $request->validate([
        'quantities' => 'required|array',
    ]);

    $total = 0;
    $syncData = [];

    foreach ($request->quantities as $drinkId => $qty) {
        if ($qty > 0) {
            $drink = Drink::find($drinkId);
            if ($drink) {
                $syncData[$drinkId] = ['quantity' => $qty];
                $total += $drink->price * $qty;
            }
        }
    }

    $order->drinks()->sync($syncData);
    $order->update(['total' => $total]);

    return redirect()
    ->route('orders.show', $order)
    ->with('success', 'Order updated');
    }

public function updateStatus(Request $request, Order $order)
{
    abort_if(!auth()->user()->canPay(), 403);
    abort_if($order->status !== 'pending', 403);

    $request->validate([
        'status' => 'required|in:paid,cancelled',
    ]);

    $order->update([
        'status' => $request->status,
    ]);

    // ✅ إلى تخلص → مشي مباشرة للـ receipt
    if ($request->status === 'paid') {
        return redirect()->route('orders.receipt', $order);
    }

    return back()->with('success', 'Order status updated');
}

    public function edit(Order $order)
{
    abort_if($order->user_id !== auth()->id(), 403);
    abort_if($order->status !== 'pending', 403);

    $order->load('drinks');
    $drinks = Drink::all();

    return view('orders.edit', compact('order', 'drinks'));
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
