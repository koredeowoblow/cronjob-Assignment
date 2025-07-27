<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DemoUserSeeder extends Seeder
{
    public function run()
    {
        // Create main user
        $mainUser = User::create([
            'name' => 'Main User',
            'email' => 'mainuser@example.com',
            'password' => Hash::make('password'),
        ]);

        // Create fans
        for ($i = 1; $i <= 5; $i++) {
            $fan = User::create([
                'name' => "Fan User $i",
                'email' => "fan$i@example.com",
                'password' => Hash::make('password'),
            ]);

            // Attach fan to main user
            $mainUser->fans()->attach($fan->id);
        }
    }
}
