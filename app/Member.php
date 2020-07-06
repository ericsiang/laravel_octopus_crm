<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Member extends Authenticatable
{
    use softDeletes;

    protected $table='members';
    protected $primaryKey='mem_id';
    protected $guarded=[];//黑名單，欄位不可賦值
    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $dates=['delete_at'];
}
