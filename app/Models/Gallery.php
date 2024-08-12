<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

class Gallery extends Model {

    protected $fillable = [
        'name',
        'slug',
        'content',
        'parent_id',
        'host',
        'lang'
    ];

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
        return $this->hasMany(Gallery::class, 'parent_id');
    }

    /**
     * Связь «страница принадлежит» таблицы `pages` с таблицей `pages`
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent() {
        return $this->belongsTo(Gallery::class);
    }

    public static function randImage()
    {
        $directory = './images';
        $allFiles = array_diff(scandir($directory), ['.', '..']); // Получение всех файлов

        // Фильтрация файлов по расширению (например, все -thumb.jpg файлы)
        $thumbFiles = preg_grep('/-thumb\.jpg$/', $allFiles);

        // Проверяем, достаточно ли файлов для выбора
        $numFiles = count($thumbFiles);
        if ($numFiles < 4) {
            // Если файлов меньше 4, возвращаем все файлы
            $selectedFiles = $thumbFiles;
        } else {
            // Выбираем 4 случайных файла
            $randomKeys = array_rand($thumbFiles, 4);
            $selectedFiles = array_intersect_key($thumbFiles, array_flip($randomKeys));
        }

        // Префикс пути для файлов
        $filePathPrefix = '/images/';

        // Создаем массив с полными путями для выбранных файлов
        $filesWithPaths = array_map(function($file) use ($filePathPrefix) {
            return $filePathPrefix . $file;
        }, $selectedFiles);

        return $filesWithPaths;
    }
}
