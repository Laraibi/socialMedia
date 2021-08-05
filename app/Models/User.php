<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable
{
    use HasFactory, Notifiable;

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
        // return array('Sended' => $this->sendedMessages, 'Received' => $this->receivedMessages);
        return  $this->sendedMessages->merge($this->receivedMessages)->all();
    }
    public function discussion(int $withUserId)
    {
        return $this->hasMany(Message::class, 'receiver_id')->where('sender_id', $withUserId)->get()->merge($this->hasMany(Message::class, 'sender_id')->where('receiver_id', $withUserId)->get())->all();
    }
}
