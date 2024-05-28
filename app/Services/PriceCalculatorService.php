<?php
namespace App\Services;


use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Topping;

class PriceCalculatorService
{
    public function calculatePrice($id): float
    {
        $order = Order::where('id',$id)->with('items.product','items.toppings.topping')->first();

        return $order->items
            ->reduce(function (float $sum, OrderItem $item) {
                \Log::info($item->product->price_type);

                switch ($item->product->price_type) {
                    case 'standard':
                        return $item->product->price;

                    case 'has_batches':
                        return  $item->product->price +
                            $item->product->batch->price;

                    case 'has_toppings':
                        $toppingsSum = $item->toppings
                            ->reduce(function (float $sum, Topping $topping) {
                                return $sum + $topping->price;
                            }, 0);

                        return $item->product->price + $toppingsSum;

                    default:
                        return $sum; // In case there's an unknown product type
                }
            }, 0.0);
    }

}
