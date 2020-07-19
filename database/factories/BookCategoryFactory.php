<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Book;
use App\BookCategory;
use App\Category;
use Faker\Generator as Faker;


$factory->define(App\BookCategory::class, function (Faker $faker) {
    return [
        'book_id' => function(){
            return Book::all()->random();
        },
        'category_id' => function(){
            return Category::all()->random();
        }
    ];
});
