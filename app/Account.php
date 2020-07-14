<?php

namespace App;

use App\Events\AccountDeleted;
use App\Events\AccountDeleting;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Account extends Authenticatable
{   
    use softDeletes;

    protected $table='accounts';
    protected $primaryKey='acc_id';
    protected $guarded=[];//黑名單，欄位不可賦值
    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $dates=['delete_at'];

    
    //建立模型事件與自定義事件class
    protected $dispatchesEvents = [
        'deleting' => AccountDeleting::class,
        'deleted' => AccountDeleted::class
    ];
}
