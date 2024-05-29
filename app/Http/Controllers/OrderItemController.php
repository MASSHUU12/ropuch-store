<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Http\Request;

class OrderItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, string $id)
    {
        $page = $request->query('page', 1);
        $limit = min($request->query('limit', 16), 256);

        $order = Order::find($id);

        if ($order === null) {
            return response([
                'message' => 'Order not found.'
            ], 404);
        }

        $items = $order->orderItems()->paginate($limit, ['*'], 'page', $page);

        return response($items);
    }

    public function index_user(Request $request, string $id)
    {
        $page = $request->query('page', 1);
        $limit = min($request->query('limit', 16), 256);

        $user = User::find(auth()->user()->id);
        $order = $user->orders()->find($id);

        if ($order === null) {
            return response([
                'message' => 'Order not found.'
            ], 404);
        }

        $items = $order->orderItems()->paginate($limit, ['*'], 'page', $page);

        return response($items);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $item = OrderItem::find($id);

        if ($item === null) {
            return response([
                'message' => 'Order item not found.'
            ], 404);
        }

        return response($item);
    }

    public function show_user(string $id)
    {
        $user = User::find(auth()->user()->id);
        $item = $user->orders()->find($id);

        if ($item === null) {
            return response([
                'message' => 'Order item not found.'
            ], 404);
        }

        return response($item);
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
