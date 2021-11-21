<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;
    protected $table = "user";
    protected $fillable = [
        'id','email','password','name','phone','isActive','role','created_at','updated_at'
    ];
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }
    public function Activitys()
    {
        return $this->hasMany('App\Models\Activity','user_created','id');
    }
    public function ActivityDetails()
    {
        return $this->hasMany('App\Models\ActivityDetail','user_id','id');
    }
}
