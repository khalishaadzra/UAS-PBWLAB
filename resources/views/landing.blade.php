<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Watchverse - Your Universe of Movies and Shows</title>
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
        .movie-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .movie-card:hover {
            transform: translateY(-10px) scale(1.05);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.4);
        }
        .poster-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            z-index: 50;
            justify-content: center;
            align-items: center;
        }
        .poster-content {
            max-width: 80%;
            max-height: 80%;
        }
    </style>
</head>
<body class="min-h-screen text-white">
    <!-- Navbar -->
    <nav id="navbar" class="fixed top-0 left-0 right-0 bg-opacity-80 backdrop-blur-md bg-secondary z-40 transition-all duration-300">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a href="#" class="text-2xl font-bold text-white flex items-center">
                <svg class="h-8 w-auto " viewBox="0 0 100 30" fill="none" xmlns="http://www.w3.org/2000/svg">   
                </svg>
                <div>
                <img src="Watchverse.svg" alt="logo">
            </div>
            </a>
            <div class="hidden md:flex space-x-6">
                <div class="relative group">
                    <button class="text-white hover:text-accent flex items-center">
                        About
                    </button>
                </div>
                <div class="relative group">
                    <button class="text-white hover:text-accent flex items-center">
                        Offer
                    </button>
                </div>
                <div class="relative group">
                    <button class="text-white hover:text-accent flex items-center">
                        Features
                    </button>
                </div>
                <a href="#" class="text-white hover:text-accent">Contact</a>
            </div>
            <button class="bg-secondary hover:bg-opacity-90 text-white px-6 py-4 rounded-md">Create an account</button>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="pt-32 pb-20 px-4 mt-20">
        <div class="container mx-auto text-center ">
            <div class="justify-center flex items-center mb-10">
                <img src="hero.svg" alt="logo">
            </div>
            <p class="text-xl mb-12 text-white opacity-80">Temukan, simpan, dan lacak film dan serial favoritmu.</p>
            
            <div class="flex flex-col md:flex-row justify-center items-center gap-10 mt-20 relative">
                <!-- Movie Card 1 - Star Wars -->
                <div class="movie-card cursor-pointer rounded-lg overflow-hidden w-100 shadow-lg mt-100" onclick="openPosterModal('poster1')">
                    <img src="star-wars.png" alt="Star Wars: The Force Awakens" class="w-full h-auto">
                </div>
                
                <!-- Movie Card 2 - Avengers -->
                <div class="movie-card cursor-pointer rounded-lg overflow-hidden w-100 shadow-lg z-10 transform md:scale-110" onclick="openPosterModal('poster2')">
                    <img src="avengers.png" alt="Avengers: Endgame" class="w-full h-auto">
                </div>
                
                <!-- Movie Card 3 - The Witch -->
                <div class="movie-card cursor-pointer rounded-lg overflow-hidden w-100 shadow-lg mt-100" onclick="openPosterModal('poster3')">
                    <img src="thewitch.png" alt="The Witch" class="w-full h-auto">
                </div>
            </div>
        </div>
    </section>

    <!-- Our Offer Section -->
    <section class="py-16 px-4 mt-10">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">Our Offer</h2>
            <p class="text-lg mb-12 max-w-2xl mx-auto opacity-80">A simple way to keep track of what you watch and what to watch next.</p>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-12">
                <!-- Feature 1 -->
                <div class="flex flex-col items-center">
                    <div class=" p-6 mb-6">
                        <img src="explore.svg" alt="icon explore">
                    </div>
                    <h3 class="text-xl font-semibold mb-2 text-[#DD9BB5]">Explore</h3>
                    <p class="text-center opacity-80">Cari film dan serial dari berbagai genre dan rekomendasi</p>
                </div>
                
                <!-- Feature 2 -->
                <div class="flex flex-col items-center">
                    <div class=" p-6 mb-6">
                        <img src="add.svg" alt="icon explore">
                    </div>
                    <h3 class="text-xl font-semibold mb-2 text-[#DD9BB5]">Add</h3>
                    <p class="text-center opacity-80">Tambahkan ke wishlist tontonanmu</p>
                </div>
                
                <!-- Feature 3 -->
                <div class="flex flex-col items-center">
                    <div class=" p-6 mb-6">
                        <img src="review.svg" alt="icon explore">
                    </div>
                    <h3 class="text-xl font-semibold mb-2 text-[#DD9BB5]">Review</h3>
                    <p class="text-center opacity-80">Beri rating dan catatan sesuai pengalaman nontonmu</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Key Features Section -->
    <section class="py-16 px-4 mt-20">
        <div class="container mx-auto text-center">
            <h2 class="text-2xl font-semibold mb-2">Key</h2>
            <h2 class="text-3xl md:text-4xl font-bold mb-12">Features</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-12">
                <!-- Feature Card 1 -->
                <div class="bg-primary bg-opacity-30 p-6 rounded-lg">
                    <div class="h-40 bg-primary bg-opacity-50 rounded-lg mb-4"></div>
                    <h1>
                        Manage your personal watchlist
                    </h1>
                </div>
                
                <!-- Feature Card 2 -->
                <div class="bg-primary bg-opacity-30 p-6 rounded-lg md:mt-12">
                    <div class="h-40 bg-primary bg-opacity-50 rounded-lg mb-4"></div>
                    <h1>
                        Track your watching progress
                    </h1>
                </div>
                
                <!-- Feature Card 3 -->
                <div class="bg-primary bg-opacity-30 p-6 rounded-lg">
                    <div class="h-40 bg-primary bg-opacity-50 rounded-lg mb-4"></div>
                    <h1>
                        Rate and review what you've seen
                    </h1>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer / Category -->
        <footer class="bg-secondary text-white py-20 px-6">
            <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-8 text-center md:text-left">
                <div>
                    <img src="watchverse.svg" alt="wathcverse Logo" class="h-6 mx-auto md:mx-0">
                    <p class="text-sm mt-2">Your watchlist, organized and personalized!</p>
                    <div class="flex justify-center md:justify-start space-x-8 mt-6 text-xl">
                        <a href="#" class="hover:text-secondary"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="hover:text-secondary"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="hover:text-secondary"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
                <div>
                    <h3 class="font-semibold mb-2">Support</h3>
                    <p class="text-sm">Darussalam, Kec. Syiah Kuala<br>Kota Banda Aceh, Aceh 23111</p>
                    <p class="text-sm mt-2">watchverse@gmail.com<br>+62 819 3748 1281</p>
                </div>
                <div>
                    <h3 class="font-semibold mb-2">Features</h3>
                    <ul class="text-sm space-y-1">
                        <li>Explore</li>
                        <li>Add</li>
                        <li>Track & Review</li>
                    </ul>
                </div>
            </div>
            <p class="text-center text-xs mt-10">© 2025 Watchverse. All rights reserved.</p>
        </footer>

    <!-- Poster Modal Containers -->
    <div id="poster1Modal" class="poster-modal">
        <div class="poster-content relative">
            <button onclick="closePosterModal('poster1')" class="absolute top-4 right-4 bg-white bg-opacity-20 rounded-full p-2">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="white">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
            <img src="star-wars.png" alt="Star Wars: The Force Awakens" class="max-w-full rounded-lg shadow-2xl">
        </div>
    </div>

    <div id="poster2Modal" class="poster-modal">
        <div class="poster-content relative">
            <button onclick="closePosterModal('poster2')" class="absolute top-4 right-4 bg-white bg-opacity-20 rounded-full p-2">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="white">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
            <img src="avengers.png" alt="Avengers: Endgame" class="max-w-full rounded-lg shadow-2xl">
        </div>
    </div>

    <div id="poster3Modal" class="poster-modal">
        <div class="poster-content relative">
            <button onclick="closePosterModal('poster3')" class="absolute top-4 right-4 bg-white bg-opacity-20 rounded-full p-2">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="white">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
            <img src="thewitch.png" alt="The Witch" class="max-w-full rounded-lg shadow-2xl">
        </div>
    </div>

    <script>
    // Sticky navbar functionality
    window.addEventListener('scroll', function() {
        const navbar = document.getElementById('navbar');
        if (window.scrollY > 50) {
            navbar.classList.add('py-2', 'shadow-lg');
            navbar.classList.remove('py-4');
        } else {
            navbar.classList.add('py-4');
            navbar.classList.remove('py-2', 'shadow-lg');
        }
    });

    // Modal functions for poster pop-ups
    function openPosterModal(posterId) {
        document.getElementById(`${posterId}Modal`).style.display = 'flex';
    }

    function closePosterModal(posterId) {
        document.getElementById(`${posterId}Modal`).style.display = 'none';
    }

    // Optional: Close modal when clicking outside the content
    document.querySelectorAll('.poster-modal').forEach(modal => {
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                modal.style.display = 'none';
            }
        });
    });
</script>
</body>
</html>