<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $authors = Author::all();

        // 40 published posts, spread over the existing authors
        Post::factory()->count(40)
            ->sequence(fn ($seq) => ['author_id' => $authors->random()->id])
            ->create();

        // 10 drafts
        Post::factory()->count(10)->draft()
            ->sequence(fn ($seq) => ['author_id' => $authors->random()->id])
            ->create();

        // Your pinned post, written by your Kagawad, on your birthday in 2026
        $kagawad = Author::where('email', 'kagawad.payot@bulletin.test')->first();

        Post::create([
            'author_id' => $kagawad->id,
            'title' => 'Purok Payot Clean-up Drive',
            'category' => 'Announcement',
            'body' => 'Purok Payot will have a clean-up drive this Saturday, May 23, at 7:00 in the morning. We will meet at the covered court and clean the canal and the road beside it. Please bring gloves, sacks and your own water. Everyone is welcome, so bring your kids too. - Kagawad Payot',
            'is_published' => true,
            'is_pinned' => true,
            'published_at' => '2026-05-20 08:00:00',
        ]);
    }
}