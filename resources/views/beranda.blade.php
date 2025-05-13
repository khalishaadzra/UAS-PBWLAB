<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Film | Trakt</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/film.css') }}">
</head>
<body class="bg-gray-900 text-white">

    <!-- Navbar -->
    <nav class="bg-gray-800 p-4">
        <div class="container mx-auto flex justify-between items-center">
            <a href="/" class="text-2xl font-bold text-red-600">Trakt</a>
            <div class="space-x-4">
                <a href="/" class="hover:text-red-500">Home</a>
                <a href="/film" class="text-red-500 font-semibold">Film</a>
                <a href="/series" class="hover:text-red-500">Series</a>
                <a href="/about" class="hover:text-red-500">About</a>
            </div>
        </div>
    </nav>

    <!-- Judul Halaman -->
    <section class="text-center my-12">
        <h1 class="text-4xl font-bold text-red-500 mb-4">Film Collection</h1>
        <p class="text-gray-300">Browse your favorite movies with stylish UI</p>
    </section>

    <!-- Grid Film -->
    <section class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8 px-8 pb-16">
        <!-- Card 1 -->
        <div class="bg-gray-800 rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
            <img src="https://image.tmdb.org/t/p/w500/qsdjk9oAKSQMWs0Vt5Pyfh6O4GZ.jpg" alt="Dune" class="w-full h-64 object-cover">
            <div class="p-4">
                <h2 class="text-xl font-semibold text-red-500">Dune (2021)</h2>
                <p class="text-gray-400 mt-2 text-sm">A mythic and emotionally charged hero's journey of Paul Atreides.</p>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="bg-gray-800 rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
            <img src="https://image.tmdb.org/t/p/w500/a6f9c3wKiaKlYkP8bDC9ijVtbL2.jpg" alt="Everything Everywhere All at Once" class="w-full h-64 object-cover">
            <div class="p-4">
                <h2 class="text-xl font-semibold text-red-500">Everything Everywhere All at Once (2022)</h2>
                <p class="text-gray-400 mt-2 text-sm">An aging Chinese immigrant is swept up in a crazy adventure.</p>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="bg-gray-800 rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
            <img src="https://image.tmdb.org/t/p/w500/jRXYjXNq0Cs2TcJjLkki24MLp7u.jpg" alt="Avatar 2" class="w-full h-64 object-cover">
            <div class="p-4">
                <h2 class="text-xl font-semibold text-red-500">Avatar: The Way of Water (2022)</h2>
                <p class="text-gray-400 mt-2 text-sm">Jake Sully lives with his newfound family formed on the extrasolar moon Pandora.</p>
            </div>
        </div>

        <!-- Card 4 -->
        <div class="bg-gray-800 rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
            <img src="https://image.tmdb.org/t/p/w500/xDMIl84Qo5Tsu62c9DGWhmPI67A.jpg" alt="Black Panther" class="w-full h-64 object-cover">
            <div class="p-4">
                <h2 class="text-xl font-semibold text-red-500">Black Panther: Wakanda Forever (2022)</h2>
                <p class="text-gray-400 mt-2 text-sm">Queen Ramonda, Shuri, M’Baku, and Okoye fight to protect Wakanda.</p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-center p-4 text-gray-500">
        © 2025 Trakt. All rights reserved.
    </footer>

</body>
</html>
