<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Course;
use Faker\Generator as Faker;

$factory->define(App\Models\Course::class, function (Faker $faker) {
    return [

        'Name' =>$faker->text(50),
        'Code'  =>$faker->text(50),
        'Description' =>$faker->text(50),
    ];
});