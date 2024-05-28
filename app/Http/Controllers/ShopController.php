<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function place_order(Request $request)
    {
        $fields = $request->validate([
            'products' => 'required|array',
            'products.*.id' => 'required|integer|min:0',
            'products.*.quantity' => 'required|integer|min:1',
            'buyer_name' => 'required|string',
            'buyer_email' => 'required|email',
            'delivery_address' => 'required|string',
            'delivery_city' => 'required|string',
            'delivery_zip' => 'required|string',
            'delivery_country' => 'required|string',
        ]);

        $products = $fields['products'];

        $total_price = 0;

        // Calculate the total price of the order,
        // check if the products exist in the database,
        // check if the quantity of the products is valid
        // and change quantity of the products in the database
        foreach ($products as $product) {
            $product_id = $product['id'];
            $quantity = $product['quantity'];

            $product = Product::find($product_id);

            if (!$product) {
                return response()->json([
                    'message' => 'Product not found',
                ], 404);
            }

            if ($quantity > $product->quantity) {
                return response()->json([
                    'message' => 'Not enough stock for ' . $product->name,
                ], 400);
            }

            $product->quantity -= $quantity;
            $product->save();

            $total_price += $product->price * $quantity;
        }

        // Create an order in the database
        $order = Order::create([
            'user_id' => auth()->id(),
            'status' => 'pending',
        ]);

        $order->orderDetails()->create([
            'buyer_name' => $fields['buyer_name'],
            'buyer_email' => $fields['buyer_email'],
            'delivery_address' => $fields['delivery_address'],
            'delivery_city' => $fields['delivery_city'],
            'delivery_zip' => $fields['delivery_zip'],
            'delivery_country' => $fields['delivery_country'],
        ]);

        foreach ($products as $product) {
            $product_id = $product['id'];
            $quantity = $product['quantity'];

            $product = Product::find($product_id);

            $order->orderItems()->create([
                'product_id' => $product_id,
                'quantity' => $quantity,
                'price' => $product->price,
            ]);
        }

        return response()->json([
            'message' => 'Order placed successfully',
            'total_price' => $total_price,
            'payment_url' => 'https://example.com/payments/checkout?order_id=' . $order->id,
        ]);
    }
}
