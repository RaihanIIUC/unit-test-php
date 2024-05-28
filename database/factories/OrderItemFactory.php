<?php

namespace Database\Factories;

use App\Models\OrderItem;
use App\Models\ProductBatch;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class OrderItemFactory extends Factory
{
    protected $model = OrderItem::class;
    const PRODUCTS = [1,2,3];
    const PRODUCT_BATCH  = [1,null,null];
    const PRODUCT_PRICE  = [9,17,12];
    public function definition(): array
    {
        return [
            'order_id' => 1,
            'product_id' => Arr::random(self::PRODUCTS),
    'product_batch_id' => Arr::random(self::PRODUCT_BATCH),
            'price' => Arr::random(self::PRODUCT_PRICE)
        ];
    }

}
