<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

class Page extends Model {

    protected $fillable = [
        'name',
        'slug',
        'content',
        'parent_id',
        'host',
        'lang'
    ];


    public static function getPageForHost($host){
        return self::where('host',$host)->get();
    }
    public static function roots() {

        return self::where('parent_id', 0)
            ->where('host',Session::get('hostname'))
            ->where('lang', App::getLocale() )->get();
    }
    /**
     * Если мы в панели управления — страница будет получена из
     * БД по id, если в публичной части сайта — то по slug
     *
     * @param  mixed  $value
     * @param  string|null  $field
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function resolveRouteBinding($value, $field = null) {
        $current = Route::currentRouteName();
        if ('page.show' == $current) {
            // мы в публичной части сайта
            return $this->whereSlug($value)->firstOrFail();
        }
        // мы в панели управления
        return $this->findOrFail($value);
    }

    /**
     * Связь «один ко многим» таблицы `pages` с таблицей `pages`
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children() {
        return $this->hasMany(Page::class, 'parent_id');
    }

    /**
     * Связь «страница принадлежит» таблицы `pages` с таблицей `pages`
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent() {
        return $this->belongsTo(Page::class);
    }
}
