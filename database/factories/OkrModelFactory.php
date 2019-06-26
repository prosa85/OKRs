<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Okr;
use Faker\Generator as Faker;

$factory->define(App\Okr::class, function (Faker $faker) {
    return [
        "OKRs_title" => $faker->sentence($nbWords = 6),
        "description" => $faker->paragraph($nbSentences = 2),
        "categories" => ["#Q2C", "#P&S", "#BO"],
        "contributors" => ["@BS", "@SW", "@QA", "@ARCH"],
        "impact_groups" => ["PAR", "CUS", "EMP"],
        "created_by" => $faker->numberBetween($min=1,$max=3),
        "target_date" => $faker->dateTimeThisYear('now + 5 months'),
        "status" => $faker->randomElement($array = ["Proposed", "Active", "Hold", "Completed"]),
    ];
});
