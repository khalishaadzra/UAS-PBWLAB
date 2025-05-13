<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trakt.tv - Movies</title>
    <style>
        /* Global Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        body {
            background: #0d0d0d;
            color: #fff;
            line-height: 1.6;
            overflow-x: hidden;
        }

        /* Navbar Styles */
        .navbar {
            background-color: transparent;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 2rem;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            transition: background-color 0.3s ease;
            scale: 0;
            
        }

        .navbar .logo {
            font-size: 1.8rem;
            font-weight: 700;
            color: #9335ff;
            text-transform: lowercase;
            position: relative;
            padding-left: 1.5rem;
            transition: color 0.3s ease;
        }

        .navbar .logo::before {
            content: '✓';
            position: absolute;
            left: 0;
            color: #9335ff;
            font-weight: 700;
            font-size: 1.2rem;
        }

        .navbar .logo:hover {
            color: #7a2ad9;
        }

        .navbar nav ul {
            display: flex;
            list-style: none;
            align-items: center;
        }

        .navbar nav ul li {
            margin: 0 1.5rem;
        }

        .navbar nav ul li a {
            color: #d3d3d3;
            text-decoration: none;
            font-size: 1.1rem;
            font-weight: 500;
            transition: color 0.3s ease;
            text-transform: uppercase;
        }

        .navbar nav ul li a:hover {
            color: #9335ff;
        }

        .navbar .search-bar {
            display: flex;
            align-items: center;
        }

        .navbar .search-bar input {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 4px 0 0 4px;
            background-color: #2a2a2a;
            color: #fff;
            outline: none;
            font-size: 1rem;
            transition: background-color 0.3s ease;
        }

        .navbar .search-bar input:focus {
            background-color: #333;
        }

        .navbar .search-bar button {
            background-color: #9335ff;
            color: #fff;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 0 4px 4px 0;
            cursor: pointer;
            font-size: 1rem;
            transition: background-color 0.3s ease;
        }

        .navbar .search-bar button:hover {
            background-color: #7a2ad9;
        }

        /* Hero Section Styles */
        .hero {
            height: 100vh;
            position: relative;
            margin: 0; /* Menghapus semua margin */
            padding: 0; /* Menghapus semua padding */
            overflow: hidden;
            z-index: 1;
            
        }

        .carousel {
            position: relative;
            width: 100%;
            height: 100vh;
            margin: 0; /* Menghapus margin */
            padding: 0; /* Menghapus padding */
            z-index: 1;
            top: 0px;
            
        }

        .carousel-slide {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            margin: 0; /* Menghapus margin */
            padding: 0; /* Menghapus padding */
            display: none;
        
        }

        .carousel-slide.active {
            display: block;
        }

        .carousel-slide video {
            width: 100%;
            height: 140%;
            object-fit: cover;
            position: absolute;
            top: -140px;
            left: 0;
            z-index: -1;
        }

        .carousel-slide .fallback-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            position: absolute;
            top: 0;
            left: 0;
            z-index: -1;
            display: none;
        }

        .carousel-slide .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            text-align: center;
            padding: 2rem;
        }

        .carousel-slide h1 {
            font-size: 3rem;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.9);
            animation: zoomIn 1s ease-out;
        }

        .carousel-slide p {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            color: #e0e0e0;
            animation: fadeIn 1.5s ease-out;
            max-width: 800px;
        }

        .carousel-slide .start-now-btn {
            background-color: #9335ff;
            color: #fff;
            padding: 1rem 2rem;
            border: none;
            border-radius: 6px;
            font-size: 1.2rem;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(147, 53, 255, 0.4);
        }

        .carousel-slide .start-now-btn:hover {
            background-color: #7a2ad9;
            transform: scale(1.05);
            box-shadow: 0 6px 15px rgba(147, 53, 255, 0.6);
        }

        .carousel-nav {
            position: absolute;
            top: 50%;
            width: 100%;
            display: flex;
            justify-content: space-between;
            transform: translateY(-50%);
            z-index: 2;
        }

        .carousel-nav button {
            background-color: rgba(0, 0, 0, 0.5);
            border: none;
            color: #fff;
            font-size: 2rem;
            padding: 0.5rem 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .carousel-nav button:hover {
            background-color: rgba(147, 53, 255, 0.7);
        }

        .carousel-dots {
            position: absolute;
            bottom: 20px;
            width: 100%;
            text-align: center;
            z-index: 2;
        }

        .carousel-dot {
            display: inline-block;
            width: 12px;
            height: 12px;
            background-color: #666;
            border-radius: 50%;
            margin: 0 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .carousel-dot.active {
            background-color: #9335ff;
        }

        /* Movie Section Styles */
        .movie-section {
            padding: 2.5rem 2rem;
            position: relative;
            z-index: 2;
            opacity: 0;
            transform: translateY(50px);
            transition: opacity 1s ease-out, transform 1s ease-out;
        }

        .movie-section.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .movie-section h2 {
            font-size: 2.2rem;
            margin-bottom: 1.8rem;
            color: #9335ff;
            text-transform: uppercase;
            border-bottom: 2px solid #9335ff;
            display: inline-block;
            padding-bottom: 0.2rem;
        }

        .movie-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 1.8rem;
            padding-bottom: 2rem;
        }

        .movie-card {
            background-color: #1c1c1c;
            border-radius: 10px;
            overflow: hidden;
            transition: all 0.4s ease;
            position: relative;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.5);
            cursor: pointer;
        }

        .movie-card:hover {
            transform: scale(1.08) rotate(0.5deg);
            box-shadow: 0 6px 18px rgba(147, 53, 255, 0.3);
        }

        .movie-card img {
            width: 100%;
            height: 330px;
            object-fit: cover;
            transition: opacity 0.3s ease;
        }

        .movie-card:hover img {
            opacity: 0.95;
        }

        .movie-card .movie-info {
            padding: 1.2rem;
            background: linear-gradient(to top, #1c1c1c, transparent);
            position: absolute;
            bottom: 0;
            width: 100%;
        }

        .movie-card .movie-info h3 {
            font-size: 1.3rem;
            margin-bottom: 0.6rem;
            color: #fff;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.8);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .movie-card .movie-info p {
            font-size: 0.95rem;
            color: #ccc;
            margin-bottom: 0.8rem;
        }

        .movie-card .actions {
            display: flex;
            gap: 0.8rem;
        }

        .movie-card .action-btn {
            background-color: #9335ff;
            color: #fff;
            border: none;
            padding: 0.4rem 0.8rem;
            border-radius: 4px;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .movie-card .action-btn:hover {
            background-color: #7a2ad9;
            transform: scale(1.1);
        }

        .view-all {
            display: inline-block;
            margin-top: 1rem;
            color: #9335ff;
            text-decoration: none;
            font-size: 1.1rem;
            transition: color 0.3s ease;
        }

        .view-all:hover {
            color: #7a2ad9;
        }

        /* Modal Styles for Details */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.9);
            z-index: 1001;
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: #1a1a1a;
            padding: 2rem;
            border-radius: 10px;
            max-width: 600px;
            text-align: center;
            animation: slideIn 0.5s ease-out;
            box-shadow: 0 0 20px rgba(147, 53, 255, 0.3);
        }

        .modal-content h3 {
            font-size: 2rem;
            margin-bottom: 1rem;
        }

        .modal-content p {
            margin-bottom: 1.5rem;
            color: #ccc;
        }

        .modal-content .close-btn {
            background-color: #9335ff;
            color: #fff;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .modal-content .close-btn:hover {
            background-color: #7a2ad9;
        }

        /* Footer Styles */
        footer {
            background-color: #141414;
            padding: 2.5rem;
            text-align: center;
            border-top: 1px solid #2a2a2a;
            margin-top: 2rem;
            animation: fadeIn 2s ease-out;
        }

        footer p {
            font-size: 0.95rem;
            color: #999;
            margin-bottom: 1rem;
        }

        footer .footer-links {
            display: flex;
            justify-content: center;
            gap: 1.5rem;
            flex-wrap: wrap;
        }

        footer a {
            color: #9335ff;
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.3s ease;
        }

        footer a:hover {
            color: #7a2ad9;
            text-decoration: underline;
        }

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideIn {
            from { transform: translateY(50px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        @keyframes zoomIn {
            from { transform: scale(0.8); opacity: 0; }
            to { transform: scale(1); opacity: 1; }
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .movie-list {
                grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
            }

            .movie-card img {
                height: 280px;
            }

            .carousel-slide h1 {
                font-size: 2.5rem;
            }

            .carousel-slide p {
                font-size: 1rem;
            }
        }

        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                padding: 1rem;
            }

            .navbar nav ul {
                margin-top: 1rem;
                flex-wrap: wrap;
                justify-content: center;
            }

            .navbar nav ul li {
                margin: 0 1rem 0.5rem;
            }

            .navbar .search-bar {
                margin-top: 1rem;
                width: 100%;
            }

            .navbar .search-bar input {
                flex: 1;
            }

            .hero {
                height: 70vh;
            }

            .carousel-slide h1 {
                font-size: 2rem;
            }

            .carousel-slide p {
                font-size: 0.9rem;
            }

            .carousel-slide .start-now-btn {
                padding: 0.8rem 1.5rem;
                font-size: 1rem;
            }

            .movie-list {
                grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            }

            .movie-card img {
                height: 250px;
            }
        }

        @media (max-width: 480px) {
            .hero {
                height: 60vh;
            }

            .carousel-slide h1 {
                font-size: 1.5rem;
            }

            .carousel-slide p {
                font-size: 0.8rem;
            }

            .carousel-slide .start-now-btn {
                padding: 0.6rem 1.2rem;
                font-size: 0.9rem;
            }

            .movie-section h2 {
                font-size: 1.8rem;
            }

            .movie-list {
                grid-template-columns: 1fr;
            }

            .movie-card img {
                height: 200px;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <header class="navbar">
        <div class="logo">trakt</div>
        <nav>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">Shows</a></li>
                <li><a href="#">Movies</a></li>
                <li><a href="#">Discover</a></li>
            </ul>
        </nav>
        <div class="search-bar">
            <input type="text" id="searchInput" placeholder="Search movies...">
            <button onclick="searchMovies()">Search</button>
        </div>
    </header>

    <!-- Hero Section -->
    <main>
        <section class="hero">
            <div class="carousel">
                <div class="carousel-slide active">
                    <video autoplay muted loop playsinline onloadeddata="this.play()" onerror="this.nextElementSibling.style.display='block'; this.style.display='none';">
                        <source src="{{ asset('assets/videos/Avatar_ The Way of Water _ Official Trailer.mp4') }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                    
                    <div class="overlay">
                        <h1>Thunderbolts</h1>
                        <p>A thrilling Marvel adventure where a team of antiheroes must unite to save the world from a deadly threat. Packed with action and humor!</p>
                        <button class="start-now-btn" onclick="scrollToTrending()">Start Now</button>
                    </div>
                </div>
                <div class="carousel-slide">
                    <video autoplay muted loop playsinline onloadeddata="this.play()" onerror="this.nextElementSibling.style.display='block'; this.style.display='none';">
                        <source src="{{ asset('assets/videos/Avatar_ The Way of Water _ Official Trailer.mp flickering video player4') }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                    <img class="fallback-image" src="https://via.placeholder.com/1920x1080?text=Avatar+Poster" alt="Avatar Fallback">
                    <div class="overlay">
                        <h1>Avatar: The Way of Water</h1>
                        <p>Dive back into Pandora with breathtaking visuals and an epic tale of family, survival, and the power of nature.</p>
                        <button class="start-now-btn" onclick="scrollToTrending()">Start Now</button>
                    </div>
                </div>
                <div class="carousel-slide">
                    <video autoplay muted loop playsinline onloadeddata="this.play()" onerror="this.nextElementSibling.style.display='block'; this.style.display='none';">
                        <source src="{{ asset('assets/videos/Deadpool & Wolverine _ Official Trailer _ In Theaters July 26.mp4') }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                    <img class="fallback-image" src="https://via.placeholder.com/1920x1080?text=Deadpool+Wolverine+Poster" alt="Deadpool & Wolverine Fallback">
                    <div class="overlay">
                        <h1>Deadpool & Wolverine</h1>
                        <p>The Merc with a Mouth teams up with Wolverine in a hilarious, action-packed romp through the multiverse!</p>
                        <button class="start-now-btn" onclick="scrollToTrending()">Start Now</button>
                    </div>
                </div>
                <div class="carousel-nav">
                    <button onclick="prevSlide()">❮</button>
                    <button onclick="nextSlide()">❯</button rejuvenation
                </div>
                <div class="carousel-dots">
                    <span class="carousel-dot active" onclick="goToSlide(0)"></span>
                    <span class="carousel-dot" onclick="goToSlide(1)"></span>
                    <span class="carousel-dot" onclick="goToSlide(2)"></span>
                </div>
            </div>
        </section>

        <section class="navbarStart">
        <!-- Trending Movies Section -->
        <section class="movie-section trending" id="trendingSection">
            <h2>Trending Movies</h2>
            <div class="movie-list" id="trendingMovies"></div>
            <a href="#" class="view-all">View All</a>
        </section>

        <!-- Most Anticipated Movies Section -->
        <section class="movie-section anticipated">
            <h2>Most Anticipated</h2>
            <div class="movie-list" id="anticipatedMovies"></div>
            <a href="#" class="view-all">View All</a>
        </section>

        <!-- Popular Movies Section -->
        <section class="movie-section popular">
            <h2>Popular Movies</h2>
            <div class="movie-list" id="popularMovies"></div>
            <a href="#" class="view-all">View All</a>
        </section>

        <!-- Top Rated Movies Section -->
        <section class="movie-section top-rated">
            <h2>Top Rated Movies</h2>
            <div class="movie-list" id="topRatedMovies"></div>
            <a href="#" class="view-all">View All</a>
        </section>

        <!-- Recently Added Movies Section -->
        <section class="movie-section recently-added">
            <h2>Recently Added</h2>
            <div class="movie-list" id="recentlyAddedMovies"></div>
            <a href="#" class="view-all">View All</a>
        </section>
    </main>

    <!-- Modal for Details -->
    <div id="movieModal" class="modal">
        <div class="modal-content">
            <h3 id="modalTitle"></h3>
            <p id="modalOverview"></p>
            <p id="modalReleaseDate"></p>
            <p id="modalGenres"></p>
            <button class="close-btn" onclick="closeModal()">Close</button>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>© 2025 Trakt.tv. All rights reserved.</p>
        <div class="footer-links">
            <a href="#">Privacy Policy</a>
            <a href="#">Terms of Use</a>
            <a href="#">Support</a>
            <a href="#">API</a>
            <a href="#">Blog</a>
            <a href="#">About Us</a>
            <a href="#">Contact</a>
        </div>
    </footer>
    </section>

    <!-- JavaScript -->
    <script>
        // Navbar scroll behavior
        const navbar = document.querySelector('.navbar');
        const mainSection = document.querySelector('.navbarStart');
        if (navbar && mainSection) {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        // Bawah
                        navbar.style.scale = "1";
                        navbar.style.backgroundColor = "black";
                        console.log("test");
                        
                    } else {
                        // Atas
                        console.log("Test2")
                        navbar.style.scale = "1";
                        navbar.style.backgroundColor = "transparent";
                    }
                });
            }, { threshold: 0.2 });
            observer.observe(mainSection);
        }

        // Data dummy untuk sementara
        const dummyMovies = {
            trending: [
                { id: 1, title: "Thunderbolts", poster: "{{ asset('assets/images/Thunderbolt.jpeg') }}", watching: "695 watching", overview: "A team of antiheroes...", release_date: "2025-07-01" },
                { id: 2, title: "Nonnas", poster: "{{ asset('assets/images/large.jpg') }}", watching: "505 watching", overview: "A family drama...", release_date: "2025-06-15" },
                { id: 3, title: "The Accountant", poster: "{{ asset('assets/images/Thunderbolt.jpeg') }}", watching: "451 watching", overview: "A thriller about a genius...", release_date: "2025-05-20" },
                { id: 4, title: "Drop", poster: "{{ asset('assets/images/large.jpg') }}", watching: "354 watching", overview: "An action-packed drop...", release_date: "2025-08-10" }
            ],
            anticipated: [
                { id: 5, title: "Avatar", poster: "{{ asset('assets/images/Thunderbolt.jpeg') }}", eager: "34.8k eager", overview: "A return to Pandora...", release_date: "2025-12-15" },
                { id: 6, title: "Mission Impossible", poster: "{{ asset('assets/images/Thunderbolt.jpeg') }}", eager: "29.4k eager", overview: "Ethan Hunt's new mission...", release_date: "2025-11-01" },
                { id: 7, title: "Avengers", poster: "{{ asset('assets/images/Thunderbolt.jpeg') }}", eager: "18k eager", overview: "The next Avengers saga...", release_date: "2025-10-20" }
            ],
            popular: [
                { id: 8, title: "Deadpool", poster: "{{ asset('assets/images/Thunderbolt.jpeg') }}", eager: "31.5k eager", overview: "A hilarious antihero...", release_date: "2025-05-10" },
                { id: 9, title: "Interstellar", poster: "{{ asset('assets/images/Thunderbolt.jpeg') }}", eager: "22.8k eager", overview: "A space exploration epic...", release_date: "2025-06-01" },
                { id: 10, title: "Avatar", poster: "{{ asset('assets/images/Thunderbolt.jpeg') }}", eager: "25.3k eager", overview: "Back to Pandora...", release_date: "2025-12-15" }
            ],
            topRated: [
                { id: 11, title: "The Godfather", poster: "{{ asset('assets/images/Thunderbolt.jpeg') }}", rating: "9.2/10", overview: "A mafia masterpiece...", release_date: "2025-01-01" },
                { id: 12, title: "Inception", poster: "{{ asset('assets/images/Thunderbolt.jpeg') }}", rating: "8.8/10", overview: "A mind-bending heist...", release_date: "2025-02-01" }
            ],
            recentlyAdded: [
                { id: 13, title: "Dune: Part Two", poster: "{{ asset('assets/images/Thunderbolt.jpeg') }}", added: "New", overview: "The continuation of Dune...", release_date: "2025-03-01" },
                { id: 14, title: "Oppenheimer", poster: "{{ asset('assets/images/Thunderbolt.jpeg') }}", added: "New", overview: "A historical drama...", release_date: "2025-04-01" }
            ]
        };

        // Carousel Functionality
        let currentSlide = 0;
        const slides = document.querySelectorAll('.carousel-slide');
        const dots = document.querySelectorAll('.carousel-dot');

        function showSlide(index) {
            slides.forEach((slide, i) => {
                slide.classList.remove('active');
                dots[i].classList.remove('active');
                const video = slide.querySelector('video');
                if (video) video.pause();
                const fallback = slide.querySelector('.fallback-image');
                if (fallback) fallback.style.display = 'none';
            });
            slides[index].classList.add('active');
            dots[index].classList.add('active');
            const video = slides[index].querySelector('video');
            const fallback = slides[index].querySelector('.fallback-image');
            if (video && video.readyState >= 1) {
                video.play().catch(() => {
                    if (fallback) fallback.style.display = 'block';
                });
            } else if (fallback) {
                fallback.style.display = 'block';
            }
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

        // Inisialisasi slide pertama
        showSlide(currentSlide);

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
                movieElement.classList.add('movie-card');
                movieElement.innerHTML = `
                    <img src="${movie.poster}" alt="${movie.title}">
                    <div class="movie-info">
                        <h3>${movie.title}</h3>
                        <p>${movie.watching || movie.eager || movie.rating || movie.added || 'N/A'}</p>
                        <div class="actions">
                            <button class="action-btn" onclick="addToWatchlist('${movie.id}')">Add to Watchlist</button>
                            <button class="action-btn" onclick="showMovieDetails(${index}, '${containerId}')">More Info</button>
                        </div>
                    </div>
                `;
                movieElement.addEventListener('click', (e) => {
                    if (!e.target.closest('.action-btn')) {
                        navigateToDesc(movie.id);
                    }
                });
                container.appendChild(movieElement);
                movieElement.style.animationDelay = `${index * 0.1}s`;
            });
        }

        // Fungsi untuk menambahkan ke watchlist (simulasi)
        function addToWatchlist(movieId) {
            alert(`Added movie ID ${movieId} to your watchlist!`);
        }

        // Fungsi untuk menampilkan detail film di modal
        function showMovieDetails(index, containerId) {
            const movies = {
                'trendingMovies': dummyMovies.trending,
                'anticipatedMovies': dummyMovies.anticipated,
                'popularMovies': dummyMovies.popular,
                'topRatedMovies': dummyMovies.topRated,
                'recentlyAddedMovies': dummyMovies.recentlyAdded
            }[containerId.replace('Movies', '')];
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

        // Fungsi pencarian film dengan debounce
        async function searchMovies() {
            const query = document.getElementById('searchInput').value;
            if (query.length < 2) return;
            let movies = [];
            if (query.toLowerCase() === 'trending') movies = dummyMovies.trending;
            else if (query.toLowerCase() === 'anticipated') movies = dummyMovies.anticipated;
            else if (query.toLowerCase() === 'popular') movies = dummyMovies.popular;
            else if (query.toLowerCase() === 'top') movies = dummyMovies.topRated;
            else if (query.toLowerCase() === 'recent') movies = dummyMovies.recentlyAdded;
            else movies = dummyMovies.trending.filter(m => m.title.toLowerCase().includes(query.toLowerCase()));
            displayMovies(movies, 'trendingMovies');
        }

        const debouncedSearch = debounce(() => searchMovies(), 300);

        // Event listener untuk pencarian real-time
        document.getElementById('searchInput').addEventListener('input', debouncedSearch);

        // Scroll reveal untuk movie sections
        function revealSections() {
            const sections = document.querySelectorAll('.movie-section');
            sections.forEach(section => {
                const sectionTop = section.getBoundingClientRect().top;
                const windowHeight = window.innerHeight;
                if (sectionTop < windowHeight * 0.9) {
                    section.classList.add('visible');
                }
            });
        }

        window.addEventListener('scroll', revealSections);

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
</body>
</html>