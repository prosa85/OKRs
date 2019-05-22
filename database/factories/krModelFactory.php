<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\kr;
use Faker\Generator as Faker;

$factory->define(App\kr::class, function (Faker $faker) {
    return [
        "title" => $faker->sentence($nbWords = 8),
        "description" => $faker->paragraph($nbWords = 12),
        "OKR_id" => $faker->numberBetween($min=1,$max=10),
        "status" => $faker->randomElement($array = ["Proposed", "Active", "Hold", "Completed"]),
    ];
});
