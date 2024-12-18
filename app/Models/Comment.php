<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Comment extends Model
{
    use HasFactory;
    
    protected $fillable = ['content', 'micropost_id', 'user_id', 'parent_id'];
    
    public function get_comment_reply(){
        return $this->hasMany(Comment::class, 'parent_id')
        ->orderBy('created_at', 'desc')
        ->get();
    }
    
    public function reply_count(){
        return $this->get_comment_reply()->count();
    }
    
    public function get_parent_comment(){
        return $this->belongsTo(Comment::class);
    }
    
    public function user(){
        return $this->belongsTo(User::class);
    }
}
