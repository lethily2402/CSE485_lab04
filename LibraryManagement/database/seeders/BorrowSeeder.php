<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Borrow;
use App\Models\Book;
use App\Models\Reader;
class BorrowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $listBookId = Book::all()->pluck('id')->toArray();
        $listReaderId = Reader::all()->pluck('id')->toArray();

        // Create 100 borrow records
        for ($i = 0; $i < 100; $i++) {
            Borrow::create([
                'book_id' => $faker->randomElement($listBookId),
                'reader_id' => $faker->randomElement($listReaderId),
                'borrow_date'=>$faker->dateTime(),
                'status'=>$faker->boolean()
            ]);
        }
    }
}