<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\SubscrubeUser;
class User extends Authenticatable
{
    use Notifiable;

     public function blogger()
    {
        return $this->belongsToMany('App\Models\User','subscrube_users','blogger_id','susbcriber_id');
    }

     public function suber()
    {
        return $this->belongsToMany('App\Models\User','subscrube_users','susbcriber_id','blogger_id');
    }

     public function getBlogger()
    {
        return $this->blogger()->get();
    }

     public function getSuber()
    {
        return $this->suber()->get();
    }



    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'login', 'password','avatar','id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'login_verified_at' => 'datetime',
    ];
}
