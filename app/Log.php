<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $table='logs';
    protected $guarded=[];//黑名單，欄位不可賦值
}
