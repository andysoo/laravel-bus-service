<?php

use Faker\Generator as Faker;

$factory->define(App\Item::class, function (Faker $faker) {
    $Bus_ids = App\Bus::pluck('id')->toArray();

    return [
        'bus_id'     => $faker->randomElement($Bus_ids),
        'body'       => $faker->catchPhrase(),
        'data-price' => $faker->numberBetween(100, 2000),
        'time-price' => $faker->numberBetween(10, 200),
        'mend_at'    => $faker->dateTimeBetween('-1 years', 'now', 'PRC'),
    ];
});
