<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class Category extends Model
{
    const monuments_ru = 18;
    const monuments_ro = 41;

    use HasFactory;

    protected $fillable = [
        'parent_id',
        'name',
        'slug',
        'content',
        'image',
        'lang',
        'host',
        'keywords'
    ];

    /**
     * Связь «один ко многим» таблицы `categories` с таблицей `products`
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products() {
        return $this->hasMany(Product::class);
    }

    /**
     * Возвращает список товаров выбранной категории
     */
    public function getProducts() {
       return Product::where('category_id', $this->id);
    }

    public function getProductsForCategoryes(){
        $childrenIds = [];
        $childrens = $this->children()->get();
        foreach ($childrens as $children ) $childrenIds[] = $children->id;
        return Product::whereIn('category_id', $childrenIds);
    }
    /**
     * Связь «один ко многим» таблицы `categories` с таблицей `categories`
     */
    public static function roots() {
        return self::where('parent_id', 0)
            ->where('host',Session::get('hostname'))
            ->where('lang', App::getLocale())->get();
    }

    public static function monuments()
    {
        $parent_id = 1;
        if(App::getLocale()=='ru'){
            $parent_id = self::monuments_ru;
        }else{
            $parent_id = self::monuments_ro;
        }

        return self::where('parent_id', $parent_id)->where('host',Session::get('hostname'))
            ->get();
    }

    public static function defaultRoots(){
        return self::where('parent_id', 0)
            ->get();

    }
    public function children() {
        return $this->hasMany(Category::class, 'parent_id');
    }

    /**
     * Связь «один ко многим» таблицы `categories` с таблицей `categories`, но
     * позволяет получить не только дочерние категории, но и дочерние-дочерние
     */
    public function descendants() {
        return $this->hasMany(Category::class, 'parent_id')->with('descendants');
    }

    /**
     * Возвращает список всех категорий каталога в виде дерева
     */
    public static function hierarchy() {
        return self::where('parent_id', 0)->with('descendants')->get();
    }

    public static function getCategoryForHost($host)
    {
        return self::where('host',$host)
            ->get();
    }

}
