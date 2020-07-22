<?php

namespace App;

use App\PointLog;
use App\Events\MemberRegistered;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Member extends Authenticatable implements JWTSubject
{
    use softDeletes;

    protected $table='members';
    protected $primaryKey='mem_id';
    protected $guarded=[];//黑名單，欄位不可賦值
    protected $hidden = [
        'password','email_auth','fb_id','google_id' //'remember_token',
    ];

    public function pointLogs()
    {
        return $this->hasMany(PointLog::class,'mem_id','mem_id');
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }


    public function getJWTCustomClaims()
    {
        return [];
    }

   

}
