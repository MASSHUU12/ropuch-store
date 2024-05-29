<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $page = $request->query('page', 1);
        $limit = min($request->query('limit', 16), 256);

        $orders = Order::paginate($limit, ['*'], 'page', $page);

        return response($orders);
    }

    public function index_user(Request $request)
    {
        $page = $request->query('page', 1);
        $limit = min($request->query('limit', 16), 256);

        $user = User::find(auth()->user()->id);
        $orders = $user->orders()->paginate($limit, ['*'], 'page', $page);

        return response($orders);
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
        $order = Order::find($id);

        if ($order === null) {
            return response([
                'message' => 'Order not found.'
            ], 404);
        }

        return response($order);
    }

    public function show_user(string $id)
    {
        $user = User::find(auth()->user()->id);
        $order = $user->orders()->find($id);

        if ($order === null) {
            return response([
                'message' => 'Order not found.'
            ], 404);
        }

        return response($order);
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
