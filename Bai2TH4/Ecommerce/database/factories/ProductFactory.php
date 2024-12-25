<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word, // Tạo tên sản phẩm ngẫu nhiên
            'description' => $this->faker->sentence, // Tạo mô tả ngẫu nhiên
            'price' => $this->faker->randomFloat(2, 1, 1000), // Giá sản phẩm, từ 1 đến 1000
            'quantity' => $this->faker->numberBetween(1, 100), // Số lượng sản phẩm, từ 1 đến 100
        ];
    }
}
