<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Topping;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class ToppingFactory extends Factory
{
    protected $model = Topping::class;

    const T_NAMES  = ['cheese','Mushroom'];


    public function definition(): array
    {
        return [
            'name' => Arr::random(self::T_NAMES),
            'price' =>   1
        ];
    }

}
