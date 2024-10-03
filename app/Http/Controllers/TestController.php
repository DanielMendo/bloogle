<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class TestController extends Controller
{
    public function testUpload() 
    {
        // Verifica si la carpeta "uploads" existe
        $uploadPath = public_path('uploads');
        if (!File::exists($uploadPath)) {
            // Si no existe, intenta crearla
            if (!File::makeDirectory($uploadPath, 0755, true)) {
                return response()->json(['error' => 'No se pudo crear la carpeta "uploads".'], 500);
            }
        }

        // Intenta crear un archivo de prueba
        $testFilePath = $uploadPath . '/test.txt';
        if (file_put_contents($testFilePath, 'Prueba de escritura en Railway')) {
            return response()->json(['success' => 'Archivo de prueba creado en la carpeta uploads.']);
        } else {
            return response()->json(['error' => 'No se pudo escribir en la carpeta "uploads".'], 500);
        }
    }
}
