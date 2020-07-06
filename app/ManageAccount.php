<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class ManageAccount extends Authenticatable
{   
    use softDeletes;

    protected $table='accounts';
    protected $primaryKey='acc_id';
    protected $guarded=[];//黑名單，欄位不可賦值
    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $dates=['delete_at'];
}
