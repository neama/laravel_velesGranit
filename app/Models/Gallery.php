<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'base_image',
        'additional_image',
    ];
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

    public static function randImageFromDb(){
        return self::inRandomOrder()->take(4)->get();

    }

    public static function getItems(string $slug){
        $current = self::where('slug', $slug)->first();

        if (!$current) {
            return null; // Если запись не найдена
        }

        // Получаем предыдущую запись (меньший ID)
        $previous = self::where('id', '<', $current->id)
            ->orderBy('id', 'desc')
            ->first();

        // Получаем следующую запись (больший ID)
        $next = self::where('id', '>', $current->id)
            ->orderBy('id', 'asc')
            ->first();

        return [
            'previous' => $previous,
            'current' => $current,
            'next' => $next,
        ];
    }
    public function getGallery()
    {

    }
}
