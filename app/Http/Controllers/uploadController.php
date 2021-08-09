<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
class uploadController extends Controller
{
    //
    public function uploadImage(Request $request){
        $img = $request->file('user_image');
        $fileName="user_image_".Auth::user()->id.'_'.time().'.'.$img->getClientOriginalExtension();
        $path=$img->storeAs('public/user_images',$fileName);
        return response()->json(['image_path'=>asset($path)]);
    }
}
