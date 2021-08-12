<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
class uploadController extends Controller
{
    //
    public function uploadImage(Request $request){
        $imageType= $request->hasFile('post_image') ?'post_image' : 'user_image';
        $img = $request->file($imageType);
        $fileName=$imageType."_".Auth::user()->id.'_'.time().'.'.$img->getClientOriginalExtension();
        $path=$img->storeAs('public/'.$imageType.'s',$fileName);
        return response()->json(['image_path'=>asset($path)]);
    }
}
