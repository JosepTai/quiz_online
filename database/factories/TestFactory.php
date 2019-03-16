<?php

use Faker\Generator as Faker;

$factory->define(App\Test::class, function (Faker $faker) {
    return [
        'name' => $faker->text(20),
        'user_id'=> random_int(1,10),
    ];
});
