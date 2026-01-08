<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class ReceiptController extends Controller
{
     public function show($token)
    {
        $order = Order::where('receipt_token', $token)
            ->with('drinks')
            ->firstOrFail();

        return view('receipt.show', compact('order'));
    }

    public function storeFeedback(Request $request, $token)
    {
        $order = Order::where('receipt_token', $token)->firstOrFail();

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
        ]);

        // Version بسيطة بلا DB جديدة
        $order->update([
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return back()->with('success', 'Thanks for your feedback ⭐');
    }
}
