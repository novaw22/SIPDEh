<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Enums\UserStatuses;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JenisDocumentUser>
 */
class JenisDocumentUserFactory extends Factory
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
            "user_status" => $status[fake()->numberBetween(0, count($status) - 1)]
        ];
    }
}
