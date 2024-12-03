<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Comment extends Model
{
    use HasFactory;
    
    protected $fillable = ['content', 'micropost_id', 'user_id'];
    
    public function get_comment_reply(){
        return $this->hasMany(Comment::class);
    }
    
    public function get_parent_comment(){
        return $this->belongsTo(Comment::class);
    }
    
    public function user(){
        return $this->belongsTo(User::class);
    }
}
