@extends('layouts.app')

@section('title', $post->title . ' - Barangay Bulletin')

@section('content')

    <a href="{{ route('posts.index') }}" class="text-green-700 hover:underline text-sm">&larr; Back to all posts</a>

    <article class="bg-white rounded shadow p-6 mt-4">
        @if ($post->is_pinned)
            <span class="bg-yellow-200 text-yellow-800 text-xs px-2 py-1 rounded">Pinned</span>
        @endif
        <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded">{{ $post->category }}</span>

        <h1 class="text-2xl font-bold mt-3">{{ $post->title }}</h1>

        <p class="text-sm text-gray-500 mt-1">
            {{ $post->published_at->format('F d, Y') }}
            &middot; {{ $post->views }} views
            &middot; By
            <a href="{{ route('authors.show', $post->author) }}" class="text-green-700 hover:underline">
                {{ $post->author->name }}
            </a>
        </p>

        {{-- tag badges --}}
        <div class="mt-2 flex flex-wrap gap-1">
            @foreach ($post->tags as $tag)
                <a href="{{ route('posts.index', ['tag' => $tag->name]) }}"
                   class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded hover:bg-blue-200">
                    {{ $tag->name }}
                </a>
            @endforeach
        </div>

        <div class="mt-4 leading-relaxed">
            {{ $post->body }}
        </div>
    </article>

    {{-- comments, newest first (the controller already sorted them) --}}
    <section class="mt-6">
        <h2 class="text-xl font-semibold mb-3">Comments ({{ $post->comments->count() }})</h2>

        @forelse ($post->comments as $comment)
            <div class="bg-white rounded shadow p-4 mb-3">
                <p class="text-sm font-semibold">
                    {{ $comment->user->name }}
                    <span class="text-gray-500 font-normal">&middot; {{ $comment->created_at->diffForHumans() }}</span>
                </p>
                <p class="mt-1">{{ $comment->body }}</p>
            </div>
        @empty
            <p class="text-gray-500">No comments yet.</p>
        @endforelse
    </section>

@endsection