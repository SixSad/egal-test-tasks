<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Container\Container;
use Illuminate\Database\Seeder;
use Faker\Generator;
use Illuminate\Support\Str;

class UsersDebugSeeder extends Seeder
{

    protected $faker;

    public function __construct()
    {
        $this->faker = Container::getInstance()->make(Generator::class);
    }

    public function run()
    {
        /** @var Role $role */

        $user = User::factory()->create([
            'id' => Str::uuid(),
            'email' => 'user2@user.ru',
            'password' => 'user'
        ]);

        $admin = User::factory()->create([
            'id' => Str::uuid(),
            'email' => 'admin1@user.ru',
            'password' => 'admin',
        ]);

        $admin->roles()->attach('admin');

        $request = new \Egal\Core\Communication\Request(
            'core',
            'User',
            'create',
            [
                'attributes' => [
                    'id' => $user->id,
                    'phone' => "+" . $this->faker->phone,
                    'first_name' => $this->faker->firstName,
                    'last_name' => $this->faker->lastName
                ]]
        );

        $request->call();
        $response = $request->getResponse();
        var_dump($response);
    }

}
