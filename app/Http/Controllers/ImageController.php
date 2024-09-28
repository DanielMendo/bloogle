<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Laravel\Facades\Image;

class ImageController extends Controller
{
    public function store(Request $request) 
    {
        $image = $request->file('file');

        $nameImage = Str::uuid() . "." . $image->extension();

        $imageServer = Image::make($image);

        $imagePath = public_path('uploads') . '/' . $nameImage;
        $imageServer->save($imagePath);
        
        try {
            // Tu lógica de carga aquí
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
        return response()->json(['image' => $nameImage]);
    }
}
