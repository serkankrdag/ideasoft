<?php

namespace App\Services;

use App\Models\Products;

class DiscountService
{

    public function applyDiscounts($order) {
        $this->applyTotalOrderDiscount($order);
        $this->applyCategory2Discount($order);
        $this->applyCategory1Discount($order);
    }

    protected function applyTotalOrderDiscount($order) {
        if ($order->total >= 1000) {
            $order->discount += $order->total * 0.10;
            $order->total -= $order->total * 0.10;
        }
    }

    protected function applyCategory2Discount($order) {
        $productIds = [];
        foreach ($order['items'] as $item) {
            $productIds[] = $item['productId'];
        }

        $products = Products::whereIn('id', $productIds)->get();

        foreach ($order['items'] as $item) {
            $product = $products->firstWhere('id', $item['productId']);

            if ($product && $product->category == 2 && $item['quantity'] >= 6) {
                $order->discount += $item['unitPrice'];
                $order->total -= $item['unitPrice'];
            }
        }
    }

    protected function applyCategory1Discount($order) {
        $productIds = [];
        foreach ($order['items'] as $item) {
            $productIds[] = $item['productId'];
        }

        $products = Products::whereIn('id', $productIds)->get();

        $count = 0;
        foreach ($order['items'] as $item) {
            $product = $products->firstWhere('id', $item['productId']);

            if ($product && $product->category == 1) {
                $count++;
            }
        }

        if ($count >= 2) {
            $unitPrices = array_column($order['items'], 'unitPrice');
            $minUnitPrice = min(array_map('floatval', $unitPrices));
            
            $order->discount += $minUnitPrice;
            $order->total -= $minUnitPrice;
        }
    }

}
