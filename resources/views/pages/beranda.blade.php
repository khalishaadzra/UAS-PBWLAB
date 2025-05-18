{{-- resources/views/pages/beranda.blade.php --}}
@extends('layouts.layout')

@section('content')
    <style>
        /* --- STYLE DARI KODE PERTAMA (TERHUBUNG DATABASE) --- */
        :root {
            --primary: #2D283E;
            --secondary: #4C495D;
            --accent: #802BB1;
            --text: #D1D7E0;
            --gray: #564F6F;
            --shadow-accent: 0 8px 25px rgba(128, 43, 177, 0.25);
        }
        body {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            min-height: 100vh;
            padding-bottom: 2rem;
            color: var(--text);
            font-family: 'Poppins', sans-serif;
        }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        @keyframes zoomIn { from { transform: scale(0.9); opacity: 0; } to { transform: scale(1); opacity: 1; } }

        /* Styling untuk Movie Card (Konsisten dengan halaman lain) */
        .movie-card {
            position: relative; overflow: hidden; border-radius: 0.75rem;
            transition: transform 0.3s ease, box-shadow 0.3s ease; background-color: var(--secondary);
        }
        .movie-card:hover { transform: translateY(-10px); box-shadow: var(--shadow-accent); }
        .movie-card img.item-poster {
            transition: transform 0.5s ease; height: 24rem;
            width: 100%; object-fit: cover;
        }
        .movie-card:hover img.item-poster { transform: scale(1.05); }
        .movie-card .overlay {
            position: absolute; inset: 0;
            background: linear-gradient(to top, rgba(30, 28, 47, 0.9) 0%, rgba(30, 28, 47, 0.4) 70%, transparent 100%);
            opacity: 0; transition: opacity 0.3s ease-in-out; display: flex;
            justify-content: center; align-items: center; padding: 1rem;
        }
        .movie-card:hover .overlay { opacity: 1; }
        .movie-card .overlay .btn-details {
            padding: 0.6rem 1.2rem; border-radius: 0.5rem;
            transition: background-color 0.3s ease, transform 0.2s ease;
            text-decoration: none; color: white; font-size: 0.9rem;
            text-align: center; border: none; cursor: pointer;
            background-color: var(--accent); font-weight: 500;
        }
        .movie-card .overlay .btn-details:hover { background-color: #6a208e; transform: scale(1.05); }

        /* Styling untuk Section Reveal */
        .movie-section {
            opacity: 0; transform: translateY(20px);
            transition: opacity 0.8s ease, transform 0.8s ease;
        }
        .movie-section.in-view { opacity: 1; transform: translateY(0); }

        /* Area Konten Utama */
        .main-content-area {
            position: relative;
            z-index: 20; /* Pastikan di atas hero jika ada potensi overlap */
            background-color: var(--primary); /* Latar belakang untuk konten setelah hero */
        }

        /* Styling untuk animasi hero dari kode yang berhasil */
        .animate-\[zoomIn_1s_ease-out\] { animation: zoomIn 1s ease-out; }
        .animate-\[fadeIn_1\.5s_ease-out\] { animation: fadeIn 1.5s ease-out; }
        /* Sesuaikan jika class animasi pada kode yang berhasil berbeda */

    </style>

    <!-- HERO SECTION DIAMBIL PERSIS DARI KODE ANDA YANG BERHASIL MENAMPILKAN VIDEO -->
    <section class="hero h-screen relative overflow-hidden z-10">
        <div class="carousel relative w-full h-screen z-1"> {{-- z-1 di sini mungkin tidak masalah --}}
            <!-- Slide 1 -->
            <div class="carousel-slide active absolute top-0 left-0 w-full h-full">
                <video autoplay muted loop playsinline onloadeddata="this.play()" onerror="this.nextElementSibling.style.display='block'; this.style.display='none';" class="w-full h-[155%] object-cover absolute top-[-200px] left-0 -z-10">
                    {{-- PATH VIDEO SEPERTI DI KODE ANDA YANG BERHASIL --}}
                    <source src="{{ asset('tunder.mp4') }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
                {{-- PATH GAMBAR FALLBACK DARI KODE ANDA YANG BERHASIL --}}
                {{-- Jika ingin pakai gambar lokal, ganti src-nya, misal: asset('images/fallback_tunder.jpg') --}}
                <img class="fallback-image w-full h-[155%] object-cover absolute top-[-200px] left-0 -z-10 hidden" src="{{ asset('images/fallback_tunder.jpg') }}" alt="Thunderbolts Fallback" onerror="this.onerror=null;this.src='{{ asset('images/placeholder_hero.jpg') }}';">
                <div class="overlay absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center flex-col text-center px-8">
                    <h1 class="text-5xl md:text-6xl mb-4 text-white font-bold animate-[zoomIn_1s_ease-out]">Thunderbolts</h1>
                    <p class="text-xl max-w-3xl mb-8 text-gray-200 animate-[fadeIn_1.5s_ease-out]">A thrilling Marvel adventure where a team of antiheroes must unite to save the world from a deadly threat. Packed with action and humor!</p>
                    <button class="bg-accent hover:bg-accent/90 text-white px-8 py-4 rounded-md text-xl transition-all duration-300 hover:scale-105 shadow-lg shadow-accent/40" onclick="scrollToSection('trendingSection')">Start Now</button>
                </div>
            </div>

            <!-- Slide 2 -->
            <div class="carousel-slide absolute top-0 left-0 w-full h-full hidden">
                <video autoplay muted loop playsinline onloadeddata="this.play()" onerror="this.nextElementSibling.style.display='block'; this.style.display='none';" class="w-full h-[155%] object-cover absolute top-[-200px] left-0 -z-10">
                    <source src="{{ asset('Avatar_ The Way of Water _ Official Trailer.mp4') }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
                <img class="fallback-image w-full h-[155%] object-cover absolute top-[-200px] left-0 -z-10 hidden" src="{{ asset('images/fallback_avatar.jpg') }}" alt="Avatar Fallback" onerror="this.onerror=null;this.src='{{ asset('images/placeholder_hero.jpg') }}';">
                <div class="overlay absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center flex-col text-center px-8">
                    <h1 class="text-5xl md:text-6xl mb-4 text-white font-bold animate-[zoomIn_1s_ease-out]">Avatar: The Way of Water</h1>
                    <p class="text-xl max-w-3xl mb-8 text-gray-200 animate-[fadeIn_1.5s_ease-out]">Dive back into Pandora with breathtaking visuals and an epic tale of family, survival, and the power of nature.</p>
                    <button class="bg-accent hover:bg-accent/90 text-white px-8 py-4 rounded-md text-xl transition-all duration-300 hover:scale-105 shadow-lg shadow-accent/40" onclick="scrollToSection('trendingSection')">Start Now</button>
                </div>
            </div>

            <!-- Slide 3 -->
            <div class="carousel-slide absolute top-0 left-0 w-full h-full hidden">
                <video autoplay muted loop playsinline onloadeddata="this.play()" onerror="this.nextElementSibling.style.display='block'; this.style.display='none';" class="w-full h-[155%] object-cover absolute top-[-200px] left-0 -z-10">
                    {{-- Perhatikan spasi dan karakter khusus di nama file, pastikan sama persis --}}
                    <source src="{{ asset('Deadpool & Wolverine _ Official Trailer _ In Theaters July 26.mp4') }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
                <img class="fallback-image w-full h-[155%] object-cover absolute top-[-200px] left-0 -z-10 hidden" src="{{ asset('images/fallback_deadpool.jpg') }}" alt="Deadpool & Wolverine Fallback" onerror="this.onerror=null;this.src='{{ asset('images/placeholder_hero.jpg') }}';">
                <div class="overlay absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center flex-col text-center px-8">
                    <h1 class="text-5xl md:text-6xl mb-4 text-white font-bold animate-[zoomIn_1s_ease-out]">Deadpool & Wolverine</h1>
                    <p class="text-xl max-w-3xl mb-8 text-gray-200 animate-[fadeIn_1.5s_ease-out]">The Merc with a Mouth teams up with Wolverine in a hilarious, action-packed romp through the multiverse!</p>
                    <button class="bg-accent hover:bg-accent/90 text-white px-8 py-4 rounded-md text-xl transition-all duration-300 hover:scale-105 shadow-lg shadow-accent/40" onclick="scrollToSection('trendingSection')">Start Now</button>
                </div>
            </div>

            <!-- Navigasi Carousel (dari kode yang berhasil) -->
            <div class="carousel-nav absolute top-1/2 w-full flex justify-between transform -translate-y-1/2 z-20">
                <button onclick="prevSlide()" class="bg-opacity-50 hover:bg-accent ml-4 text-white text-3xl px-4 py-2 rounded-md">❮</button>
                <button onclick="nextSlide()" class="bg-opacity-50 hover:bg-accent mr-4 text-white text-3xl px-4 py-2 rounded-md">❯</button>
            </div>

            <!-- Dot Carousel (dari kode yang berhasil) -->
            <div class="carousel-dots absolute bottom-5 w-full text-center z-20">
                {{-- Class active:bg-accent dari kode Anda, pastikan ini sesuai atau ubah JS untuk dots --}}
                <span class="carousel-dot inline-block w-3 h-3 bg-gray-500 rounded-full mx-1 cursor-pointer active:bg-accent" onclick="goToSlide(0)"></span>
                <span class="carousel-dot inline-block w-3 h-3 bg-gray-500 rounded-full mx-1 cursor-pointer" onclick="goToSlide(1)"></span>
                <span class="carousel-dot inline-block w-3 h-3 bg-gray-500 rounded-full mx-1 cursor-pointer" onclick="goToSlide(2)"></span>
            </div>
        </div>
    </section>
    <!-- AKHIR HERO SECTION DARI KODE YANG BERHASIL -->


    <!-- KONTEN DINAMIS SETELAH HERO -->
    <section class="main-content-area">
        {{-- Class pt-24 dari kode yang berhasil, mungkin untuk memberi jarak dari hero/navbar --}}
        <div class="navbarStart pt-24" id="contentStartAfterHero">
            <!-- Trending Section -->
            <section class="movie-section trending px-6 py-10 md:px-12" id="trendingSection">
                <h2 class="text-3xl md:text-4xl mb-8 text-accent uppercase border-b-2 border-accent inline-block pb-1">Trending Now</h2>
                <div class="movie-list grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6 md:gap-8 pb-8" id="trendingItemsGrid"></div>
                {{-- Link View All jika diperlukan, sesuaikan href --}}
                {{-- <a href="#" class="text-accent hover:text-white text-xl transition-colors duration-300 inline-block mt-4">View All</a> --}}
            </section>

            <!-- Most Anticipated Section -->
            <section class="movie-section most-anticipated px-6 py-10 md:px-12" id="mostItemsSection">
                <h2 class="text-3xl md:text-4xl mb-8 text-accent uppercase border-b-2 border-accent inline-block pb-1">Most Anticipated</h2>
                <div class="movie-list grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6 md:gap-8 pb-8" id="mostItemsGrid"></div>
            </section>

            <!-- Popular Section -->
            <section class="movie-section popular px-6 py-10 md:px-12" id="popularSection">
                <h2 class="text-3xl md:text-4xl mb-8 text-accent uppercase border-b-2 border-accent inline-block pb-1">Popular</h2>
                <div class="movie-list grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6 md:gap-8 pb-8" id="popularItemsGrid"></div>
            </section>

            <!-- Top Rated Section -->
            <section class="movie-section top-rated px-6 py-10 md:px-12" id="topRatedSection">
                <h2 class="text-3xl md:text-4xl mb-8 text-accent uppercase border-b-2 border-accent inline-block pb-1">Top Rated</h2>
                <div class="movie-list grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6 md:gap-8 pb-8" id="topRatedItemsGrid"></div>
            </section>
        </div>
    </section>
    <!-- AKHIR KONTEN DINAMIS -->


    <script>
    // --- JAVASCRIPT UNTUK KONTEN DINAMIS & FITUR LAIN ---
    const placeholderPoster = "{{ asset('images/poster_placeholder.png') }}";

    // Data dari PHP untuk konten dinamis
    const trendingItemsData = @json(isset($trendingItems) ? $trendingItems->all() : []);
    const mostItemsData = @json(isset($mostItems) ? $mostItems->all() : []);
    const popularItemsData = @json(isset($popularItems) ? $popularItems->all() : []);
    const topRatedItemsData = @json(isset($topRatedItems) ? $topRatedItems->all() : []);

    // --- Carousel Functionality (Adaptasi dari kode yang berhasil) ---
    let currentSlide = 0;
    const slides = document.querySelectorAll('.carousel-slide'); // Elemen dari Hero Section HTML di atas
    const dots = document.querySelectorAll('.carousel-dot');     // Elemen dari Hero Section HTML di atas
    const carouselNavButtons = document.querySelector('.carousel-nav'); // Navigasi prev/next

    function updateCarouselIndicators() {
        if (dots.length === 0 || slides.length === 0) return;
        dots.forEach((dot, i) => {
            // Sesuaikan dengan cara styling dot aktif di kode yang berhasil
            // Kode Anda menggunakan `active:bg-accent` pada HTML dot,
            // yang berarti state :active dari CSS. JavaScript perlu mengelola class aktual.
            dot.classList.remove('bg-accent'); // Hapus styling aktif
            dot.classList.add('bg-gray-500');  // Set ke styling non-aktif (sesuai HTML Anda)
            if (i === currentSlide) {
                dot.classList.remove('bg-gray-500');
                dot.classList.add('bg-accent'); // Tambah styling aktif
            }
        });
    }

    function showSlide(index) {
        if (slides.length === 0 || index < 0 || index >= slides.length) return;

        slides.forEach((slide, i) => {
            const video = slide.querySelector('video');
            if (i === index) {
                slide.classList.remove('hidden');
                // 'active' class mungkin tidak diperlukan jika hanya mengandalkan 'hidden'
                // slide.classList.add('active', 'block');
                slide.classList.add('block');
                if (video) {
                    video.currentTime = 0;
                    video.play().catch(e => {
                        const fallbackImg = slide.querySelector('.fallback-image');
                        if (fallbackImg) fallbackImg.style.display = 'block';
                        if (video) video.style.display = 'none';
                    });
                }
            } else {
                slide.classList.add('hidden');
                // slide.classList.remove('active', 'block');
                slide.classList.remove('block');
                if (video) video.pause();
            }
        });
        currentSlide = index;
        updateCarouselIndicators();
    }

    function nextSlide() {
        if (slides.length === 0) return;
        currentSlide = (currentSlide + 1) % slides.length; // Koreksi dari kode yang berhasil
        showSlide(currentSlide);
    }

    function prevSlide() {
        if (slides.length === 0) return;
        currentSlide = (currentSlide - 1 + slides.length) % slides.length; // Koreksi dari kode yang berhasil
        showSlide(currentSlide);
    }

    function goToSlide(index) {
        if (slides.length === 0 || index < 0 || index >= slides.length) return;
        showSlide(index); // Koreksi dari kode yang berhasil
    }

    let carouselInterval;
    function startCarousel() {
        if (slides.length > 1) {
            carouselInterval = setInterval(nextSlide, 8000);
            if (carouselNavButtons) carouselNavButtons.style.display = 'flex';
        } else {
            if (carouselNavButtons) carouselNavButtons.style.display = 'none';
        }
    }
    // --- Akhir Carousel Functionality ---


    // --- Fungsi untuk menampilkan item dinamis ---
    function displayItems(items, containerId) {
        const container = document.getElementById(containerId);
        // Sesuaikan selector jika ID section berbeda, misal 'trendingSection' untuk 'trendingItemsGrid'
        const sectionElement = container ? container.closest('.movie-section') : document.getElementById(containerId.replace('ItemsGrid','Section').replace('Movies','Section'));


        if (!items || items.length === 0) {
            if(sectionElement) sectionElement.style.display = 'none';
            if (container) container.innerHTML = '';
            return;
        }
        if (!container) {
            // console.warn(`Container with ID ${containerId} not found.`);
            if(sectionElement) sectionElement.style.display = 'none';
            return;
        }

        if(sectionElement) sectionElement.style.display = 'block';
        container.innerHTML = '';

        items.forEach(item => {
            const itemElement = document.createElement('div');
            itemElement.className = 'movie-card animate-fadeIn';
            const poster = item.poster_url ? item.poster_url : placeholderPoster;
            const detailPageUrl = `{{ url('movies') }}/${item.id}`;

            itemElement.innerHTML = `
                <div class="relative">
                    <img src="${poster}" alt="${item.title || 'Poster Film'}" class="item-poster" onerror="this.onerror=null;this.src='${placeholderPoster}';">
                    <div class="overlay">
                        <a href="${detailPageUrl}" class="btn-details">Details</a>
                    </div>
                </div>
                <div class="p-3 text-center">
                    <h3 class="text-lg font-bold text-white mb-1 truncate" title="${item.title || 'Judul Tidak Tersedia'}">${item.title || 'Judul Tidak Tersedia'}</h3>
                    <p class="text-sm text-gray-400 truncate" title="${item.sutradara || ''}">${item.sutradara ? 'Sutradara: ' + item.sutradara : ''}</p>
                    <p class="text-xs text-gray-400">${item.tahun_rilis ? 'Tahun: ' + item.tahun_rilis : 'N/A'}</p>
                </div>
            `;
            container.appendChild(itemElement);
        });
    }
    // --- Akhir Fungsi Item Dinamis ---


    // --- Scroll Reveal & Scroll To Section ---
    const sectionsToReveal = document.querySelectorAll('.movie-section'); // Elemen dari konten dinamis
    function revealSections() {
        sectionsToReveal.forEach(section => {
            if(!section || section.style.display === 'none') return;
            const sectionTop = section.getBoundingClientRect().top;
            const windowHeight = window.innerHeight;
            if (sectionTop < windowHeight * 0.85) { // Ambil dari kode pertama
                section.classList.add('in-view');
            }
            // Jika menggunakan class opacity dari kode yang berhasil:
            // if (sectionTop < windowHeight * 0.9) {
            //     section.classList.add('opacity-100');
            //     section.classList.remove('opacity-0', 'translate-y-12');
            // }
        });
    }

    function scrollToSection(sectionId) { // Diubah menjadi scrollToSection dari scrollToTrending
        const section = document.getElementById(sectionId);
        if(section) {
            if (section.style.display === 'none') {
                const firstVisibleContentSection = Array.from(document.querySelectorAll('.main-content-area .movie-section')).find(s => s.style.display !== 'none');
                if (firstVisibleContentSection) {
                    firstVisibleContentSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
                return;
            }
            section.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    }
    // --- Akhir Scroll Reveal & Scroll To ---


    // --- DOMContentLoaded ---
    document.addEventListener('DOMContentLoaded', () => {
        // Inisialisasi Carousel Hero
        if (slides.length > 0) {
            showSlide(0); // Harus dipanggil agar dot pertama aktif
            startCarousel();
        }

        // Tampilkan item dinamis
        // Ganti ID container jika berbeda dari kode pertama
        displayItems(trendingItemsData, 'trendingItemsGrid'); // Sebelumnya 'trendingMovies'
        displayItems(mostItemsData, 'mostItemsGrid');       // Sebelumnya 'anticipatedMovies'
        displayItems(popularItemsData, 'popularItemsGrid');     // Sebelumnya 'popularMovies'
        displayItems(topRatedItemsData, 'topRatedItemsGrid');   // Sebelumnya 'topRatedMovies'
        // Jika ada 'recentlyAddedMovies', tambahkan panggilannya

        // Inisialisasi scroll reveal
        revealSections();
        window.addEventListener('scroll', revealSections);
        window.addEventListener('resize', revealSections);

        // Navbar scroll behavior
        const navbar = document.querySelector('#navbar'); // Pastikan ID navbar benar
        const heroSection = document.querySelector('.hero');
        let heroHeight = heroSection ? heroSection.offsetHeight : 0;

        if (navbar && heroSection) {
            const handleNavbarScroll = () => {
                heroHeight = heroSection.offsetHeight;
                // Ambil logika dari kode yang berhasil (scrollY > 800) atau sesuaikan
                if (window.scrollY > (heroHeight > 800 ? 800 : heroHeight - (navbar.offsetHeight || 70) * 1.5) && heroHeight > 0) {
                    navbar.classList.remove('bg-transparent');
                    navbar.classList.add('bg-primary', 'bg-opacity-80', 'backdrop-blur-md', 'shadow-md'); // Sesuaikan kelas
                } else {
                    navbar.classList.add('bg-transparent');
                    navbar.classList.remove('bg-primary', 'bg-opacity-80', 'backdrop-blur-md', 'shadow-md');
                }
            };
            window.addEventListener('scroll', handleNavbarScroll);
            window.addEventListener('resize', () => {
                heroHeight = heroSection.offsetHeight;
                handleNavbarScroll();
            });
            handleNavbarScroll();
        }
    });
    // --- Akhir DOMContentLoaded ---
    </script>
@endsection