<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class ImageService extends AdminService {

    public function storeImage($image, $img_folder, $img) {
        if(isset($image) && !empty($image)) {
                $path = 'img/temp/'.$image;
                if(Storage::disk('local_public')->exists($path)) {
                    $extension = pathinfo($path, PATHINFO_EXTENSION);
                    $validextensions = array("jpeg","jpg","png");

                    if(in_array(strtolower($extension), $validextensions)){
                        $imageFile = Image::make(public_path($path));

                        $imageFile->fit($img['width'], $img['height']);
                        $imageFile->save();
                        $image = $image .'_'.Str::slug(Carbon::now()->toDayDateTimeString()).rand(11111, 99999) .'.' . $extension;
                        $new_path = 'img/'.$img_folder.'/'.$image;
                        Storage::disk('local_public')->move($path, $new_path);

                    }
                }
        }
        return isset($image) ? $image : null;
    }

    public function deleteImage($image, $img_folder) {
        $path = 'img/'.$img_folder.'/'.$image;
        if(Storage::disk('local_public')->exists($path)) {
            Storage::disk('local_public')->delete($path);
        }
        return;
    }

    public function updateImage($image, $model, $img_field, $img_folder, $img) {
        // Delete old image, if exists
        if($model[$img_field] != null ) {
            $this->deleteImage($model[$img_field], $img_folder);
        }
        // Add new image, if exists
        $img = $this->storeImage($image, $img_folder, $img);
        return $img;
    }


    // Croppa variations
    public function deleteImageVariations($img, $img_folder, $variations) {
        if($img != null && $img != '' && !empty($variations)) {
            foreach($variations as $variation) {
                $image = $this->prepareName($img, $variation);
                $this->deleteImage($image, $img_folder);
            }
        }
        return;
    }

    protected function prepareName($img, $variation) {
        $imgName = pathinfo($img, PATHINFO_FILENAME);
        $extension = pathinfo($img, PATHINFO_EXTENSION);
        return $imgName . '-' . $variation . '.' . $extension;
    }

}
