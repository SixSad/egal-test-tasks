<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{

    protected $model = User::class;

    public function definition(): array
    {
        return [
            'id' => Str::uuid(),
            'email' => $this->faker->email,
            'password' => Hash::make(Str::random(10)),
//            'phone' => "+" . random_int(1, 99) . random_int(0, 999) . random_int(0, 999) . random_int(0, 99) . random_int(0, 99),
//            'last_name' => $this->faker->firstName,
//            'first_name' => $this->faker->lastName
        ];
    }

}
