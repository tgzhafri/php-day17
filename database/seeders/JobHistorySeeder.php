<?php

namespace Database\Seeders;

use App\Models\JobHistory;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class JobHistorySeeder extends Seeder
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
            $jobHistory = new JobHistory(); // make temperory row
            $jobHistory->employee_id = $faker->numberBetween($int1 = 2, $int2 = 101);  // create fake info
            $jobHistory->department_id = $faker->numberBetween($int1 = 1, $int2 = 15);  // create fake info
            $jobHistory->job_id = $faker->numberBetween($int1 = 1, $int2 = 30);  // create fake info
            $jobHistory->start_date = $faker->dateTime($max = 'now', $timezone = 'Asia/Kuala_Lumpur');
            $jobHistory->end_date = $faker->dateTime($max = 'now', $timezone = 'Asia/Kuala_Lumpur');

            $jobHistory->save(); // save new info and automatically save created and updated demployee
        }
    }
}
