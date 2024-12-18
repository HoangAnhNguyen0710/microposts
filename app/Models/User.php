<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Helpers\Helper;
use App\Models\Album;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    
    public function microposts()
    {
        return $this->hasMany(Micropost::class);
    }
    
    public function loadRelationshipCounts()
    {
        $this->loadCount('microposts');
    }
    
    public function micropostsCount()
    {
        return $this->microposts()->count();
    }
    
    public function followings()
    {
        return $this->belongsToMany(User::class, 'user_follow', 'user_id', 'follow_id')->withTimestamps();
    }
    
    /**
     * このユーザーをフォロー中のユーザー。（Userモデルとの関係を定義）
     */
    public function followers()
    {
        return $this->belongsToMany(User::class, 'user_follow', 'follow_id', 'user_id')->withTimestamps();
    }
    
    public function follow(int $userId)
    {
        $exist = $this->is_following($userId);
        $its_me = $this->id == $userId;
        
        if ($exist || $its_me) {
            return false;
        } else {
            $this->followings()->attach($userId);
            return true;
        }
    }
    
    /**
     * $userIdで指定されたユーザーをアンフォローする。
     * 
     * @param  int $usereId
     * @return bool
     */
    public function unfollow(int $userId)
    {
        $exist = $this->is_following($userId);
        $its_me = $this->id == $userId;
        
        if ($exist && !$its_me) {
            $this->followings()->detach($userId);
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * 指定された$userIdのユーザーをこのユーザーがフォロー中であるか調べる。フォロー中ならtrueを返す。
     * 
     * @param  int $userId
     * @return bool
     */
    public function is_following(int $userId)
    {
        return $this->followings()->where('follow_id', $userId)->exists();
    }
    
    public function followingCount()
    {
        return $this->followings()->count();
    }
    
    public function followersCount()
    {
        return $this->followers()->count();
    }
    
    public function favorites()
    {
        return $this->belongsToMany(Micropost::class, 'user_favorite')->withTimestamps();
    }
    
    // Check if a micropost is already favorited
    public function is_favoriting(int $micropostId)
    {
        return $this->favorites()->where('micropost_id', $micropostId)->exists();
    }
    
    // Add a micropost to favorites
    public function favorite(int $micropostId)
    {
        if ($this->is_favoriting($micropostId)) {
            return false;
        } else {
            $this->favorites()->attach($micropostId);
            return true;
        }
    }
    
    // Remove a micropost from favorites
    public function unfavorite(int $micropostId)
    {
        if ($this->is_favoriting($micropostId)) {
            $this->favorites()->detach($micropostId);
            return true;
        } else {
            return false;
        }
    }
    
    public function favoritesCount()
    {
        return $this->favorites()->count();
    }
    
    public function getAvatar()
    {
        if(!empty($this->avatar) && strlen($this->avatar) > 0)
            return Helper::getImage($this->avatar);
        return null;
    }
    
    public function albums()
    {
        return $this->hasMany(Album::class);
    }
    
    public function albumCount()
    {
        return $this->albums()->count();
    }
}
