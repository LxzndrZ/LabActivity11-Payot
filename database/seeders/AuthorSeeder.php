<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Created by hand (not by the factory), as the brief requires
        Author::create([
            'name' => 'Kagawad Alexzander Payot',
            'position' => 'Kagawad',
            'email' => 'kagawad.payot@bulletin.test',
        ]);

        // 4 more random authors from the factory (5 in total)
        Author::factory()->count(4)->create();
    }
}