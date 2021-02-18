<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Company;
use Faker\Generator as Faker;

$factory->define(Company::class, function (Faker $faker) {
    return [
        'cnpj'=> $faker->cnpj(false),
        'name' => $faker->company,
        'url' => $faker->url,
        'email' => $faker->unique()->safeEmail,
    ];
});
