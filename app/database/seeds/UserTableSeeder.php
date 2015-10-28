<?php
/**
*
*/
class UserTableSeeder extends Seeder
{

    public function run()
    {
        $faker = Faker\Factory::create();
        foreach (range(1,20) as $index) {
            User::create([
                'login' => $faker->username,
                'password' => Hash::make('123'),
                'email' => $faker->email,
                'role_id' => rand(1,3),
                'f_name' => $faker->firstName(),
                'l_name' => $faker->lastname,
                'country' => $faker->country,
                'city' => $faker->city,
                'confirmed' => rand(0,1)

                ]);

        }
    }
}