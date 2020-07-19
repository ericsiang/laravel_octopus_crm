<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    protected $table='channels';
    protected $guarded=[];//黑名單，欄位不可賦值
    
}
