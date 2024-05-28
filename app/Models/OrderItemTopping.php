<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItemTopping extends Model
{
    use HasFactory;

    public function topping(): BelongsTo
    {
        return $this->belongsTo(Topping::class,'topping_id','id');
    }
}
