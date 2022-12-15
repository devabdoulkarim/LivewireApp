<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        $admin = User::create([
            'name' => 'Dev AbdoulKarim',
            'email' => 'admin@admin.com',
            'title' => $faker->sentence,
            'password' => Hash::make('password')
        ]);
        $adminRole  = Role::where('name','ADMIN')->first();
        $admin->roles()->attach($adminRole);

        for($i=0; $i<=100; $i++):
            // CETTE LIGNE PERMET  LA SEEDER LA TABLE
            $member = User::create([
                'name' => $faker->name(),
                'title' => $faker->sentence,
                'email' => $faker->unique()->safeEmail(),
                'password' => Hash::make('password')
            ]);

            // CETTE LIGNE PERMET  LA SEEDER LA TABLE
            $owner = User::create([
                'name' => $faker->name(),
                'title' => $faker->sentence,
                'email' => $faker->unique()->safeEmail(),
                'password' => Hash::make('password')
            ]);

            $memberRole  = Role::where('name','MEMBER')->first();
            $ownerRole  = Role::where('name','OWNER')->first();

            $member->roles()->attach($memberRole);
            $owner->roles()->attach($ownerRole);
        endfor;


    }
}
