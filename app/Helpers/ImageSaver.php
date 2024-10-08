<?php
namespace App\Helpers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;
use  Intervention\Image\Interfaces\EncoderInterface;

class ImageSaver {
    /**
     * Сохраняет изображение при создании или редактировании категории,
     * бренда или товара; создает два уменьшенных изображения.
     *
     * @param \Illuminate\Http\Request $request — объект HTTP-запроса
     * @param \App\Models\Item $item — модель категории, бренда или товара
     * @param string $dir — директория, куда будем сохранять изображение
     * @return string|null — имя файла изображения для сохранения в БД
     */
    public function upload($request, $item, $dir) {
        $name = $item->image ?? null;
        if ($item && $request->remove) { // если надо удалить изображение
            $this->remove($item, $dir);
            $name = null;
        }
        $source = $request->file('image');
        if ($source) { // если было загружено изображение
            // перед загрузкой нового изображения удаляем старое
            if ($item && $item->image) {
                $this->remove($item, $dir);
            }
            $ext = $source->extension();
            // сохраняем загруженное изображение без всяких изменений
            $path = $source->store('catalog/'.$dir.'/source', 'public');
            $path = Storage::disk('public')->path($path); // абсолютный путь
            $name = basename($path); // имя файла
            // создаем уменьшенное изображение 600x300px, качество 100%
          /*  $dst = 'catalog/'.$dir.'/image/';
            $this->resize($path, $dst, 600, 300, $ext);
            // создаем уменьшенное изображение 300x150px, качество 100%
            $dst = 'catalog/'.$dir.'/thumb/';
            $this->resize($path, $dst, 300, 150, $ext);*/
        }
        return $name;
    }

    public function uploadGallery($request, $item) {

        $source = $request->file('image');

        if ($source) { // если было загружено изображение
            // перед загрузкой нового изображения удаляем старое

                $this->removeGal($item);
            }

            $ext = $source->extension();
            // сохраняем загруженное изображение без всяких изменений
            $path = $source->store('gallery', 'public');
            $path = Storage::disk('public')->path($path); // абсолютный путь
            $name = basename($path); // имя файла
            $addFile = explode('.',$name);
            $name_t = $addFile[0].'-thumb.'.$addFile[1];
 // создаем уменьшенное изображение 600x300px, качество 100%
            //  $dst = 'catalog/'.$dir.'/image/';*/
              $dst = 'gallery/'.$name_t;
              $this->resize1($path, $dst, 300, 400, $ext);
              // создаем уменьшенное изображение 300x150px, качество 100%
              /*$dst = 'catalog/'.$dir.'/thumb/';
              $this->resize($path, $dst, 300, 150, $ext);*/

        return [$name,$name_t];
    }


    private function resize1($src, $dst, $width, $height, $ext) {
        // создаем уменьшенное изображение width x height, качество 100%
        /*$image = Image::read($src)
            ->heighten($height)
            ->resizeCanvas($width, $height, 'center', false, 'eeeeee')
            ->encode($ext, 100);
        // сохраняем это изображение под тем же именем, что исходное
*/
        $image = Image::read($src)
            ->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->toJpeg(100);

        // $image = Image::read($src)->resize($width, $height);
        $name = basename($src);
        Storage::disk('public')->put($dst, $image);
        unset($img);
    }
    /**
     * Создает уменьшенную копию изображения
     *
     * @param string $src — путь к исходному изображению
     * @param string $dst — куда сохранять уменьшенное
     * @param integer $width — ширина в пикселях
     * @param integer $height — высота в пикселях
     * @param string $ext — расширение уменьшенного
     */
    private function resize($src, $dst, $width, $height, $ext) {
        // создаем уменьшенное изображение width x height, качество 100%
        /*$image = Image::read($src)
            ->heighten($height)
            ->resizeCanvas($width, $height, 'center', false, 'eeeeee')
            ->encode($ext, 100);
        // сохраняем это изображение под тем же именем, что исходное
*/
        $image = Image::read($src)
            ->resize(null, $height, function ($constraint) {
                $constraint->aspectRatio();
            })->toJpeg(100);

       // $image = Image::read($src)->resize($width, $height);
        $name = basename($src);
        Storage::disk('public')->put($dst . $name, $image);
        unset($img);
    }

    /**
     * Удаляет изображение при удалении категории, бренда или товара
     *
     * @param \App\Models\Item $item — модель категории, бренда или товара
     * @param string $dir — директория, в которой находится изображение
     */
    public function remove($item, $dir) {
        $old = $item->image;
        if ($old) {
            Storage::disk('public')->delete('catalog/'.$dir.'/source/' . $old);
            Storage::disk('public')->delete('catalog/'.$dir.'/image/' . $old);
            Storage::disk('public')->delete('catalog/'.$dir.'/thumb/' . $old);
        }
    }


    public function removeGal($item) {

        $old_basic = $item?->base_image;
        $old_additional = $item?->additional_image;

        Storage::disk('public')->delete('gallery/'.$old_basic);
        Storage::disk('public')->delete('gallery/'.$old_additional);
    }
}
