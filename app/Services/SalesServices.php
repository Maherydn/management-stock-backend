<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleItem;
use Illuminate\Http\Exceptions\HttpResponseException;

class SalesServices
{
    public function createSale(array $data)
    {
        $sale = Sale::create([
            'title' => $data['title'],
            'total_amount' => 0,
            'user_id' => 1
        ]);

        $totalAmount = 0;

        foreach ($data['products'] as $item) {
            $product = Product::findOrFail($item['product_id']);

            $unitPrice = $product->unit_price;
            $buyingPrice = $product->buying_price;
            $quantity = $item['quantity'];

            // Vérifie la quantité disponible
            if ($product->quantity <  $item['quantity']) {
                return null;
            }

            // Décrémente le stock
            $product->decrement('quantity',  $item['quantity']);

            SaleItem::create([
                'sale_id' => $sale->id,
                'product_id' => $product->id,
                'quantity' => $quantity,
                'unit_price' => $unitPrice,
                'buying_price' => $buyingPrice
            ]);

            $totalAmount += $unitPrice * $quantity;
        }

        $sale->update(['total_amount' => $totalAmount]);

        return $sale->load('saleItems');
    }

    
    public function updateSale(array $data, Sale $sale)
    {
        
        if (isset($data['products']) && is_array($data['products'])) {
            
            $totalAmount = 0;

            foreach ($data['products'] as $item) {
                $productId = $item['product_id'];
                $newQuantity = $item['quantity'];
                $saleItemId = $item['sale_item_id'];
    
                $product = Product::find($productId);
                $saleItem = $sale->saleItems()->where('id', $saleItemId)->where('product_id', $productId)->first();
    
                if (!$product || !$saleItem) {
                    continue; 
                }
    
                // Update stock based on diff
                $oldQuantity = $saleItem->quantity;
                $diff = $newQuantity - $oldQuantity;
    
                if ($diff > 0 && $product->quantity < $diff) {

                    //Keep old quantity if not enough stock
                    $totalAmount += $product->unit_price * $oldQuantity;
                    
                    continue; 
                }
    
                if ($diff > 0) {
                    $product->decrement('quantity', $diff);
                } elseif ($diff < 0) {
                    $product->increment('quantity', abs($diff));
                }
    
                $saleItem->update([
                    'quantity' => $newQuantity,
                ]);
    
                $totalAmount += $product->unit_price * $newQuantity;
            }
    
            $sale->update([
                'total_amount' => $totalAmount,
            ]);
        }
    
        if (!empty($data['title'])) {
            $sale->update([
                'title' => $data['title'],
            ]);
        }
    
        return $sale->load('saleItems');
    }
    
}
