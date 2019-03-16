<?php

use Faker\Generator as Faker;

$factory->define(App\Question::class, function (Faker $faker) {
    $easy = 'easy';
    $hard = 'hard';
    //
    $answer_1 = $faker->text(10);
    $answer_2 = $faker->text(10);
    $answer_3 = $faker->text(10);
    $answer_4 = $faker->text(10);
    return [
        'level' => array_random(array ($easy,$hard)),
        'content' => $faker->text(100),
        'user_id'=>random_int(1,10),
        'answer_1' => $answer_1,
        'answer_2' => $answer_2,
        'answer_3' => $answer_3,
        'answer_4' => $answer_4,
        'correct_answer' => array_random(array($answer_1,$answer_2,$answer_3,$answer_4)),
        ];
});
