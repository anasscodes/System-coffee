<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Drink;

class DrinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $drinks = Drink::orderBy('category')->orderBy('name')->get()
        ->groupBy('category');

    return view('drinks.index', compact('drinks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('drinks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            
        $request->validate([
    'name' => 'required',
    'price' => 'required|numeric',
    'category' => 'required',
]);

Drink::create([
    'name' => $request->name,
    'price' => $request->price,
    'category' => $request->category,
    'is_available' => true,
]);

        return redirect()->route('drinks.index')
            ->with('success', 'Drink added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

            return view('drinks.show', compact('drink'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('drinks.edit', compact('drink'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);

        $drink->update([
            'name'         => $request->name,
            'price'        => $request->price,
            'is_available' => $request->has('is_available'),
        ]);

        return redirect()->route('drinks.index')
            ->with('success', 'Drink updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $drink->delete();

        return redirect()->route('drinks.index')
            ->with('success', 'Drink deleted successfully');
    }
}
