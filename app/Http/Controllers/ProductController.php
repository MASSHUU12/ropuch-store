<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $page = $request->query('page', 1);
        $limit = min($request->query('limit', 16), 256);

        $products = Product::paginate($limit, ['*'], 'page', $page);

        return response($products);
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
        $product = Product::find($id);

        if ($product === null) {
            return response([
                'message' => 'Product not found.'
            ], 404);
        }

        return response($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $fields = $request->validate([
            'name' => 'string|unique:products,name',
            'description' => 'string',
            'price' => 'decimal:2',
            'currency' => 'string|max:3|min:3|uppercase',
            'quantity' => 'integer|min:1'
        ]);

        $product = Product::find($id);

        if ($product === null) {
            return response([
                'message' => 'Product not found.'
            ], 404);
        }

        $product->update($fields);

        return response($product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $result = Product::destroy($id);

        if ($result === 0) {
            return response([
                'message' => 'Product not found.'
            ], 404);
        }

        return response([
            'message' => 'Product deleted.'
        ]);
    }
}
