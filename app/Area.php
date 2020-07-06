<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $table='area_list';
    protected $primaryKey='area_id';
    protected $guarded=[];//黑名單，欄位不可賦值
}
