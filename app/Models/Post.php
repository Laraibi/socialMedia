<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\like;
use App\Models\User;
use App\Models\comment;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    use HasFactory;
    protected $fillable=['content'];
    public function User(){
        return $this->belongsTo(User::class);
    }
    public function comments(){
        return $this->hasMany(comment::class);
    }
    public function Likes(){
        return $this->hasMany(like::class);
    }
    public function isLiked(){
        $likesUsersId=$this->Likes->pluck('user_id');
        return in_array(Auth::id(),$likesUsersId->all());
    }
}
