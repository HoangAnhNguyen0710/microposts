<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Album;
use App\Helpers\Helper;

class Image extends Model
{
    use HasFactory;
    
    protected $fillable = ['url', 'album_id'];
    
    public function Album(){
         return $this->belongsTo(Album::class);
    }
    
    public function getImageUrl()
    {
        return Helper::getImage($this->url);
    }
}
