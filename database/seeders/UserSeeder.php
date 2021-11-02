<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
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
            // this method will not include datetime
            // DB::table('companies')->insert([
            //     'name' => $faker->name,
            //     'branch' => $faker->branch,
            //     'email' => $faker->email
            //     'dob' => $faker->date($format = 'D-m-y',)
            // ]);

            // this method will include datetime 
            $user = new User(); // make temperory row
            $user->name = $faker->name;  // create fake info
            $user->email = $faker->email;
            $user->password = bcrypt('password');
            $user->save(); // save new info and automatically save created and updated date
        }
    }
}
