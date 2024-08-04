<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'customerId' => 'required|exists:users,id',
            'restaurantId' => 'required|exists:restaurants,id',
            'items' => 'required|array',
            'items.*.itemId' => 'required|exists:menus,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.special_instructions' => 'nullable|string',
        ]);

        $order = Order::create([
            'customer_id' => $validatedData['customerId'],
            'restaurant_id' => $validatedData['restaurantId'],
            'status' => 'received',
        ]);

        foreach ($validatedData['items'] as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'menu_id' => $item['itemId'],
                'quantity' => $item['quantity'],
                'special_instructions' => $item['special_instructions'] ?? '',
            ]);
        }

        return response()->json($order);
    }

    public function restaurantOrders($restaurantId)
    {
        $orders = Order::where('restaurant_id', $restaurantId)->get();
        return response()->json($orders);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'status' => 'required|in:received,preparing,ready,delivered',
        ]);

        $order = Order::find($id);

        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }

        $order->status = $validatedData['status'];
        $order->save();

        return response()->json($order);
    }

    public function show($id)
    {
        $order = Order::with('orderItems')->find($id);

        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }

        return response()->json($order);
    }
}
