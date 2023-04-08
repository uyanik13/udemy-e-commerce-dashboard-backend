<?php

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;


if(!function_exists('uploadImage')){
    function uploadImage(UploadedFile $file, string $path, string $imageName = null)
    {
        $extension = $file->getClientOriginalExtension();
        $imageName = $imageName?? uniqid();
        $fileName = $imageName . '.' . $extension;
        Storage::disk('public')->putFileAs('images/'. $path, $file, $fileName);
        $imageUrl = env('APP_URL') . '/images/' . $path . '/' . $fileName;
        return [
            'image_url' => $imageUrl,
            'image_type' => $extension
        ];
    }
}