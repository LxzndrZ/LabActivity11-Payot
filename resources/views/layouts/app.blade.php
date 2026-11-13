<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Barangay Bulletin – Purok Payot')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-800 min-h-screen flex flex-col">

    <nav class="bg-green-700 text-white">
        <div class="max-w-5xl mx-auto px-4 py-4 flex items-center justify-between">
            <a href="{{ route('posts.index') }}" class="text-lg font-bold">
                Barangay Bulletin – Purok Payot
            </a>

            <div class="flex items-center gap-4 text-sm">
                <a href="{{ route('posts.index') }}" class="hover:underline">All Posts</a>

                @auth
                    {{-- only Kagawads (users with an author profile) can write posts --}}
                    @if (auth()->user()->author)
                        <a href="{{ route('posts.create') }}" class="hover:underline">New post</a>
                    @endif

                    <span>Hi, {{ auth()->user()->name }}</span>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="hover:underline">Logout</button>
                    </form>
                @endauth

                @guest
                    <a href="{{ route('login') }}" class="hover:underline">Login</a>
                @endguest
            </div>
        </div>
    </nav>

    <main class="max-w-5xl mx-auto px-4 py-6 w-full flex-1">
        {{-- flash message, for example "Comment posted." --}}
        @if (session('status'))
            <div class="bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded mb-4">
                {{ session('status') }}
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="bg-gray-200 text-center text-sm py-4">
        Barangay Matina Crossing Hall, Davao City
    </footer>

</body>
</html>