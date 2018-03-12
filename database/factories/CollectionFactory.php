<?php

use Faker\Generator as Faker;

use App\Models\Collection;

$factory->define(Collection::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->text,
    ];
});
