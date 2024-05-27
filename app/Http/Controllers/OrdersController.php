<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Orders;
use App\Models\Products;

class OrdersController extends Controller
{
    
    public function ordersList() {
        // Orders::truncate();
        $orders = Orders::all()->makeHidden(['created_at', 'updated_at']);
        return response()->json($orders);
    }

    public function ordersAdd(Request $request) {
        $validatedData = $request->validate([
            'customerId' => 'required|exists:customers,id',
            'items' => 'required|array',
            'items.*.productId' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        $customerId = $validatedData['customerId'];
        $items = $validatedData['items'];

        $total = 0;
        $orderItems = [];

        foreach ($items as $item) {
            $productId = $item['productId'];
            $quantity = $item['quantity'];
            $product = Products::findOrFail($productId);

            if ($product->stock < $quantity) {
                return response()->json(['error' => 'Ürün stoğu yetersiz'], 400);
            }

            $orderItem = [
                'productId' => $productId,
                'quantity' => $quantity,
                'unitPrice' => $product->price,
                'total' => $product->price * $quantity,
            ];

            $orderItems[] = $orderItem;

            $product->stock -= $quantity;
            $product->save();
        }   

        $order = new Orders();
        $order->customerId = $customerId;
        $order->items = $orderItems;
        $order->total = $total;
        $order->save();

        return response()->json(['message' => 'Sipariş başarıyla eklendi'], 201);
    }

    public function ordersDelete(Request $request) {
        $validatedData = $request->validate([
            'orderId' => 'required|exists:orders,id',
        ]);
    
        $orderId = $validatedData['orderId'];
        $order = Orders::findOrFail($orderId);
    
        if ($order) {
            $order->delete();
            return response()->json(['message' => 'Sipariş başarıyla silindi'], 200);
        } else {
            return response()->json(['error' => 'Sipariş bulunamadı'], 404);
        }
    }

}
