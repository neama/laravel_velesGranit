<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ImageSaver;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryCatalogRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;


class CategoryController extends Controller
{
    private $imageSaver;

    public function __construct(ImageSaver $imageSaver) {
        $this->imageSaver = $imageSaver;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $items = Category::defaultRoots();
        return view('admin.category.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // для возможности выбора родителя
        $items = Category::defaultRoots();
        return view('admin.category.create', compact('items'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(CategoryCatalogRequest $request)
    {
        $this->validate($request, [
            'parent_id' => 'integer',
            'name' => 'required|max:100',
            'slug' => 'required|max:100|unique:categories,slug|alpha_dash',
            'image' => 'mimes:jpeg,jpg,png|max:5000'
        ]);

        $saveData = $request->all();

        if($saveData['parent_id']==0 ){
           // $saveData['lang'] = Session::get('applocale');
           // $saveData['host'] = Session::get('hostname');
        }else{
            $parentCategory = Category::find($saveData['parent_id']);
            $saveData['lang'] = $parentCategory->lang;
            $saveData['host'] = $parentCategory->host;}

    $saveData['image'] = $this->imageSaver->upload($request, null, 'category');

        // проверка пройдена, сохраняем категорию
        $category = Category::create($saveData);
        return redirect()
            ->route('admin.category.show', ['category' => $category->id])
            ->with('success', 'Новая категория успешно создана');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('admin.category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        // все категории для возможности выбора родителя
        $items = Category::all();
        return view('admin.category.edit',compact('category', 'items'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryCatalogRequest $request, Category $category)
    {
        // проверяем данные формы редактирования категории
        $id = $category->id;
        $this->validate($request, [
            'parent_id' => 'integer',
            'name' => 'required|max:100',
            /*
             * Проверка на уникальность slug, исключая эту категорию по идентифкатору:
             * 1. categories — таблица базы данных, где проверяется уникальность
             * 2. slug — имя колонки, уникальность значения которой проверяется
             * 3. значение, по которому из проверки исключается запись таблицы БД
             * 4. поле, по которому из проверки исключается запись таблицы БД
             * Для проверки будет использован такой SQL-запрос к базе данныхЖ
             * SELECT COUNT(*) FROM `categories` WHERE `slug` = '...' AND `id` <> 17
             */
            'slug' => 'required|max:100|unique:categories,slug,'.$id.',id|alpha_dash',
            'image' => 'mimes:jpeg,jpg,png|max:5000'
        ]);
        // проверка пройдена, обновляем категорию
        $data = $request->all();

        $data['image'] = $this->imageSaver->upload($request, null, 'category');
        $category->update($data);
        return redirect()
            ->route('admin.category.show', ['category' => $category->id])
            ->with('success', 'Категория была успешно исправлена');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category) {
        if ($category->children->count()) {
            $errors[] = 'Нельзя удалить категорию с дочерними категориями';
        }

        if ($category->products->count()) {
            $errors[] = 'Нельзя удалить категорию, которая содержит товары';
        }
        if (!empty($errors)) {
            return back()->withErrors($errors);
        }
        $category->delete();
        return redirect()
            ->route('admin.category.index')
            ->with('success', 'Категория каталога успешно удалена');
    }
}
