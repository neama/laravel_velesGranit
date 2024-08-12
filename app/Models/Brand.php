<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'content',
        'image',
    ];

    use HasFactory;
    /**
     * Возвращает список товаров выбранного бренда
     */
    public function getProducts($hostname) {
        return Product::where('brand_id', $this->id)
            ->where('host',$hostname)
            ->get();
    }

    public function products() {
        return $this->hasMany(Product::class);
    }

    /**
     * Возвращает список популярных брендов каталога товаров.
     * Следовало бы отобрать бренды, товары которых продаются
     * чаще всего. Но поскольку таких данных у нас еще нет,
     * просто получаем 5 брендов с наибольшим кол-вом товаров
     */
    public static function popular() {
        return self::withCount('products')->orderByDesc('products_count')->limit(5)->get();
    }
}
