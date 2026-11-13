<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();

        // 0 to 5 comments on every published post, each by a random user
        Post::where('is_published', true)->get()->each(function ($post) use ($users) {
            Comment::factory()
                ->count(rand(0, 5))
                ->sequence(fn ($seq) => ['user_id' => $users->random()->id])
                ->create(['post_id' => $post->id]);
        });

        // The pinned post gets 3 comments I wrote, one of them by Lola
        $pinned = Post::where('is_pinned', true)->first();
        $lola = User::where('email', 'lola.payot@bulletin.test')->first();
        $kagawad = User::where('email', 'kagawad.payot@bulletin.test')->first();

        Comment::create([
            'post_id' => $pinned->id,
            'user_id' => $lola->id,
            'body' => 'Salamat sa pahibalo, mupadong ko sa Sabado.',
        ]);
        Comment::create([
            'post_id' => $pinned->id,
            'user_id' => $kagawad->id,
            'body' => 'Please bring your own gloves and sacks.',
        ]);
        Comment::create([
            'post_id' => $pinned->id,
            'user_id' => $users->random()->id,
            'body' => 'Count me in, I will bring my neighbors too.',
        ]);
    }
}