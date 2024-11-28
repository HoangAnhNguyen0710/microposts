<?php

namespace App\Helpers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Helper
{

    static function uploadImage($file, $folderPath)
    {
    // Validate if the file exists and is an image
        
        // Generate a unique file name
        $fileName = time() . '_' . $file->getClientOriginalName();
        
        // Store the file in the 'images' directory in your default disk
        $path = $file->storeAs($folderPath, $fileName, 's3'); // 'public' disk is used here
    
        
        // Store the URL in the session

    
        // Redirect back to the previous page
        return $path;
    }

   
  static function getImage($path)
  {
        $url = Storage::disk('s3')->temporaryUrl(
            $path, now()->addMinutes(500)
        );
        return $url;
  }
}
