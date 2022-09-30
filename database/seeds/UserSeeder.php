<?php

use Illuminate\Database\Seeder;
use App\User;
use Faker\Generator as Faker;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $user = new User();
        $user->name = 'Manu';
        $user->email = 'manueltano@gmail.com';
        $user->password = bcrypt('manueltano');
        $user->save();

        for ($i = 0; $i < 9; $i++) {
            $user = new User();
            $user->name = $faker->userName();
            $user->email = $faker->email();
            $user->password = bcrypt('password');
            $user->save();
        }
    }
}
