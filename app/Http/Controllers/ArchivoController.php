<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Archivo;
use Illuminate\Support\Facades\Storage;
class ArchivoController extends Controller
{
    //


    public function subir(Request $request){
          
        $request->file('archivo')->store('public/victor');
        // $file = $request->file('archivo');

        // $guardar_storage = Storage::putFile('RendimientoController',$file);

        //crear el enlace simbolico
         // echo asset('storage/VICTOR.txt'); exit;

        return response()->json(['msg'=>'registro de archivo exitoso'],201);


    }

    public function download(){

    	// dd(storage_path());

       // return response()->download(storage_path("public/RendimientoController/VICTOR.txt"));
         // $pathtoFile = public_path().'\Lzu1cA4GU5fvtDDEyKmPjgxcOGXt7FH06tt1pIpW.txt';
         // return response()->download($pathtoFile);
    	 // return Storage::download(storage_path("app/RendimientoController/UkInXzV2ii1UwcXoVcrQWUracsPgEZAWDRzKzHo8.txt"),"VICTOR.txt");
    	return Storage::download(storage_path("app/public/Lzu1cA4GU5fvtDDEyKmPjgxcOGXt7FH06tt1pIpW.txt"));

    }
}
