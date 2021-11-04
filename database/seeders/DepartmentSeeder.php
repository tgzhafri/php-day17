<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = Faker::create();

        foreach (range(1, 15) as $index) {

            // this method will include datetime 
            $department = new Department(); // make temperory row
            $department->name = $faker->company;  // create fake info
            $department->save(); // save new info and automatically save created and updated date
        }
    }
}
