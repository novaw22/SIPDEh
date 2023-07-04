<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Enums\UserStatuses;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
 */
class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = UserStatuses::cases();
        $statusCollection = collect(array_column($status, "value"));
        return [
            "fullname" => fake()->name(),
            "nik" => fake()->isbn13(),
            "age" => fake()->numberBetween(10, 70),
            "date_of_birth" => fake()->dateTime(),
            "place_of_birth" => fake()->state(),
            "address" => fake()->address(),
            "phone" => fake()->phoneNumber(),
            "status" => $status[fake()->numberBetween(0, count($status) - 1)]
        ];
    }
}
