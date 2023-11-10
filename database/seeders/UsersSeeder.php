<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect([
            [
                'username' => 'azizi',
                'password' => bcrypt('12345'),
                'role' => 'user',
                'created_at' => now(),
                'updated_at' => now(),
                'division_id' => 2
            ],
            ])->each(function($user){
                User::create($user);
    });
    }
}
