<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class GalleryController extends Controller
{
    public function getPreviewGallery(){
        $directory = './images';
        $allFiles = array_diff(scandir($directory), ['.', '..']); // Получение всех файлов
        $thumbFiles = preg_grep('/-thumb\.jpg$/', $allFiles); // Фильтрация файлов
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 8; // Количество файлов на одной странице

// Пагинация
        $files = array_slice( $thumbFiles , ($currentPage - 1) * $perPage, $perPage);
        $paginator = new LengthAwarePaginator($files, count( $thumbFiles ), $perPage, $currentPage, [
            'path' => LengthAwarePaginator::resolveCurrentPath(),
        ]);
        return view('gallery.index', ['files' => $paginator]);
    }
}
