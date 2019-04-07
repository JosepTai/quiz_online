<?php

use Faker\Generator as Faker;

$factory->define(\App\Classes::class, function (Faker $faker) {
    return [
        //
        'name'=>$faker->text(15),
        'user_id'=>random_int(1,10),
        'code'=>Str::random(5),
    ];
});
