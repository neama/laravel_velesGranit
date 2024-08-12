<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class OrderItem extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'product_id',
        'name',
        'option',
        'price',
        'quantity',
        'cost',
    ];

    use HasFactory;
    /**
     * Связь «один ко многим» таблицы `orders` с таблицей `order_items`
     */
    public function items() {
        return $this->hasMany(OrderItem::class);
    }
    /**
     * Связь «элемент принадлежит» таблицы `order_items` с таблицей `products`
     */
    public function product() {
        return $this->belongsTo(Product::class);
    }
}
