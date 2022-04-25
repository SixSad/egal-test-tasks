<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Generator;
use Illuminate\Container\Container;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    protected $faker;

    public function __construct()
    {
        $this->faker = Container::getInstance()->make(Generator::class);
    }

    public function run()
    {
        $adminScheme = [
            'id' => Str::uuid(),
            'email' => 'admin2@user.ru',
            'password' => 'admin'
        ];

        if (!User::query()->where('email',$adminScheme['email'])->first()) {
            $admin = User::query()->create($adminScheme);
            $admin->roles()->attach('admin');
            $request = new \Egal\Core\Communication\Request(
                'core',
                'User',
                'create',
                [
                    'attributes' => [
                        'id' => $admin->id,
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
