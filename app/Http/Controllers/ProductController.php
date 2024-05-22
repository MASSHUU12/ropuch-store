<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string|unique:products,name',
            'description' => 'required|string',
            'price' => 'required|decimal:2',
            'currency' => 'required|string|max:3|min:3|uppercase',
            'quantity' => 'required|integer|min:1'
        ]);

        $product = Product::create([
            'name' => $fields['name'],
            'description' => $fields['description'],
            'price' => $fields['price'],
            'currency' => $fields['currency'],
            'quantity' => $fields['quantity']
        ]);

        return response($product, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
