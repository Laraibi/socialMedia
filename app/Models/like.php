<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;
use App\Models\User;
class like extends Model
{
    use HasFactory;
    public function Post(){
        return $this->belongsTo(Post::class);
    }
    public function User(){
        return $this->belongsTo(User::class);
    }
}
