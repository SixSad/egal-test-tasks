<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\User;
use Illuminate\Database\Seeder;

class CourseUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::query()->get();
        foreach ($users as $user) {
            $course = Course::query()->inRandomOrder()->first()->pluck('id');
            $user->courses()->attach($course);
        }
    }
}
