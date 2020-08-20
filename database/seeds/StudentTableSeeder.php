<?php

use Illuminate\Database\Seeder;

class StudentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Course::class, 40)->create()->each(function ($course) {
            $course->students()->save(factory(\App\Student::class)->make());
        });
    }
}
