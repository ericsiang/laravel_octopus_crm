<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class City extends Model
{

    protected $table='city_list';
    protected $primaryKey='city_id';
    protected $guarded=[];//黑名單，欄位不可賦值

}
