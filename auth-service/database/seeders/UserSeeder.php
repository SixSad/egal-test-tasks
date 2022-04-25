<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Generator;
use Illuminate\Container\Container;
use Illuminate\Database\Seeder;
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
            'email' => 'user2@user.ru',
            'password' => 'user'
        ];

        if (!User::query()->where('email',$userScheme['email'])->first()) {
            $user = User::query()->create($userScheme);

            $request = new \Egal\Core\Communication\Request(
                'core',
                'User',
                'create',
                [
                    'attributes' => [
                        'id' => $user->id,
                        'phone' => "+" . random_int(1, 99) . random_int(0, 999) . random_int(0, 999) . random_int(0, 99) . random_int(0, 99),
                        'first_name' => $this->faker->firstName,
                        'last_name' => $this->faker->lastName
                    ]]
            );

            $request->call();
            $response = $request->getResponse();
            var_dump($response);
        }
    }
}