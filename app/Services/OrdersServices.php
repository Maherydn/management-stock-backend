<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderStatus;
use App\Models\Product;

class OrdersServices
{
    public function createOrder(array $data)
    {
    
        $order = Order::create([
            'order_status_id' => 1,
            'title' => $data['title'],
            'total_amount' => 0,
            'user_id' => 1,
        ]);
        

        $totalAmount = 0;

        foreach ($data['products'] as $item) {
            $product = Product::findOrFail($item['product_id']);

            $buyingPrice = $product->buying_price;
            $quantity = $item['quantity'];

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'quantity' => $quantity,
                'buying_price' => $buyingPrice
            ]);

            $totalAmount += $buyingPrice * $quantity;
        }

        $order->update(['total_amount' => $totalAmount]);

        return $order->load('orderItemS');
    }

    
    public function updateOrder(array $data, Order $order)
    {
        
        if (isset($data['products']) && is_array($data['products'])) {
            
            $totalAmount = 0;

            foreach ($data['products'] as $item) {
                $productId = $item['product_id'];
                $newQuantity = $item['quantity'];
                $orderItemId = $item['order_item_id'];
    
                $product = Product::find($productId);
                $orderItem = $order->orderItems()->where('id', $orderItemId)->where('product_id', $productId)->first();
    
                if (!$product || !$orderItem) {
                    continue; 
                }
    
               
    
                $orderItem->update([
                    'quantity' => $newQuantity,
                ]);
    
                $totalAmount += $product->buying_price * $newQuantity;
            }
    
            $order->update([
                'total_amount' => $totalAmount,
            ]);
        }
    
        if (!empty($data['title'])) {
            $order->update([
                'title' => $data['title'],
            ]);
        }
    
        return $order->load('orderItems');
    }
}