<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <!-- Background Meteor Animation -->
    <div class="meteor-background">
        <div class="meteor"></div>
        <div class="meteor"></div>
        <div class="meteor"></div>
        <div class="meteor"></div>
        <div class="meteor"></div>
    </div>

    <div>
        <x-navbar></x-navbar>
        <main class="relative isolate px-6 pb-28 lg:px-8">
            <div class="relative isolate px-6 pb-28 lg:px-8">
                <div class="relative z-10 py-24">
                    {{ $slot }}
                </div>
            </div>
        </main>
        <x-footer></x-footer>
    </div>
</body>
</html>