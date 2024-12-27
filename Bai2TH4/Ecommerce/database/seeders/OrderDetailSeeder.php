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

    foreach ($listOrder as $orderId) {
        // Ensure each order gets at least one order detail
        OrderDetail::create([
            'order_id' => $orderId,
            'product_id' => $faker->randomElement($listProduct),
            'quantity' => $faker->randomDigitNotZero(),
        ]);

        // Add additional random order details for some orders
        $additionalOrderDetailsCount = rand(0, 3); // 0 to 3 additional order details
        for ($i = 0; $i < $additionalOrderDetailsCount; $i++) {
            OrderDetail::create([
                'order_id' => $orderId,
                'product_id' => $faker->randomElement($listProduct),
                'quantity' => $faker->randomDigitNotZero(),
            ]);
        }
    }
}

}
