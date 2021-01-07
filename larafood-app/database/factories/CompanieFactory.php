<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Companie;
use Faker\Generator as Faker;

$factory->define(Companie::class, function (Faker $faker) {
    return [
        'cnpj'=> $faker->cnpj(false),
        'name' => $faker->company,
        'url' => $faker->url,
        'email' => $faker->unique()->safeEmail,
    ];
});
