<?php declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;

/**
 * Provides functionality for managing orders in the application.
 * 
 * @author Farsang Balázs <farsangbalazs617@gmail.com>
 */
class OrderController extends Controller
{
    /**
     * Create a new order.
     *
     * @param \Illuminate\Http\Request $request
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
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

    /**
     * Get all orders for the specified restaurant.
     *
     * @param int $restaurantId The ID of the restaurant to fetch orders for.
     * 
     * @return \Illuminate\Http\JsonResponse A JSON response containing the orders.
     */
    public function restaurantOrders($restaurantId): \Illuminate\Http\JsonResponse
    {
        $orders = Order::where('restaurant_id', $restaurantId)->get();
        return response()->json($orders);
    }

    /**
     * Update the specified order.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id): \Illuminate\Http\JsonResponse
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

    /**
     * Get the specified order.
     *
     * @param int $id The ID of the order to retrieve.
     * 
     * @return \Illuminate\Http\JsonResponse A JSON response containing the order.
     */
    public function show($id): \Illuminate\Http\JsonResponse
    {
        $order = Order::with('orderItems')->find($id);

        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }

        return response()->json($order);
    }
}
