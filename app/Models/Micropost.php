<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Comment;

class Micropost extends Model
{
    use HasFactory;
    
    protected $fillable = ['content'];

    /**
     * この投稿を所有するユーザー。（ Userモデルとの関係を定義）
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function comments()
    {
        return $this->hasMany(Comment::class)
        ->whereNull('parent_id')
        ->orderBy('created_at', 'desc')->get();
    }
    
    public function commentCount()
    {
        return $this->hasMany(Comment::class)
        ->orderBy('created_at', 'desc')->get()->count();
    }
}
