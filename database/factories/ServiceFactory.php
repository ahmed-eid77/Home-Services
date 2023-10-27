<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->unique()->words($nb=4, $asText=true);
        $slug = Str::slug($name, '-');
        $imageName = 'service_' . $this->faker->unique()->numberBetween(1,20) . '.jpg';

        return [
            'name' => $name,
            'slug' => $slug,
            'tagline' => $this->faker->text(40),
            'service_category_id' => $this->faker->numberBetween(1, 12),
            'price' => $this->faker->numberBetween(100, 500),
            'image' => $imageName,
            'thumbnail' => $imageName,
            'description' => $this->faker->text(500),
            'inclusion' => $this->faker->text(20) . '|' . $this->faker->text(20) . '|' . $this->faker->text(20) . '|' . $this->faker->text(20) . '|' . $this->faker->text(20),
            'exclusion' => $this->faker->text(20) . '|' . $this->faker->text(20) . '|' . $this->faker->text(20) . '|' . $this->faker->text(20) . '|' . $this->faker->text(20),
        ];
    }
}
