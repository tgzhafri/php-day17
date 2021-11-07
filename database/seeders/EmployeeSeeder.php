<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class EmployeeSeeder extends Seeder
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

        foreach (range(1, 100) as $index) {

            // this method will include datetime 
            $employee = new Employee(); // make temperory row
            $employee->user_id = $faker->numberBetween($int1 = 2, $int2 = 101);  // create fake info
            $employee->department_id = $faker->numberBetween($int1 = 1, $int2 = 15);  // create fake info
            $employee->job_id = $faker->numberBetween($int1 = 1, $int2 = 30);  // create fake info
            $employee->first_name = $faker->firstName();  // create fake info
            $employee->last_name = $faker->lastName();
            $employee->email = $faker->email();
            $employee->phone = $faker->phoneNumber();
            $employee->salary = $faker->randomFloat(2, 1000,10000);
            $employee->save(); // save new info and automatically save created and updated demployee
        }
    }
}
