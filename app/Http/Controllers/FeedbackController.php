<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Feedback;
use Illuminate\Http\Request;



class FeedbackController extends Controller
{
    

    public function create($token)
    {
        $order = Order::where('receipt_token', $token)->firstOrFail();

        if ($order->feedback) {
            return view('feedback.thanks');
        }

        return view('feedback.create', compact('order'));
    }

    public function store(Request $request, $token)
    {
        $order = Order::where('receipt_token', $token)->firstOrFail();

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500',
        ]);

        Feedback::create([
            'order_id' => $order->id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return view('feedback.thanks');
    }
    
}
