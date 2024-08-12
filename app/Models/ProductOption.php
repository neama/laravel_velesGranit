<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOption extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'product_id',
        'option_name',
        'option_value',
        'prise'
    ];

    /**
     * Get the product that owns the option.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getProduct() {
        return Product::where(['id'=>$this->product_id])->get();
    }

    public function getCategory($category_id) {
        return Category::where(['id'=>$category_id])->get();
    }
}
