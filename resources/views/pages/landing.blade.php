<!-- resources/views/pages/landing.blade.php -->
@extends('layouts.layout')

@section('content')
<section class="pt-32 pb-20 px-4 mt-20">
    <div class="container mx-auto text-center">
        <div class="justify-center flex items-center mb-10">
            <img src="{{ asset('hero.svg') }}" alt="logo">
        </div>
        <p class="text-xl mb-12 opacity-80">Temukan, simpan, dan lacak film dan serial favoritmu.</p>

        <div class="flex flex-col md:flex-row justify-center items-center gap-10 mt-20 relative">
            <div class="movie-card cursor-pointer rounded-lg overflow-hidden w-100 shadow-lg" onclick="openPosterModal('poster1')">
                <img src="{{ asset('star-wars.png') }}" alt="Star Wars: The Force Awakens" class="w-full h-auto">
            </div>
            <div class="movie-card cursor-pointer rounded-lg overflow-hidden w-100 shadow-lg z-10 transform md:scale-110" onclick="openPosterModal('poster2')">
                <img src="{{ asset('avengers.png') }}" alt="Avengers: Endgame" class="w-full h-auto">
            </div>
            <div class="movie-card cursor-pointer rounded-lg overflow-hidden w-100 shadow-lg" onclick="openPosterModal('poster3')">
                <img src="{{ asset('thewitch.png') }}" alt="The Witch" class="w-full h-auto">
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

@endsection
