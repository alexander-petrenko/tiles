<?php

namespace App\Helpers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ImageSaver {
    
    public function upload($request, $item, $dir)
    {
        $image = $request->file('image');

        if ($image) {

            if ($item && $item->url) {
                $this->remove($item, $dir);
            }

            $extension = $image->extension();

            $source = $image->store('images/' . $dir . '/source', 'public');
            $name = basename($source);

            $dir_large = 'images/' . $dir . '/large/';
            $dir_small = 'images/' . $dir . '/small/';

            $this->resize($source, $dir_large, 600, 300, $extension);
            $this->resize($source, $dir_small, 300, 150, $extension);
        }

        return $name ?? NULL;
    }


    private function resize($source, $dir, $width, $height, $extension)
    {
        $file = file_get_contents(storage_path('app/public/' . $source));
        $image = Image::make($file)
                    ->heighten($height)
                    ->resizeCanvas($width, $height, 'center', false, '#ffffff')
                    ->encode($extension, 100);

        $name = basename($source);

        Storage::disk('public')->put($dir . $name, $image);
        $image->destroy();
    }


    public function remove($item, $dir)
    {
        $name = $item->url;

        if ($name) {
            if (is_file(storage_path('app/public/images/' . $dir . '/source/' . $name))) {
                Storage::disk('public')->delete('images/' . $dir . '/source/' . $name);
            }
            if (is_file(storage_path('app/public/images/' . $dir . '/large/' . $name))) {
                Storage::disk('public')->delete('images/' . $dir . '/large/' . $name);
            }
            if (is_file(storage_path('app/public/images/' . $dir . '/small/' . $name))) {
                Storage::disk('public')->delete('images/' . $dir . '/small/' . $name);
            }
        }
    }
}