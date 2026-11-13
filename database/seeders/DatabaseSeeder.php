<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Order matters: users need authors and posts, comments need users and posts
        $this->call([
            AuthorSeeder::class,
            PostSeeder::class,
            UserSeeder::class,
            TagSeeder::class,
            CommentSeeder::class,
        ]);
    }
}