<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Member;
use Faker\Generator as Faker;

$factory->define(Member::class, function (Faker $faker) {
    return [
        'card_num'=>$faker->unique()->numberBetween($min = 1, $max = 99999999999),
        'cid'=>mt_rand(1,2),
        'name'=>$faker->name,
        'email'=>$faker->unique()->safeEmail,
        'password'=>'$2y$10$7Au.Y5SSwDxHFDDhuxmP..L9W918Iht/GqXJ/D.Stpm.9MTn/kj7K',//password
        'phone'=>'0911111'.$faker->numberBetween($min = 100, $max = 999),
        'sex'=>mt_rand(1,2),
        'city_id'=>1,
        'area_id'=>mt_rand(1,10),
        'address'=>$faker->address,
        'email_auth'=>mt_rand(1,2),
        'status'=>1
    ];
});
