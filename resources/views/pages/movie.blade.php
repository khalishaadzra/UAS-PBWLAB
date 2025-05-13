@extends('layouts.layout')

@section('content')
    <style>
        body {
            top: 70px; /* Maintained as requested */
            position: relative; /* Ensure top works with relative positioning */
            background: linear-gradient(135deg, #2D283E 0%, #4C495D 100%);
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        @keyframes slideIn {
            from { transform: translateY(20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        @keyframes zoomIn {
            from { transform: scale(0.9); opacity: 0; }
            to { transform: scale(1); opacity: 1; }
        }
        .animate-fadeIn { animation: fadeIn 1s ease-out; }
        .animate-slideIn { animation: slideIn 0.8s ease-out; }
        .animate-zoomIn { animation: zoomIn 0.5s ease-out; }

        :root {
            --primary: #2D283E;
            --secondary: #4C495D;
            --accent: #802BB1;
            --text: #D1D7E0;
            --gray: #564F6F;
            --gray-200: #E5E7EB;
            --gray-300: #D1D5DB;
            --gray-400: #9CA3AF;
            --black: #000000;
        }
        .bg-primary { background-color: var(--primary); }
        .bg-secondary { background-color: var(--secondary); }
        .bg-accent { background-color: var(--accent); }
        .text-accent { color: var(--accent); }
        .text-white { color: var(--text); }
        .text-gray-200 { color: var(--gray-200); }
        .text-gray-300 { color: var(--gray-300); }
        .text-gray-400 { color: var(--gray-400); }
        .bg-black { background-color: var(--black); }
        .border-accent { border-color: var(--accent); }
        .shadow-accent { box-shadow: 0 4px 6px rgba(128, 43, 177, 0.3); }
        .hover\:shadow-accent:hover { box-shadow: 0 6px 12px rgba(128, 43, 177, 0.5); }

        /* Scroll Progress Bar */
        .scroll-progress {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: var(--gray);
            z-index: 1000;
        }
        .scroll-progress-bar {
            height: 100%;
            background: var(--accent);
            width: 0;
            transition: width 0.1s linear;
        }

        /* Hero Section */
        .hero {
            position: relative;
            overflow: hidden;
            height: 50vh;
            margin-top: -70px; /* Offset body top */
        }
        .hero-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(45, 40, 62, 0.8), transparent);
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 2rem;
        }
        .hero h1 {
            font-size: 3rem;
            font-weight: bold;
            color: var(--text);
            text-transform: uppercase;
            animation: zoomIn 1s ease-out;
        }

        /* Serial Card Styling */
        .serial-card {
            position: relative;
            overflow: hidden;
            border-radius: 0.75rem;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .serial-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-accent);
        }
        .serial-card img {
            transition: transform 0.5s ease;
            height: 300px;
            object-fit: cover;
        }
        .serial-card:hover img {
            transform: scale(1.1);
        }
        .serial-card .overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(45, 40, 62, 0.7), transparent);
            opacity: 0;
            transition: opacity 0.3s ease;
            display: flex;
            align-items: flex-end;
            padding: 1.5rem;
        }
        .serial-card:hover .overlay {
            opacity: 1;
        }
        .serial-card .overlay button {
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            transition: background-color 0.3s ease;
        }

        /* Section Transitions */
        .section {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.8s ease, transform 0.8s ease;
        }
        .section.in-view {
            opacity: 1;
            transform: translateY(0);
        }
    </style>

    <!-- Scroll Progress Bar -->
    <div class="scroll-progress">
        <div class="scroll-progress-bar" id="scrollProgressBar"></div>
    </div>

    <!-- Hero Section -->
    <section class="hero bg-primary">
        <div class="hero-overlay">
            <h1 class="animate-zoomIn">Movies</h1>
        </div>
    </section>

    <!-- Serials Grid Section -->
    <section class="py-12 px-6 md:px-12 relative z-20 section" id="serialSection">
        <h2 class="text-4xl mb-8 text-accent uppercase border-b-2 border-accent inline-block pb-1 animate-fadeIn">Latest Serials</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8" id="serialGrid">
            <!-- Serial cards will be dynamically added here -->
        </div>
        <a href="#" class="text-accent hover:text-white text-xl transition-colors duration-300 inline-block mt-4 animate-fadeIn">View All</a>
    </section>

    <!-- Modal for Details -->
    <div id="serialModal" class="fixed top-0 left-0 w-full h-full bg-black bg-opacity-90 z-50 hidden justify-center items-center" role="dialog" aria-modal="true">
        <div class="bg-primary p-8 rounded-xl max-w-lg text-center shadow-2xl animate-slideIn">
            <button class="absolute top-4 right-4 text-gray-400 hover:text-accent transition-colors duration-300" onclick="closeModal()">✕</button>
            <h3 id="modalTitle" class="text-3xl mb-4 text-white font-bold"></h3>
            <p id="modalOverview" class="mb-6 text-gray-300"></p>
            <p id="modalReleaseDate" class="mb-2 text-gray-400"></p>
            <p id="modalGenres" class="mb-6 text-gray-400"></p>
            <button class="bg-accent hover:bg-accent/90 text-white px-6 py-3 rounded-md transition-colors duration-300" onclick="closeModal()">Close</button>
        </div>
    </div>

    <!-- Back to Top Button -->
    <button id="backToTop" class="fixed bottom-4 right-4 bg-accent text-white p-3 rounded-full hidden transition-opacity duration-300 shadow-accent hover:shadow-accent" onclick="window.scrollTo({ top: 0, behavior: 'smooth' })">
        ↑
    </button>

    <!-- JavaScript -->
    <script>
        // Dummy data for serials
        const dummySerials = [
            { id: 1, title: "Galactic Rebels", poster: "{{ asset('Thunderbolt.jpeg') }}", overview: "A group of rebels fights the empire with lightsabers.", release_date: "2025-05-01" },
            { id: 2, title: "Force Chronicles", poster: "{{ asset('large.jpg') }}", overview: "Epic battles across the galaxy.", release_date: "2025-06-01" },
            { id: 3, title: "Sith Rising", poster: "{{ asset('Thunderbolt.jpeg') }}", overview: "The dark side gains power.", release_date: "2025-07-01" },
            { id: 4, title: "Jedi Legacy", poster: "{{ asset('large.jpg') }}", overview: "The next generation of Jedi.", release_date: "2025-08-01" },
            { id: 5, title: "Empire Strikes Back", poster: "{{ asset('Thunderbolt.jpeg') }}", overview: "The empire's counterattack.", release_date: "2025-09-01" },
            { id: 6, title: "New Hope Saga", poster: "{{ asset('large.jpg') }}", overview: "A new hope emerges.", release_date: "2025-10-01" },
            { id: 7, title: "Dark Force", poster: "{{ asset('Thunderbolt.jpeg') }}", overview: "Dark forces threaten peace.", release_date: "2025-11-01" },
            { id: 8, title: "Star Commanders", poster: "{{ asset('large.jpg') }}", overview: "Commanders lead the resistance.", release_date: "2025-12-01" }
        ];

        // Display Serials
        function displaySerials(serials) {
            const container = document.getElementById('serialGrid');
            container.innerHTML = '';
            serials.forEach((serial, index) => {
                const serialElement = document.createElement('div');
                serialElement.classList.add('serial-card', 'bg-secondary', 'rounded-xl', 'overflow-hidden', 'shadow-lg', 'cursor-pointer');
                serialElement.innerHTML = `
                    <div class="relative">
                        <img src="${serial.poster}" alt="${serial.title}" class="w-full">
                        <div class="overlay">
                            <div class="flex space-x-2">
                                <button class="bg-secondary/70 hover:bg-secondary text-white px-2 py-1 rounded text-sm" onclick="showSerialDetails(${index})">Details</button>
                                <button class="bg-gray-400 hover:bg-gray-400/80 px-2 py-1 rounded text-sm text-white" onclick="addToWatchlist(${serial.id})">Watchlist</button>
                            </div>
                        </div>
                    </div>
                    <div class="p-4 text-center">
                        <h3 class="text-lg font-bold text-white mb-1 truncate">${serial.title}</h3>
                    </div>
                `;
                serialElement.addEventListener('click', (e) => {
                    if (!e.target.closest('button')) navigateToDesc(serial.id);
                });
                container.appendChild(serialElement);
            });
        }

        // Add to Watchlist (Simulated)
        function addToWatchlist(serialId) {
            const serial = dummySerials.find(s => s.id === serialId);
            const toast = document.createElement('div');
            toast.classList.add('fixed', 'bottom-4', 'right-4', 'bg-accent', 'text-white', 'px-4', 'py-2', 'rounded-md', 'shadow-lg', 'animate-fadeIn');
            toast.textContent = `${serial.title} added to your watchlist!`;
            document.body.appendChild(toast);
            setTimeout(() => toast.remove(), 3000);
        }

        // Show Serial Details in Modal
        function showSerialDetails(index) {
            const serial = dummySerials[index];
            document.getElementById('modalTitle').textContent = serial.title;
            document.getElementById('modalOverview').textContent = serial.overview || 'No overview available.';
            document.getElementById('modalReleaseDate').textContent = `Release Date: ${serial.release_date || 'N/A'}`;
            document.getElementById('modalGenres').textContent = `Genres: ${['Action', 'Sci-Fi', 'Adventure'][Math.floor(Math.random() * 3)] || 'Unknown'}`;
            document.getElementById('serialModal').style.display = 'flex';
        }

        // Close Modal
        function closeModal() {
            const modal = document.getElementById('serialModal');
            modal.classList.add('animate-zoomOut');
            setTimeout(() => {
                modal.style.display = 'none';
                modal.classList.remove('animate-zoomOut');
            }, 400);
        }

        // Navigate to Description Page
        function navigateToDesc(serialId) {
            window.location.href = `serial-desc.html?id=${serialId}`;
        }

        // Scroll Progress Bar
        window.addEventListener('scroll', () => {
            const scrollTop = window.scrollY;
            const docHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
            const scrollPercent = (scrollTop / docHeight) * 100;
            document.getElementById('scrollProgressBar').style.width = scrollPercent + '%';
        });

        // Section Reveal
        function revealSections() {
            const sections = document.querySelectorAll('.section');
            sections.forEach(section => {
                const sectionTop = section.getBoundingClientRect().top;
                const windowHeight = window.innerHeight;
                if (sectionTop < windowHeight * 0.9) {
                    section.classList.add('in-view');
                }
            });
        }

        // Back to Top Button
        window.addEventListener('scroll', function() {
            const backToTop = document.getElementById('backToTop');
            if (window.scrollY > 300) backToTop.classList.remove('hidden');
            else backToTop.classList.add('hidden');
            revealSections();
        });

        // Initialize Page
        document.addEventListener('DOMContentLoaded', () => {
            displaySerials(dummySerials);
            revealSections();
        });

        // Close modal on outside click or Escape key
        window.addEventListener('click', function(event) {
            const modal = document.getElementById('serialModal');
            if (event.target === modal) closeModal();
        });
        window.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') closeModal();
        });
    </script>
@endsection