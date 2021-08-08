<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
// HasApiTokens

class User extends Authenticatable
{
    use HasFactory, Notifiable,HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sendedMessages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }
    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }
    public function Messages()
    {
        return  $this->sendedMessages->merge($this->receivedMessages)->all();
    }
    public function discussion(int $withUserId)
    {
        // return $this->hasMany(Message::class, 'receiver_id')->where('sender_id', $withUserId)->get()->merge($this->hasMany(Message::class, 'sender_id')->where('receiver_id', $withUserId)->get())->sortBy('created_at')->all();
        // return Message::whereIn('receiver_id',[$withUserId,$this->id])->orWhereIn('sender_id',[$withUserId,$this->id])->orderBy('created_at','desc')->get();
        return Message::whereIn('receiver_id',[$withUserId,$this->id])->WhereIn('sender_id',[$withUserId,$this->id])->orderBy('created_at','desc')->get();


    }
}
