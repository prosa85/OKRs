<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Okr;
use Faker\Generator as Faker;

$factory->define(App\Okr::class, function (Faker $faker) {
    return [
        "OKRs_title" => $faker->sentence($nbWords = 6),
        "description" => $faker->paragraph($nbSentences = 2),
        "created_by" => $faker->numberBetween($min=1,$max=3),
        "status" => $faker->randomElement($array = ["Proposed", "Active", "Hold", "Completed"]),
    ];
});