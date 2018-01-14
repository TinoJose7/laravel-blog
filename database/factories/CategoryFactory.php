<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Category::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->word,
        'description' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
        'status' => 1
    ];
});
