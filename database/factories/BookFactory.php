<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Book;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Faker\Provider\en_US\Company;

$factory->define(Book::class, function (Faker $faker) {
    $title = $faker->catchPhrase;
    return [
        'title' => $title,
        'slug' => str::slug($title),
        'description' => $faker->realText($maxNbChars = 50, $indexSize = 2),
        'author' => $faker->name,
        'publisher' => $faker->company,
        'cover' => $faker->sentence($nbWords = 3, $variableNbWords = true),
        'price' => $faker->randomFloat($nbMaxDecimals = 100, $min = 5, $max = 60), // 48.8932
        'status' => $faker->randomElement(['DRAFT','PUBLISH']),
        'created_by' => $faker->numberBetween($min = 1, $max = 5),
    ];
});
