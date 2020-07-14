<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\member;
use Faker\Generator as Faker;

$factory->define(member::class, function (Faker $faker) {
    return [
        'card_num'=>$faker->unique()->,
        'cid'=>,
        'name'=>$faker->name,
        'email'=>$faker->unique()->safeEmail,
        'password'=>,
        'phone'=>,
        'sex'=>,
        'city_id'=>,
        'area_id'=>,
        'address'=>,
        'email_auth'=>2,
        'status'=>1
    ];
});
