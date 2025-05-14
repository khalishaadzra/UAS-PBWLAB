@extends('layouts.layout')

@section('content')
    <!-- Hero Section -->
<section class="hero h-screen relative overflow-hidden z-10">
    <div class="carousel relative w-full h-screen z-1">
        <!-- Slide 1 -->
        <div class="carousel-slide active absolute top-0 left-0 w-full h-full">
            <video autoplay muted loop playsinline onloadeddata="this.play()" onerror="this.nextElementSibling.style.display='block'; this.style.display='none';" class="w-full h-[155%] object-cover absolute top-[-200px] left-0 -z-10">
                <source src="{{ asset('tunder.mp4') }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
            <img class="fallback-image w-full h-[155%] object-cover absolute top-[-200px] left-0 -z-10 hidden" src="/api/placeholder/1920/1080" alt="Thunderbolts Fallback">
            <div class="overlay absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center flex-col text-center px-8">
                <h1 class="text-5xl md:text-6xl mb-4 text-white font-bold animate-[zoomIn_1s_ease-out]">Thunderbolts</h1>
                <p class="text-xl max-w-3xl mb-8 text-gray-200 animate-[fadeIn_1.5s_ease-out]">A thrilling Marvel adventure where a team of antiheroes must unite to save the world from a deadly threat. Packed with action and humor!</p>
                <button class="bg-accent hover:bg-accent/90 text-white px-8 py-4 rounded-md text-xl transition-all duration-300 hover:scale-105 shadow-lg shadow-accent/40" onclick="scrollToTrending()">Start Now</button>
            </div>
        </div>

        <!-- Slide 2 -->
        <div class="carousel-slide absolute top-0 left-0 w-full h-full hidden">
            <video autoplay muted loop playsinline onloadeddata="this.play()" onerror="this.nextElementSibling.style.display='block'; this.style.display='none';" class="w-full h-[155%] object-cover absolute top-[-200px] left-0 -z-10">
                <source src="{{ asset('Avatar_ The Way of Water _ Official Trailer.mp4') }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
            <img class="fallback-image w-full h-[155%] object-cover absolute top-[-200px] left-0 -z-10 hidden" src="/api/placeholder/1920/1080" alt="Avatar Fallback">
            <div class="overlay absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center flex-col text-center px-8">
                <h1 class="text-5xl md:text-6xl mb-4 text-white font-bold animate-[zoomIn_1s_ease-out]">Avatar: The Way of Water</h1>
                <p class="text-xl max-w-3xl mb-8 text-gray-200 animate-[fadeIn_1.5s_ease-out]">Dive back into Pandora with breathtaking visuals and an epic tale of family, survival, and the power of nature.</p>
                <button class="bg-accent hover:bg-accent/90 text-white px-8 py-4 rounded-md text-xl transition-all duration-300 hover:scale-105 shadow-lg shadow-accent/40" onclick="scrollToTrending()">Start Now</button>
            </div>
        </div>

        <!-- Slide 3 -->
        <div class="carousel-slide absolute top-0 left-0 w-full h-full hidden">
            <video autoplay muted loop playsinline onloadeddata="this.play()" onerror="this.nextElementSibling.style.display='block'; this.style.display='none';" class="w-full h-[155%] object-cover absolute top-[-200px] left-0 -z-10">
                <source src="{{ asset('Deadpool & Wolverine _ Official Trailer _ In Theaters July 26.mp4') }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
            <img class="fallback-image w-full h-[155%] object-cover absolute top-[-200px] left-0 -z-10 hidden" src="/api/placeholder/1920/1080" alt="Deadpool & Wolverine Fallback">
            <div class="overlay absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center flex-col text-center px-8">
                <h1 class="text-5xl md:text-6xl mb-4 text-white font-bold animate-[zoomIn_1s_ease-out]">Deadpool & Wolverine</h1>
                <p class="text-xl max-w-3xl mb-8 text-gray-200 animate-[fadeIn_1.5s_ease-out]">The Merc with a Mouth teams up with Wolverine in a hilarious, action-packed romp through the multiverse!</p>
                <button class="bg-accent hover:bg-accent/90 text-white px-8 py-4 rounded-md text-xl transition-all duration-300 hover:scale-105 shadow-lg shadow-accent/40" onclick="scrollToTrending()">Start Now</button>
            </div>
        </div>

        <!-- Navigasi Carousel -->
        <div class="carousel-nav absolute top-1/2 w-full flex justify-between transform -translate-y-1/2 z-20">
            <button onclick="prevSlide()" class="bg-opacity-50 hover:bg-accent ml-4 text-white text-3xl px-4 py-2 rounded-md">❮</button>
            <button onclick="nextSlide()" class="bg-opacity-50 hover:bg-accent mr-4 text-white text-3xl px-4 py-2 rounded-md">❯</button>
        </div>

        <!-- Dot Carousel -->
        <div class="carousel-dots absolute bottom-5 w-full text-center z-20">
            <span class="carousel-dot inline-block w-3 h-3 bg-gray-500 rounded-full mx-1 cursor-pointer active:bg-accent" onclick="goToSlide(0)"></span>
            <span class="carousel-dot inline-block w-3 h-3 bg-gray-500 rounded-full mx-1 cursor-pointer" onclick="goToSlide(1)"></span>
            <span class="carousel-dot inline-block w-3 h-3 bg-gray-500 rounded-full mx-1 cursor-pointer" onclick="goToSlide(2)"></span>
        </div>
    </div>
</section>

    <section class="navbarStart pt-24" id="navbarStart">
        <!-- Trending Movies Section -->
        <section class="movie-section trending px-6 py-10 md:px-12 relative z-20 opacity-0 translate-y-12 transition-all duration-1000" id="trendingSection">
            <h2 class="text-4xl mb-8 text-accent uppercase border-b-2 border-accent inline-block pb-1">Trending Movies</h2>
            <div class="movie-list grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-8 pb-8" id="trendingMovies"></div>
            <a href="#" class="text-accent hover:text-white text-xl transition-colors duration-300 inline-block mt-4">View All</a>
        </section>

        <!-- Most Anticipated Movies Section -->
        <section class="movie-section anticipated px-6 py-10 md:px-12 relative z-20 opacity-0 translate-y-12 transition-all duration-1000">
            <h2 class="text-4xl mb-8 text-accent uppercase border-b-2 border-accent inline-block pb-1">Most Anticipated</h2>
            <div class="movie-list grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-8 pb-8" id="anticipatedMovies"></div>
            <a href="#" class="text-accent hover:text-white text-xl transition-colors duration-300 inline-block mt-4">View All</a>
        </section>

        <!-- Popular Movies Section -->
        <section class="movie-section popular px-6 py-10 md:px-12 relative z-20 opacity-0 translate-y-12 transition-all duration-1000">
            <h2 class="text-4xl mb-8 text-accent uppercase border-b-2 border-accent inline-block pb-1">Popular Movies</h2>
            <div class="movie-list grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-8 pb-8" id="popularMovies"></div>
            <a href="#" class="text-accent hover:text-white text-xl transition-colors duration-300 inline-block mt-4">View All</a>
        </section>

        <!-- Top Rated Movies Section -->
        <section class="movie-section top-rated px-6 py-10 md:px-12 relative z-20 opacity-0 translate-y-12 transition-all duration-1000">
            <h2 class="text-4xl mb-8 text-accent uppercase border-b-2 border-accent inline-block pb-1">Top Rated Movies</h2>
            <div class="movie-list grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-8 pb-8" id="topRatedMovies"></div>
            <a href="#" class="text-accent hover:text-white text-xl transition-colors duration-300 inline-block mt-4">View All</a>
        </section>

    <!-- Modal for Details -->
    <div id="movieModal" class="fixed top-0 left-0 w-full h-full bg-opacity-90 z-50 hidden justify-center items-center">
        <div class="bg-primary p-8 rounded-xl max-w-lg text-center shadow-2xl animate-[slideIn_0.5s_ease-out]">
            <h3 id="modalTitle" class="text-3xl mb-4"></h3>
            <p id="modalOverview" class="mb-6 text-gray-300"></p>
            <p id="modalReleaseDate" class="mb-2 text-gray-400"></p>
            <p id="modalGenres" class="mb-6 text-gray-400"></p>
            <button class="bg-accent hover:bg-accent/90 text-white px-6 py-3 rounded-md transition-colors duration-300" onclick="closeModal()">Close</button>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
    // Navbar scroll behavior
    const navbar = document.querySelector('#navbar');

    if (navbar) {
        window.addEventListener('scroll', () => {
            if (window.scrollY > 800) { // Ubah nilai 50 sesuai kebutuhan
                navbar.classList.remove('bg-transparent');
                navbar.classList.add('bg-opacity-80', 'backdrop-blur-md', 'shadow-md');
            } else {
                navbar.classList.add('bg-transparent');
                navbar.classList.remove('bg-opacity-80', 'backdrop-blur-md', 'shadow-md');
            }
        });
    }

        // Data dummy untuk sementara
        const dummyMovies = {
            trending: [
                { id: 1, title: "Thunderbolts", poster: "{{ asset('Thunderbolt.jpeg') }}", watching: "695 watching", overview: "A team of antiheroes...", release_date: "2025-07-01" },
                { id: 2, title: "Nonnas", poster: "{{ asset('large.jpg') }}", watching: "505 watching", overview: "A family drama...", release_date: "2025-06-15" },
                { id: 3, title: "The Accountant", poster: "{{ asset('Thunderbolt.jpeg') }}", watching: "451 watching", overview: "A thriller about a genius...", release_date: "2025-05-20" },
                { id: 4, title: "Drop", poster: "{{ asset('large.jpg') }}", watching: "354 watching", overview: "An action-packed drop...", release_date: "2025-08-10" }
            ],
            anticipated: [
                { id: 5, title: "Avatar", poster: "{{ asset('Thunderbolt.jpeg') }}", eager: "34.8k eager", overview: "A return to Pandora...", release_date: "2025-12-15" },
                { id: 6, title: "Mission Impossible", poster: "{{ asset('Thunderbolt.jpeg') }}", eager: "29.4k eager", overview: "Ethan Hunt's new mission...", release_date: "2025-11-01" },
                { id: 7, title: "Avengers", poster: "{{ asset('Thunderbolt.jpeg') }}", eager: "18k eager", overview: "The next Avengers saga...", release_date: "2025-10-20" }
            ],
            popular: [
                { id: 8, title: "Deadpool", poster: "{{ asset('Thunderbolt.jpeg') }}", eager: "31.5k eager", overview: "A hilarious antihero...", release_date: "2025-05-10" },
                { id: 9, title: "Interstellar", poster: "{{ asset('Thunderbolt.jpeg') }}", eager: "22.8k eager", overview: "A space exploration epic...", release_date: "2025-06-01" },
                { id: 10, title: "Avatar", poster: "{{ asset('Thunderbolt.jpeg') }}", eager: "25.3k eager", overview: "Back to Pandora...", release_date: "2025-12-15" }
            ],
            topRated: [
                { id: 11, title: "The Godfather", poster: "{{ asset('Thunderbolt.jpeg') }}", rating: "9.2/10", overview: "A mafia masterpiece...", release_date: "2025-01-01" },
                { id: 12, title: "Inception", poster: "{{ asset('Thunderbolt.jpeg') }}", rating: "8.8/10", overview: "A mind-bending heist...", release_date: "2025-02-01" }
            ],
            recentlyAdded: [
                { id: 13, title: "Dune: Part Two", poster: "{{ asset('Thunderbolt.jpeg') }}", added: "New", overview: "The continuation of Dune...", release_date: "2025-03-01" },
                { id: 14, title: "Oppenheimer", poster: "{{ asset('Thunderbolt.jpeg') }}", added: "New", overview: "A historical drama...", release_date: "2025-04-01" }
            ]
        };

        // Carousel Functionality
        let currentSlide = 0;
        const slides = document.querySelectorAll('.carousel-slide');
        const dots = document.querySelectorAll('.carousel-dot');

        function showSlide(index) {
            slides.forEach((slide, i) => {
                if (i === index) {
                    slide.classList.remove('hidden');
                    slide.classList.add('block');
                    dots[i].classList.add('bg-accent');
                    dots[i].classList.remove('bg-gray-500');
                    const video = slide.querySelector('video');
                    if (video) video.play().catch(() => {
                        const fallback = slide.querySelector('.fallback-image');
                        if (fallback) fallback.style.display = 'block';
                    });
                } else {
                    slide.classList.add('hidden');
                    slide.classList.remove('block');
                    dots[i].classList.remove('bg-accent');
                    dots[i].classList.add('bg-gray-500');
                    const video = slide.querySelector('video');
                    if (video) video.pause();
                }
            });
            currentSlide = index;
        }

        function nextSlide() {
            currentSlide = (currentSlide + 1) % slides.length;
            showSlide(currentSlide);
        }

        function prevSlide() {
            currentSlide = (currentSlide - 1 + slides.length) % slides.length;
            showSlide(currentSlide);
        }

        function goToSlide(index) {
            showSlide(index);
        }

        // Auto slide every 8 seconds
        setInterval(nextSlide, 8000);

        // Fungsi untuk scroll ke Trending Movies
        function scrollToTrending() {
            const trendingSection = document.getElementById('trendingSection');
            trendingSection.scrollIntoView({ behavior: 'smooth' });
        }

        // Debounce function untuk pencarian real-time
        function debounce(func, wait) {
            let timeout;
            return function executedFunction(...args) {
                const later = () => {
                    clearTimeout(timeout);
                    func(...args);
                };
                clearTimeout(timeout);
                timeout = setTimeout(later, wait);
            };
        }

        // Fungsi untuk menampilkan film
        function displayMovies(movies, containerId) {
            const container = document.getElementById(containerId);
            container.innerHTML = '';
            movies.forEach((movie, index) => {
                const movieElement = document.createElement('div');
                movieElement.classList.add('movie-card', 'bg-secondary', 'rounded-xl', 'overflow-hidden', 'shadow-lg', 'cursor-pointer', 'hover:shadow-2xl');
                movieElement.innerHTML = `
                    <div class="relative">
                        <img src="${movie.poster}" alt="${movie.title}" class="w-full h-64 object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black to-transparent opacity-0 hover:opacity-100 transition-opacity duration-300 flex items-end">
                            <div class="p-4 w-full">
                                <div class="flex justify-between items-center">
                                    <button class="bg-secondary/70 hover:bg-secondary text-white px-2 py-1 rounded text-sm" onclick="showMovieDetails(${index}, '${containerId}')">Details</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="text-lg font-bold text-white mb-1 truncate">${movie.title}</h3>
                        <p class="text-sm text-gray-400">${movie.watching || movie.eager || movie.rating || movie.added || 'N/A'}</p>
                    </div>
                `;
                movieElement.addEventListener('click', (e) => {
                    if (!e.target.closest('button')) {
                        navigateToDesc(movie.id);
                    }
                });
                container.appendChild(movieElement);
            });
        }

        // Fungsi untuk menambahkan ke watchlist (simulasi)
        function addToWatchlist(movieId) {
            alert(`Added movie ID ${movieId} to your watchlist!`);
        }

        // Fungsi untuk menampilkan detail film di modal
        function showMovieDetails(index, containerId) {
            const category = containerId.replace('Movies', '');
            const movies = dummyMovies[category] || [];
            const movie = movies[index];
            document.getElementById('modalTitle').textContent = movie.title;
            document.getElementById('modalOverview').textContent = movie.overview || 'No overview available.';
            document.getElementById('modalReleaseDate').textContent = `Release Date: ${movie.release_date || 'N/A'}`;
            document.getElementById('modalGenres').textContent = `Genres: ${['Action', 'Adventure', 'Drama', 'Sci-Fi'][Math.floor(Math.random() * 4)] || 'Unknown'}`;
            document.getElementById('movieModal').style.display = 'flex';
        }

        // Fungsi untuk menutup modal
        function closeModal() {
            document.getElementById('movieModal').style.display = 'none';
        }

        // Fungsi untuk navigasi ke halaman deskripsi
        function navigateToDesc(movieId) {
            window.location.href = `movie-desc.html?id=${movieId}`;
        }

        // Scroll reveal untuk movie sections
        function revealSections() {
            const sections = document.querySelectorAll('.movie-section');
            sections.forEach(section => {
                const sectionTop = section.getBoundingClientRect().top;
                const windowHeight = window.innerHeight;
                if (sectionTop < windowHeight * 0.9) {
                    section.classList.add('opacity-100');
                    section.classList.remove('opacity-0', 'translate-y-12');
                }
            });
        }

        window.addEventListener('scroll', revealSections);
        window.addEventListener('resize', revealSections);

        // Close modal when clicking outside
        window.addEventListener('click', function(event) {
            const modal = document.getElementById('movieModal');
            if (event.target === modal) {
                closeModal();
            }
        });

        // Escape key closes modal
        window.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeModal();
            }
        });

        // Inisialisasi halaman dengan data dummy
        document.addEventListener('DOMContentLoaded', () => {
            displayMovies(dummyMovies.trending, 'trendingMovies');
            displayMovies(dummyMovies.anticipated, 'anticipatedMovies');
            displayMovies(dummyMovies.popular, 'popularMovies');
            displayMovies(dummyMovies.topRated, 'topRatedMovies');
            displayMovies(dummyMovies.recentlyAdded, 'recentlyAddedMovies');
            revealSections();
        });
    </script>
@endsection