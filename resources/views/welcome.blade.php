<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Aparri Rooms</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
    @endif
</head>

<body class="font-sans antialiased dark:bg-black dark:text-white/50">
    <div class="container-fluid min-vh-100 d-flex justify-content-center align-items-center">
        <div class="text-center">
            <h1 class="display-4 text-primary">Welcome to Aparri Rooms</h1>
            <p class="lead text-muted">Your one-stop platform for finding the best boarding houses in Aparri.</p>
            <a href="{{ route('login') }}" class="btn btn-primary btn-lg mt-4">Login</a>
            <a href="{{ route('register') }}" class="btn btn-outline-primary btn-lg mt-4">Get Started</a>
        </div>
    </div>

</body>

</html>
