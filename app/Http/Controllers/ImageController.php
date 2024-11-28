<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Album;
use App\Models\Image;
use App\Helpers\Helper;

class ImageController extends Controller
{
    public function upload(Request $request){
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
        // Get the uploaded file
        $file = $request->file('image');
        $imageUrl = Helper::uploadImage($file,  $request->input('album_id') . '/' . $request->input('album_name'));
        
        $image = Image::create([
                'url' => $imageUrl,
                'album_id' => $request->input('album_id')
            ]);
        $image->save();
        
        return back();
    }
}
