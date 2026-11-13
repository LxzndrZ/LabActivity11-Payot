@extends('layouts.app')

@section('title', 'Login – Barangay Bulletin')

@section('content')
    <div class="max-w-md mx-auto bg-white rounded shadow p-6">
        <h1 class="text-2xl font-bold mb-4">Login</h1>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <label for="email" class="block text-sm font-medium mb-1">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}"
                   class="w-full border rounded px-3 py-2 mb-1" required autofocus>
            @error('email')
                <p class="text-red-600 text-sm mb-2">{{ $message }}</p>
            @enderror

            <label for="password" class="block text-sm font-medium mb-1 mt-3">Password</label>
            <input id="password" type="password" name="password"
                   class="w-full border rounded px-3 py-2 mb-1" required>
            @error('password')
                <p class="text-red-600 text-sm mb-2">{{ $message }}</p>
            @enderror

            <button type="submit" class="mt-4 bg-green-700 text-white px-4 py-2 rounded hover:bg-green-800">
                Login
            </button>
        </form>
    </div>
@endsection