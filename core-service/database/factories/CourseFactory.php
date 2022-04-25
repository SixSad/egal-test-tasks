<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{

    protected $model = Course::class;

    public function definition(): array
    {
        $date = $this->faker->dateTimeBetween('now', '+7 days');

        return [
            'title' => $this->faker->unique()->word,
            'student_capacity' => $this->faker->numberBetween(5, 99),
            'start_date' => $date,
            'end_date' => $this->faker->dateTimeBetween($date, '+14 days'),
            'has_certificate' => $this->faker->boolean,
        ];
    }

}
