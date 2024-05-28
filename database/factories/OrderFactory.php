<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\ProductBatch;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class OrderFactory extends Factory
{
    protected $model = Order::class;


    public function definition(): array
    {
        return [
            'total_price' => 38
        ];
    }

}
