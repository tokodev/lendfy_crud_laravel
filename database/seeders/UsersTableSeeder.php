<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 30) as $index) {
            DB::table('users')->insert([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password'), 
                'cpf' => $faker->unique()->numerify('###########'), 
                'birth_date' => $faker->date,
                'street' => $faker->streetName,
                'street_number' => $faker->buildingNumber,
                'cep' => $faker->numerify('#####-###'), 
                'city' => $faker->city,
                'uf' => $faker->stateAbbr,
                'active' => $faker->boolean,
                'email_verified_at' => now(),
                'remember_token' => \Illuminate\Support\Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}