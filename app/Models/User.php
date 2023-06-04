<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Jenssegers\Mongodb\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Jenssegers\Mongodb\Eloquent\HybridRelations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable, HasFactory;


    protected $collection = 'users';


    protected $guarded = [];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }


}
