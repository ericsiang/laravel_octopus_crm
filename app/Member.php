<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;

class Member extends Authenticatable implements JWTSubject
{
    use softDeletes;

    protected $table='members';
    protected $primaryKey='mem_id';
    protected $guarded=[];//黑名單，欄位不可賦值
    protected $hidden = [
        'password', //'remember_token',
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
