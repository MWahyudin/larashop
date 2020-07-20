<?php

use Illuminate\Database\Seeder;

class BookCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $books = factory(App\Book::class, 10)->create()->each(function ($book) {
            $book->categories()->save(factory(App\Category::class)->make());
        });
    }
}
