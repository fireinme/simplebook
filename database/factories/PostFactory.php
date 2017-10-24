<?php

use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    return [
        'content'=>$faker->paragraph(6),
        'title'=>$faker->sentence(6),
    ];
});
