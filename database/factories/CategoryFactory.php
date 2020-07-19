<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Faker\Provider\Base;


$factory->define(Category::class, function (Faker $faker) {
    $productName = $faker->name;
    return [
        'name' => $productName,
        'slug' => str::slug($productName),
        'image' => 'category_images/category_img.png',
        'created_by' => $faker->numberBetween($min = 1 , $max = 5),
        'updated_by' => $faker->numberBetween($min = 1 , $max = 5),

    ];
});
