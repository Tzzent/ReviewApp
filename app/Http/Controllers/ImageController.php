<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use App\Models\Image;
use App\Http\Controllers\Controller;
use Illuminate\Http\UploadedFile;
use Illuminate\Http\Request;
use CloudinaryLabs\CloudinaryLaravel\CloudinaryEngine;

class ImageController extends Controller
{

    public function upload(UploadedFile $image): CloudinaryEngine
    {
        $uploadedFile = Cloudinary::uploadFile(
            $image->getRealPath(),
            ['folder' => 'review_images']
        );

        return $uploadedFile;
    }
    public function store(String $name, UploadedFile $image)
    {

        $uploadedFile = $this->upload($image);

        $image = Image::create([
            'name' => $name,
            'public_id' => $uploadedFile->getPublicId(),
            'secure_url' => $uploadedFile->getSecurePath(),
        ]);

        return $image->id;
    }

    public function update(Request $request, String $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|string|max:40',
                'image' => 'required|image|max:2048',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'res' => false,
                'errors' => $validator->errors()
            ], 400);
        }

        $imageFile = $request->file('image');

        $image = Image::findOrFail($id);

        if ($image->public_id) {
            Cloudinary::destroy($image->public_id);
        }

        $uploadedFile = Cloudinary::upload(
            $imageFile->getRealPath(),
            [
                'public_id' => $image->public_id,
            ]
        );

        $image->secure_url = $uploadedFile['secure_url'];

        $image->save();

        return response()->json([
            'res' => true,
            'image_id' => $image->id
        ]);
    }

    public function destroy(String $id)
    {
        $image = Image::findOrFail($id);

        Cloudinary::destroy($image->public_id);

        $image->delete();

        return response()->json([
            'res' => true,
            'message' => 'The image was destroyed successfully!'
        ]);
    }
}
