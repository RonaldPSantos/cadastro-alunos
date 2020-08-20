<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Student;
use Faker\Generator as Faker;

$factory->define(Student::class, function (Faker $faker) {
    return [
        'code'=> $faker->randomNumber(4),
        'name'=> $faker->name,
        'status'=> $faker->boolean(true),

    ];
});
