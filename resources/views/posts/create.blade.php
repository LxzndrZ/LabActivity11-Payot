@extends('layouts.app')

@section('title', 'New post - Barangay Bulletin')

@section('content')

    <a href="{{ route('posts.index') }}" class="text-green-700 hover:underline text-sm">&larr; Back to all posts</a>

    <form method="POST" action="{{ route('posts.store') }}" class="bg-white rounded shadow p-6 mt-4">
        @csrf

        <h1 class="text-2xl font-bold mb-4">New post</h1>

        {{-- error summary --}}
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-800 px-4 py-3 rounded mb-4">
                <p class="font-semibold">Please fix the following:</p>
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <label for="title" class="block text-sm font-medium mb-1">Title</label>
        <input id="title" type="text" name="title" value="{{ old('title') }}"
               class="w-full border rounded px-3 py-2">
        @error('title')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror

        <label for="body" class="block text-sm font-medium mb-1 mt-4">Body</label>
        <textarea id="body" name="body" rows="6"
                  class="w-full border rounded px-3 py-2">{{ old('body') }}</textarea>
        @error('body')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror

        <label for="category" class="block text-sm font-medium mb-1 mt-4">Category</label>
        <select id="category" name="category" class="w-full border rounded px-3 py-2 bg-white">
            <option value="">Choose a category</option>
            @foreach ($categories as $category)
                <option value="{{ $category }}" @selected(old('category') === $category)>{{ $category }}</option>
            @endforeach
        </select>
        @error('category')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror

        <p class="block text-sm font-medium mb-1 mt-4">Tags (pick at least one)</p>
        <div class="flex flex-wrap gap-4">
            @foreach ($tags as $tag)
                <label class="flex items-center gap-1 text-sm">
                    <input type="checkbox" name="tags[]" value="{{ $tag->id }}"
                           @checked(in_array($tag->id, old('tags', [])))>
                    {{ $tag->name }}
                </label>
            @endforeach
        </div>
        @error('tags')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
        @error('tags.*')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror

        <label class="flex items-center gap-2 text-sm mt-4">
            <input type="checkbox" name="is_published" value="1" @checked(old('is_published'))>
            Publish now
        </label>
        @error('is_published')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror

        <button type="submit" class="mt-5 bg-green-700 text-white px-4 py-2 rounded hover:bg-green-800">
            Save post
        </button>
    </form>

@endsection