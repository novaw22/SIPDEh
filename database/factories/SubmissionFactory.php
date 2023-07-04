<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Enums\SubmissionStatuses;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Submission>
 */
class SubmissionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $statuses = SubmissionStatuses::cases();
        $statusesCollection = collect(array_column($statuses, "value"));

        return [
            "name" => fake()->name(),
            "description" => fake()->words(10, true),
            "status" => $statusesCollection[fake()->numberBetween(0, count($statusesCollection) - 1)]
        ];
    }
}
