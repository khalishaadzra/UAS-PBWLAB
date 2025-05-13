<!-- resources/views/layouts/layout.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Watchverse' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#2D2B40',
                        secondary: '#1E1C2F',
                        accent: '#DD9BB5',
                    },
                }
            }
        }
    </script>
    <style>
        body {
            background: linear-gradient(to bottom, #2D2B40, #1E1C2F);
            font-family: 'Inter', sans-serif;
        }
        .movie-card { transition: transform 0.3s ease, box-shadow 0.3s ease; }
        .movie-card:hover {
            transform: translateY(-10px) scale(1.05);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.4);
        }
        .poster-modal {
            display: none; position: fixed; top: 0; left: 0;
            width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.8);
            z-index: 50; justify-content: center; align-items: center;
        }
        .poster-content {
            max-width: 80%; max-height: 80%;
        }
    </style>
</head>
<body class="min-h-screen text-white">

    @include('components.navbar')

    <main>
        @yield('content')
    </main>

    @include('components.footer')

</body>
</html>
