<?php

namespace Database\Factories;

use App\Models\OrderItemTopping;
use App\Models\Topping;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class OrderItemToppingFactory extends Factory
{
    protected $model = OrderItemTopping::class;

    const T_ID  = [1,2];


    public function definition(): array
    {
        return [
            'order_item_id' => 2,
            'topping_id' =>   Arr::random(self::T_ID)
        ];
    }

}
