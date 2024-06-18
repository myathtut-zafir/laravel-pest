<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class CourseFactory extends Factory
{
    protected $model = Course::class;

    public function definition(): array
    {
        return [
            'slug' => $this->faker->slug(),
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
        ];
    }

    public function release(?Carbon $releasedAt = null): self
    {
        return $this->state(
            fn(array $attributes) => ['release_at' => $releasedAt ?? now()]
        );
    }
}
