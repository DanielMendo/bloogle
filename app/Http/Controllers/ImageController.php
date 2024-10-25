<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function store(Request $request) 
    {
        $image = $request->file('file');

        $nameImage = Str::uuid() . "." . $image->extension();

        $imageServer = Image::read($image);

        $imagePath = public_path('uploads') . '/' . $nameImage;
        $imageServer->save($imagePath);
        
        return response()->json(['image' => $nameImage]);
    }
}
