<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Task;
use Faker\Generator as Faker;

$factory->define(Task::class, function (Faker $faker) {

        return [
            "title" => $faker->sentence($nbWords = 6),
            "description" => $faker->paragraph($nbSentences = 2),
            "kr_id" => $faker->numberBetween($min=1,$max=20),
            "user_id" => $faker->numberBetween($min=2,$max=4),
            "status" => $faker->randomElement($array = ["Proposed", "Active", "Hold", "Completed"]),
        ];

});
