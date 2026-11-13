<?php

namespace App\Http\Controllers;

use App\Models\Author;

class AuthorController extends Controller
{
    public function show(Author $author)
    {
        // this author's published posts, newest first, with their tags loaded
        $posts = $author->posts()
            ->where('is_published', true)
            ->with('tags')
            ->latest('published_at')
            ->get();

        // hasManyThrough: counts the comments written on all of this author's posts
        $commentsReceived = $author->comments()->count();

        return view('authors.show', compact('author', 'posts', 'commentsReceived'));
    }
}