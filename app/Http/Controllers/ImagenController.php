<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ImagenController extends Controller
{
    //
    public function store(Request $request)
    {
        //return "Desde imagen controller";
        //$input = $request->all();
        //return response()->json($input);

        $imagen = $request->file('file');

        $nombreImagen = Str::uuid() . "." . $imagen->extension();

        $imagenServidor = Image::make($imagen);
        $imagenServidor->fit(1000, 1000, null, 'center');

        $imagenPath  = public_path('uploads') . '/' . $nombreImagen;
        $imagenServidor->save($imagenPath);

        //return response()->json(['imagen'=> $imagen->extension()]);
        return response()->json(['imagen'=> $nombreImagen]);
    }
}
