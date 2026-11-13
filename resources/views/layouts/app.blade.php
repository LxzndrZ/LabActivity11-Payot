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
            <a href="{{ route('posts.index') }}" class="text-sm hover:underline">All Posts</a>
        </div>
    </nav>

    <main class="max-w-5xl mx-auto px-4 py-6 w-full flex-1">
        @yield('content')
    </main>

    <footer class="bg-gray-200 text-center text-sm py-4">
        Barangay Matina Crossing Hall, Davao City
    </footer>

</body>
</html>
