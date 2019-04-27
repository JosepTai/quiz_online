<?php

use Faker\Generator as Faker;

$factory->define(\App\Modules::class, function (Faker $faker) {
    return [
        //
        'name'=> $faker->text(15),
        'user_id'=>1,
    ];
});
