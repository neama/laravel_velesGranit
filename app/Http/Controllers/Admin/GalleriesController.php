<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Helpers\ImageSaver;

class GalleriesController extends Controller
{
    private $imageSaver;
    //

    public function __construct(ImageSaver $imageSaver) {
        $this->imageSaver = $imageSaver;
    }

    public function index() {
        // корневые категории для возможности навигации

        $images = Gallery::paginate(25);
        return view('admin.gallery.index', compact('images'));
    }

    public function show(Request $request, $slug) {
        $image = Gallery::where('slug',$slug)->get();
        return view('admin.gallery.show', compact('image'));
    }

    public function edit(Request $request, $slug) {
        $image = Gallery::where('slug',$slug)->get();
        return view('admin.gallery.edit',compact('image'));
    }

    public function update(Request $request,  $slug) {

        $this->validate($request, [
            'name' => 'required|max:100',
            'description' => 'required',
        ]);


        $gallery = Gallery::getItems($slug);
        $data = $request->all();
        $img = $this->imageSaver->uploadGallery($request, $gallery['current'], 'product');
        $data['base_image'] = $img[0];
        $data['additional_image'] = $img[1];
        $gallery['current']->update($data);
        $images = Gallery::paginate(25);
        return view('admin.gallery.index', compact('images'));
        /*   return redirect()
               ->route('admin.page.show', ['page' => $page->id])
               ->with('success', 'Страница была успешно отредактирована');*/
    }

    public function destroy(Request $request, $slug){
        $image = Gallery::where('slug',$slug)->get();
        //$this->removeImages($image->base_image);
        $image[0]->delete();
    }

    public function create(Request $request){
        return view('admin.gallery.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $img = $this->imageSaver->uploadGallery($request, null, 'product');
        $data['base_image'] = $img[0];
        $data['additional_image'] = $img[1];
        Gallery::create($data);
        $images = Gallery::paginate(25);
        return view('admin.gallery.index', compact('images'));
    }
}
