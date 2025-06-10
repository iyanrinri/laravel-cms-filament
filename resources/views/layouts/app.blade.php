<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Laravel Filament')</title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.4.1/dist/tailwind.min.css" rel="stylesheet"> -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <nav class="bg-white shadow mb-8">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a href="/" class="text-2xl font-bold text-blue-700">Filament News</a>
            <div>
                <a href="/news" class="text-gray-700 hover:text-blue-700 px-3">News</a>
                <a href="/admin" class="text-gray-700 hover:text-blue-700 px-3">Admin</a>
            </div>
        </div>
    </nav>
    <main>
        @yield('content')
    </main>
</body>
</html>
