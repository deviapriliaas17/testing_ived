<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class MediaController extends Controller
{
    public function saveImage($file) {
        if($file != null){
            $extension = $file->getClientOriginalExtension();
            $name = "image-".date("YmdHis").".".$extension;
            $file->storeAs('images',$name, 'public_folder');
            return $name;
        }
    }
}
