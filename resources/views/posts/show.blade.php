@extends('layouts.app')

@section('title', $post->title . ' – Barangay Bulletin')

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
            · {{ $post->views }} views
            · Author #{{ $post->author_id }}
        </p>

        <div class="mt-4 leading-relaxed">
            {{ $post->body }}
        </div>
    </article>

@endsection
