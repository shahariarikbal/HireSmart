<?php

namespace App\Services;

class ImageService
{
    public function uploadImage($image, $path)
    {
        if ($image) {
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path($path), $imageName);
            return $path . '/' . $imageName;
        }
        return null;
    }

    public function updateImage($image, $path, $oldImage = null)
    {
        if ($image) {
            if ($oldImage && file_exists(public_path($oldImage))) {
                unlink(public_path($oldImage));
            }
            return $this->uploadImage($image, $path);
        }
        return $oldImage;
    }
}
