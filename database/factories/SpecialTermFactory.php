<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Enums\SpecialTermTypes;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SpecialTerm>
 */
class SpecialTermFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $types = SpecialTermTypes::cases();
        $typesCollection = collect(array_column($types, "value"));
        return [
            "name" => fake()->words(3, true),
            "type" => $typesCollection[fake()->numberBetween(0, count($typesCollection) - 1)]
        ];
    }
}
