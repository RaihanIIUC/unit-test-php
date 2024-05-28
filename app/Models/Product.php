<?php

namespace App\Models;

use App\Services\CurrencyService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    use HasFactory;

    protected  $fillable = ['name','price'];

    public function getPriceEurAttribute()
    {
        return  (new CurrencyService())->convert($this->price ,'usd','eur');
    }

    public function batch():HasOne
    {
        return $this->hasOne(ProductBatch::class,'product_id','id');
    }
}
