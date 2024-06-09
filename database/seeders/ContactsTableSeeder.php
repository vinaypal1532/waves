<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ContactsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 20) as $index) {
            DB::table('contacts')->insert([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'mobile_no' => $faker->phoneNumber,
                'city' => $faker->city,
                'details' => $faker->sentence(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
