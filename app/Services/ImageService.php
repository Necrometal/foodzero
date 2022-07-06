<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ImageService {
    // using base64 image and encode to webp before storing in server
    /**
     * @param base64 or $request->file 
     * @param diskname on filesystem
     */
    public function uploadImage($image, $path){
        try {
            $name = bin2hex(random_bytes(5)) . '.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
            
            $img = Image::make($image)->encode('webp');

            Storage::disk($path)->put($name, $img, 'public');

            return $name;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    /**
     * @param imagename ('image.png')
     * @param diskname on filesystem
     */
    public function deleteImge($image, $path){
        if(Storage::disk($path)->exists($image)) Storage::disk($path)->delete($image);
    }
}