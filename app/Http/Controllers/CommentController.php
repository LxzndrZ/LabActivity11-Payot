<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Models\Post;

class CommentController extends Controller
{
    public function store(StoreCommentRequest $request, Post $post)
    {
        // nobody can comment on a draft post
        abort_unless($post->is_published, 404);

        // saved through the relationship, so post_id is filled in for us
        $post->comments()->create([
            ...$request->validated(),
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('posts.show', $post->id)->with('status', 'Comment posted.');
    }
}