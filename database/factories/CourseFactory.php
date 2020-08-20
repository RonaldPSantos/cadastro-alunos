<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Course;
use Faker\Generator as Faker;

$factory->define(Course::class, function (Faker $faker) {
    return [
        'code'=> $faker->randomNumber(4),
        'name'=> $faker->name,
    ];
});
