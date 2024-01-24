<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$title ?? config('app.name','ToDo')}}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/app.js') }}"></script>
</head>
<body>
    <header class="bg-blue-500 p-4">
        <nav class="flex items-center justify-between">
            <!-- Logo -->
            <div class="text-white text-lg font-semibold">
                Your Logo
            </div>

            <!-- Navigation Links -->
            <div class="space-x-4">
                <a href="/todo" class="text-white hover:underline">Home</a>
                <a href="/signup" class="text-white hover:underline">Signup</a>
            </div>
        </nav>
    </header>
    <div>
        {{$slot}}
    </div>
</body>
</html>