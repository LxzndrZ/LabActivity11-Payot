<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // Payot has 5 letters, so I use the minimum of 6
    private const PER_PAGE = 6;

    public function index(Request $request)
    {
        $posts = Post::query()
            // load the author and tags together with the posts (no N+1)
            ->with(['author', 'tags'])
            // adds a comments_count number to every post
            ->withCount('comments')
            ->where('is_published', true)
            ->when($request->filled('q'), function ($query) use ($request) {
                $query->where('title', 'like', '%' . $request->q . '%');
            })
            ->when($request->filled('category'), function ($query) use ($request) {
                $query->where('category', $request->category);
            })
            // ?tag=Urgent keeps only posts that have a tag with that name
            ->when($request->filled('tag'), function ($query) use ($request) {
                $query->whereHas('tags', function ($tagQuery) use ($request) {
                    $tagQuery->where('name', $request->tag);
                });
            })
            ->orderByDesc('is_pinned')
            ->latest('published_at')
            ->paginate(self::PER_PAGE)
            ->withQueryString();

        $categories = Post::query()->distinct()->orderBy('category')->pluck('category');

        return view('posts.index', compact('posts', 'categories'));
    }

    public function show($id)
    {
        // A draft or a missing post returns 404
        $post = Post::where('is_published', true)->findOrFail($id);

        $post->views = $post->views + 1;
        $post->save();

        // load everything the page needs in one go, newest comments first
        $post->load([
            'author',
            'tags',
            'comments' => function ($query) {
                $query->orderByDesc('created_at')->orderByDesc('id');
            },
            'comments.user',
        ]);

        return view('posts.show', compact('post'));
    }
}