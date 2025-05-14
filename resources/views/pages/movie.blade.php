@extends('layouts.layout')

@section('content')
    <style>
        body {
            top: 70px;
            position: relative;
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
        @keyframes zoomOut {
            from { transform: scale(1); opacity: 1; }
            to { transform: scale(0.9); opacity: 0; }
        }
        .animate-fadeIn { animation: fadeIn 1s ease-out; }
        .animate-slideIn { animation: slideIn 0.8s ease-out; }
        .animate-zoomOut { animation: zoomOut 0.4s ease-out; }

        :root {
            --primary: #2D283E;
            --secondary: #4C495D;
            --accent: #802BB1;
            --text: #D1D7E0;
            --gray: #564F6F;
        }

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

    <!-- Serials Grid Section -->
    <section class="py-12 px-6 md:px-12 relative z-20 section" id="serialSection">
        <div class="mb-8 border-b-2 border-accent inline-block pb-1 animate-fadeIn"></div>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8" id="serialGrid">
            <!-- Serial cards will be dynamically added here -->
        </div>
        <a href="#" class="text-accent hover:text-white text-xl transition-colors duration-300 inline-block mt-4 animate-fadeIn">View All</a>
    </section>

    <!-- Modal for Details -->
    <div id="serialModal" class="fixed top-0 left-0 w-full h-full bg-black bg-opacity-90 z-50 hidden justify-center items-center" role="dialog" aria-modal="true" style="top: 70px;">
        <div class="bg-primary p-8 rounded-xl max-w-lg text-center shadow-2xl animate-slideIn">
            <button class="absolute top-4 right-4 text-gray hover:text-accent transition-colors duration-300" onclick="closeModal()">✕</button>
            <h3 id="modalTitle" class="text-3xl mb-4 text-white font-bold"></h3>
            <p id="modalOverview" class="mb-6 text-gray"></p>
            <p id="modalReleaseDate" class="mb-6 text-gray"></p>
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
                            <button class="bg-secondary/70 hover:bg-secondary text-white px-2 py-1 rounded text-sm" onclick="showSerialDetails(${index})">Details</button>
                        </div>
                    </div>
                    <div class="p-4 text-center">
                        <h3 class="text-lg font-bold text-white mb-1 truncate">${serial.title}</h3>
                    </div>
                `;
                container.appendChild(serialElement);
            });
        }

        // Show Serial Details in Modal
        function showSerialDetails(index) {
            const serial = dummySerials[index];
            document.getElementById('modalTitle').textContent = serial.title;
            document.getElementById('modalOverview').textContent = serial.overview || 'No overview available.';
            document.getElementById('modalReleaseDate').textContent = `Release Date: ${serial.release_date || 'N/A'}`;
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