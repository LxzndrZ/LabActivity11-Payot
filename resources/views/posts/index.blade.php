@extends('layouts.app')

@section('content')

    <h1 class="text-2xl font-bold mb-4">Latest Posts</h1>

    {{-- search and category filter --}}
    <form method="GET" action="{{ route('posts.index') }}" class="flex flex-col sm:flex-row gap-2 mb-6">
        <input type="text" name="q" value="{{ request('q') }}" placeholder="Search title"
               class="border rounded px-3 py-2 flex-1 bg-white">

        <select name="category" class="border rounded px-3 py-2 bg-white">
            <option value="">All categories</option>
            @foreach ($categories as $c)
                <option value="{{ $c }}" @selected(request('category') === $c)>{{ $c }}</option>
            @endforeach
        </select>

        {{-- keep the tag filter when the form is sent --}}
        @if (request('tag'))
            <input type="hidden" name="tag" value="{{ request('tag') }}">
        @endif

        <button class="bg-green-700 text-white rounded px-4 py-2 hover:bg-green-800">Filter</button>
    </form>

    @if (request('tag'))
        <p class="text-sm mb-4">
            Showing posts tagged <strong>{{ request('tag') }}</strong>.
            <a href="{{ route('posts.index') }}" class="text-green-700 hover:underline">Clear</a>
        </p>
    @endif

    {{-- post cards --}}
    <div class="grid gap-4 md:grid-cols-2">
        @forelse ($posts as $post)
            <div class="bg-white rounded shadow p-4">
                @if ($post->is_pinned)
                    <span class="bg-yellow-200 text-yellow-800 text-xs px-2 py-1 rounded">Pinned</span>
                @endif
                <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded">{{ $post->category }}</span>

                <h2 class="text-lg font-semibold mt-2">
                    <a href="{{ route('posts.show', $post->id) }}" class="hover:underline">{{ $post->title }}</a>
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    {{ $post->published_at->format('M d, Y') }}
                    &middot; {{ $post->views }} views
                    &middot; {{ $post->comments_count }} comments
                </p>

                <p class="text-sm mt-1">
                    By
                    <a href="{{ route('authors.show', $post->author) }}" class="text-green-700 hover:underline">
                        {{ $post->author->name }}
                    </a>
                </p>

                {{-- tag badges, each one filters the list --}}
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
            <p>No posts match your search.</p>
        @endforelse
    </div>

    {{-- page links and the "Showing x-y of z" line --}}
    <div class="mt-6">
        {{ $posts->links() }}
    </div>

    @if ($posts->total() > 0)
        <p class="text-sm text-gray-600 mt-2">
            Showing {{ $posts->firstItem() }}&ndash;{{ $posts->lastItem() }} of {{ $posts->total() }} posts
        </p>
    @endif

@endsection