<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{

    protected $model = User::class;

    public function definition(): array
    {
        return [
            'email' => $this->faker->email,
            'password' => $this->faker->password,
            'phone' => "+".random_int(1,99).random_int(0,999).random_int(0,999).random_int(0,99).random_int(0,99),
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
        ];
    }

}
