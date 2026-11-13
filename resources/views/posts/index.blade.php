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

        <button class="bg-green-700 text-white rounded px-4 py-2 hover:bg-green-800">Filter</button>
    </form>

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
                    · {{ $post->views }} views
                    · Author #{{ $post->author_id }}
                </p>
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
            Showing {{ $posts->firstItem() }}–{{ $posts->lastItem() }} of {{ $posts->total() }} posts
        </p>
    @endif

@endsection
