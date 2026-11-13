<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // The resident
        User::create([
            'name' => 'Lola Payot',
            'email' => 'lola.payot@bulletin.test',
            'password' => Hash::make('bulletin2026'),
        ]);

        // The Kagawad's login account
        $kagawadUser = User::create([
            'name' => 'Kagawad Alexzander Payot',
            'email' => 'kagawad.payot@bulletin.test',
            'password' => Hash::make('bulletin2026'),
        ]);

        // Link the login account to the existing Kagawad author profile
        Author::where('email', 'kagawad.payot@bulletin.test')
            ->first()
            ->update(['user_id' => $kagawadUser->id]);

        // 8 more residents from the user factory
        User::factory()->count(8)->create();
    }
}