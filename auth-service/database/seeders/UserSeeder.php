<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Generator;
use Illuminate\Container\Container;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    protected $faker;

    public function __construct()
    {
        $this->faker = Container::getInstance()->make(Generator::class);
    }

    public function run()
    {
        $userScheme = [
            'id' => Str::uuid(),
            'email' => 'user@user.ru',
            'password' => Hash::make('user')
        ];

        if (User::query()->where('email', $userScheme['email'])->first()) {
            return;
        }

        $user = User::query()->create($userScheme);

        $request = new \Egal\Core\Communication\Request(
            'core',
            'User',
            'create',
            [
                'attributes' => [
                    'id' => $user->id,
                    'phone' => $this->faker->phoneNumber,
                    'first_name' => $this->faker->firstName,
                    'last_name' => $this->faker->lastName
                ]]
        );

        $request->send();
    }
}
