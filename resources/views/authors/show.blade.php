@extends('layouts.app')

@section('title', $author->name . ' - Barangay Bulletin')

@section('content')

    <a href="{{ route('posts.index') }}" class="text-green-700 hover:underline text-sm">&larr; Back to all posts</a>

    <div class="bg-white rounded shadow p-6 mt-4">
        <h1 class="text-2xl font-bold">{{ $author->name }}</h1>
        <p class="text-gray-600">{{ $author->position }}</p>

        {{-- number comes from the hasManyThrough relation --}}
        <p class="mt-2 text-sm text-gray-500">{{ $commentsReceived }} comments received</p>
    </div>

    <h2 class="text-xl font-semibold mt-6 mb-3">Published posts ({{ $posts->count() }})</h2>

    <div class="grid gap-4 md:grid-cols-2">
        @forelse ($posts as $post)
            <div class="bg-white rounded shadow p-4">
                @if ($post->is_pinned)
                    <span class="bg-yellow-200 text-yellow-800 text-xs px-2 py-1 rounded">Pinned</span>
                @endif
                <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded">{{ $post->category }}</span>

                <h3 class="text-lg font-semibold mt-2">
                    <a href="{{ route('posts.show', $post->id) }}" class="hover:underline">{{ $post->title }}</a>
                </h3>

                <p class="text-sm text-gray-500 mt-1">{{ $post->published_at->format('M d, Y') }}</p>

                <div class="mt-2 flex flex-wrap gap-1">
                    @foreach ($post->tags as $tag)
                        <a href="{{ route('posts.index', ['tag' => $tag->name]) }}"
                           class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded hover:bg-blue-200">
                            {{ $tag->name }}
                        </a>
                    @endforeach
                </div>
            </div>
        @empty
            <p class="text-gray-500">No published posts yet.</p>
        @endforelse
    </div>

@endsection