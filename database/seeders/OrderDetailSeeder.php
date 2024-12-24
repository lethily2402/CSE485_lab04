<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderDetail;
use Faker\Factory as Faker;

class OrderDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $listOrder = Order::pluck('id')->toArray();
        $listProduct = Product::pluck('id')->toArray();
        for ($i = 0; $i < 100; $i++) {
            OrderDetail::create([
                'order_id' => $faker->randomElement($listOrder),
                'product_id' => $faker->randomElement($listProduct),
                'quantity' => $faker->randomDigitNotZero(),
            ]);
        }
    }
}
