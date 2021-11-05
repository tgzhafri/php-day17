<?php

namespace Database\Seeders;

use App\Models\EmployeeJob;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class EmployeeJobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //
        $faker = Faker::create();

        foreach (range(1, 30) as $index) {

            // this method will include datetime 
            $job = new EmployeeJob(); // make temperory row
            $job->title = $faker->jobTitle();  // create fake info
            $job->description = $faker->sentence(6);
            $job->min_salary = $faker->randomFloat(2, 1000,5000);
            $job->max_salary = $faker->randomFloat(2, 5000,10000);
            $job->save(); // save new info and automatically save created and updated date
        }
    }
}
