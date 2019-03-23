<?php

use Faker\Generator as Faker;

$factory->define(\App\Chapters::class, function (Faker $faker) {
    return [
        //
        'name'=>$faker->text(15),
        'module_id'=>random_int(1,10),
    ];
});
