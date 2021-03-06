<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Topic::class, function (Faker $faker) {
    $sentence = $faker->sentence();
    $updatedAt = $faker->dateTimeThisMonth();
    $createdAt = $faker->dateTimeThisMonth($updatedAt);
    return [
        'title' =>  $sentence,
        'body'  =>  $faker->text(),
        'created_at'    =>  $createdAt,
        'updated_at'    =>  $updatedAt,
        'excerpt'       =>  $sentence,
    ];
});
