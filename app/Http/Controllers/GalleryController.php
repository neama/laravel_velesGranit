<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class GalleryController extends Controller
{
    public function getPreviewGallery(){
    /*    $directory = './images';
        $allFiles = array_diff(scandir($directory), ['.', '..']); // Получение всех файлов
        $thumbFiles = preg_grep('/-thumb\.jpg$/', $allFiles); // Фильтрация файлов
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 8; // Количество файлов на одной странице

// Пагинация
        $files = array_slice( $thumbFiles , ($currentPage - 1) * $perPage, $perPage);
        $paginator = new LengthAwarePaginator($files, count( $thumbFiles ), $perPage, $currentPage, [
            'path' => LengthAwarePaginator::resolveCurrentPath(),
        ]); */
        $perPage = 8; // Количество записей на одной странице
        $currentPage = LengthAwarePaginator::resolveCurrentPage();

// Получение всех записей из таблицы `galleries`
        $allRecords = Gallery::all();

// Пагинация
        $paginatedRecords = $allRecords->slice(($currentPage - 1) * $perPage, $perPage);
        $paginator = new LengthAwarePaginator($paginatedRecords, $allRecords->count(), $perPage, $currentPage, [
            'path' => LengthAwarePaginator::resolveCurrentPath(),
        ]);
        return view('gallery.index', ['files' => $paginator]);
    }

    public function getPreviewGalleryId(Request $request,$lang,$slug){
        $record = Gallery::getItems($slug);
        return view('gallery.show', ['record' => $record]);
    }

    public function Id(Request $request,$lang,$slug){

        $record = Gallery::getItems($slug);
        return view('gallery.show', ['record' => $record]);
    }
}
