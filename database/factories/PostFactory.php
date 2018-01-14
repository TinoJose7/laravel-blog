<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Post::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence($nbWords = 4, $variableNbWords = true),
        'description' => $faker->paragraph($nbSentences = 50, $variableNbSentences = true),
        'is_published' => $faker->randomElement(['0' ,'1'])
    ];
});
