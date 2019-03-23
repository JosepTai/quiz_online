<?php

use Faker\Generator as Faker;

$factory->define(\App\Parts::class, function (Faker $faker) {
    return [
        //
        'name'=>$faker->text(15),
        'chapter_id'=>random_int(1,20),
    ];
});
