<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Image;

class Album extends Model
{
    use HasFactory;
    
    protected $fillable = ['name'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function images()
    {
        
        return $this->hasMany(Image::class)->get();
    }
    
    public function imageCount()
    {
        return $this->images()->count();
    }
}
