<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    public function run(): void
    {
        // my five tags, Community is the one I picked myself
        foreach (['Purok Payot', 'Urgent', 'Libre', 'Schedule', 'Community'] as $name) {
            Tag::create(['name' => $name]);
        }

        $tagIds = Tag::pluck('id');

        // Give every post 1 to 3 random tags through the relationship
        Post::all()->each(function ($post) use ($tagIds) {
            $post->tags()->attach($tagIds->random(rand(1, 3))->all());
        });

        // The pinned post always has exactly these two tags
        $pinned = Post::where('is_pinned', true)->first();
        $pinned->tags()->sync(
            Tag::whereIn('name', ['Purok Payot', 'Urgent'])->pluck('id')->all()
        );
    }
}