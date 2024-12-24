<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Order;
class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $listCustomerId = Customer::all()->pluck('id')->toArray();

        // Create 100 borrow records
        for ($i = 0; $i < 100; $i++) {
            $status = $faker->boolean();
            $orderDate = $faker->dateTimeBetween('-3 week', '-1 week');
            Order::create([
                'customer_id' => $faker->randomElement($listCustomerId),
                'status' => $status,
                'order_date'=>$orderDate
            ]);
        }

        
    }
}
