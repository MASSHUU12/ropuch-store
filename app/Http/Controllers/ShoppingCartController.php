<?php

namespace App\Http\Controllers;

use App\Models\ShoppingCart;
use App\Models\User;
use Illuminate\Http\Request;

class ShoppingCartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(auth()->user()->shoppingCarts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $user = User::find(auth()->id());
        $cart = $user->shoppingCarts()
            ->where('product_id', $fields['product_id'])->first();

        if ($cart) {
            $cart->quantity += $fields['quantity'];
            $cart->save();

            return response()->json($cart, 201);
        }

        $cart = $user->shoppingCarts()->create($fields);

        return response()->json($cart, 201);
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
        $fields = $request->validate([
            'product_id' => 'exists:products,id',
            'quantity' => 'integer|min:1'
        ]);

        $cart = ShoppingCart::find($id);

        if ($cart === null) {
            return response()->json([
                'message' => 'Shopping cart not found.'
            ], 404);
        }

        $cart->update($fields);

        return response()->json($cart, 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find(auth()->id());
        $cart = $user->shoppingCarts()->where('id', $id);

        if ($cart === null) {
            return response()->json([
                'message' => 'Shopping cart not found.'
            ], 404);
        }

        $result = $cart->delete();

        return response()->json([
            'message' => $result
                ? "Shopping cart deleted."
                : "Shopping cart not found."
        ]);
    }

    /**
     * Remove all resources from storage.
     */
    public function destroy_all()
    {
        $user = User::find(auth()->id());
        $result = $user->shoppingCarts()->delete();

        return response()->json([
            'message' => $result
                ? "All shopping carts deleted."
                : "No shopping carts found."
        ]);
    }
}
