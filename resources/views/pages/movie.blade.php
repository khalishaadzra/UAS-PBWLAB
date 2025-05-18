{{-- resources/views/pages/movie.blade.php --}}
@extends('layouts.layout')

@section('content')
    <style>
        body {
            top: 70px; /* Sesuaikan jika header Anda memiliki tinggi berbeda atau tidak fixed */
            position: relative;
            background: linear-gradient(135deg, #2D283E 0%, #4C495D 100%);
            min-height: calc(100vh - 70px); /* Memastikan background full height */
            padding-bottom: 2rem; /* Memberi ruang di bawah */
            color: var(--text, #D1D7E0); /* Default text color */
        }

        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        @keyframes slideIn { from { transform: translateY(20px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }
        @keyframes zoomOut { from { transform: scale(1); opacity: 1; } to { transform: scale(0.9); opacity: 0; } }
        .animate-fadeIn { animation: fadeIn 1s ease-out; }
        .animate-slideIn { animation: slideIn 0.8s ease-out; } /* Untuk modal */
        .animate-zoomOut { animation: zoomOut 0.4s ease-out; } /* Untuk modal */

        :root {
            --primary: #2D283E;
            --secondary: #4C495D;
            --accent: #802BB1; /* Warna ungu dari desain Anda sebelumnya */
            --text: #D1D7E0;
            --gray: #564F6F;
            --shadow-accent: 0 8px 25px rgba(128, 43, 177, 0.25);
        }

        /* Scroll Progress Bar */
        .scroll-progress {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: var(--gray);
            z-index: 1050;
        }
        .scroll-progress-bar {
            height: 100%;
            background: var(--accent);
            width: 0;
            transition: width 0.1s linear;
        }

        /* Movie Card Styling */
        .movie-card {
            position: relative;
            overflow: hidden;
            border-radius: 0.75rem; /* 12px */
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            background-color: var(--secondary);
        }
        .movie-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-accent);
        }
        .movie-card img.movie-poster { /* Tambah class spesifik untuk poster di kartu */
            transition: transform 0.5s ease;
            height: 24rem; /* 384px, atau sesuaikan (misal h-96) */
            width: 100%;
            object-fit: cover;
        }
        .movie-card:hover img.movie-poster {
            transform: scale(1.05); /* Sedikit lebih kecil skala hovernya */
        }
        .movie-card .overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(30, 28, 47, 0.9) 0%, rgba(30, 28, 47, 0.4) 70%, transparent 100%);
            opacity: 0;
            transition: opacity 0.3s ease-in-out;
            display: flex;
            justify-content: center; /* Pusatkan tombol */
            align-items: center;    /* Pusatkan tombol */
            padding: 1rem;
        }
        .movie-card:hover .overlay {
            opacity: 1;
        }
        .movie-card .overlay .btn-details {
            padding: 0.6rem 1.2rem; /* Sesuaikan padding tombol */
            border-radius: 0.5rem; /* 8px */
            transition: background-color 0.3s ease, transform 0.2s ease;
            text-decoration: none;
            color: white;
            font-size: 0.9rem; /* Ukuran font tombol */
            text-align: center;
            border: none;
            cursor: pointer;
            background-color: var(--accent);
            font-weight: 500;
        }
        .movie-card .overlay .btn-details:hover {
            background-color: #6a208e; /* Accent lebih gelap */
            transform: scale(1.05);
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
        .alert-success {
            background-color: #28a745; color: white; padding: 1rem;
            border-radius: 0.375rem; margin-bottom: 1.5rem; text-align: center;
        }
        .no-movies-message {
            color: var(--text); grid-column: 1 / -1; text-align: center;
            font-size: 1.25rem; padding: 2rem 0;
        }
        /* Modal Styling (jika masih ingin digunakan untuk hal lain) */
        #movieModal img { object-fit: cover; } /* Pastikan poster di modal juga cover */
    </style>

    <!-- Scroll Progress Bar -->
    <div class="scroll-progress">
        <div class="scroll-progress-bar" id="scrollProgressBar"></div>
    </div>

    <!-- Movies Grid Section -->
    <section class="py-12 px-6 md:px-12 relative z-20 section" id="movieSection">
        <div class="flex flex-wrap justify-between items-center mb-8 gap-4">
            <div class="border-b-2 border-accent inline-block pb-1 animate-fadeIn">
                <h2 class="text-3xl font-bold text-white">Daftar Film</h2>
            </div>
            {{-- Tombol "Tambah Film Baru" sudah dihilangkan --}}
        </div>

        @if (session('success'))
            <div class="alert-success animate-fadeIn">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6 md:gap-8" id="movieGrid">
            {{-- Kartu film akan di-generate oleh JavaScript --}}
            {{-- Pesan ini akan ditampilkan oleh Blade jika $movies kosong saat render awal --}}
            @if ($movies->isEmpty())
                <p class="no-movies-message">Belum ada film yang ditambahkan.</p>
            @endif
        </div>
        {{-- Jika menggunakan paginasi, tampilkan link paginasi --}}
        @if ($movies->hasPages()) {{-- Cek apakah ada lebih dari 1 halaman --}}
            <div class="mt-8">
                {{ $movies->links() }} {{-- Ini akan menggunakan view paginasi default Laravel/Tailwind --}}
            </div>
        @endif
    </section>

    {{-- Modal for Details (Disimpan jika ada kegunaan lain, tapi tidak dipanggil dari kartu film utama lagi) --}}
    <div id="movieModal" class="fixed inset-0 bg-black bg-opacity-80 z-[1060] hidden justify-center items-center p-4" role="dialog" aria-modal="true" style="top: 0;">
        <div class="bg-primary p-6 md:p-8 rounded-xl max-w-md w-full text-left shadow-2xl animate-slideIn relative">
            <button class="absolute top-3 right-3 text-gray-400 hover:text-accent transition-colors duration-300 text-2xl leading-none" onclick="closeModal()">✕</button>
            <div class="flex flex-col md:flex-row gap-4 md:gap-6 mb-4">
                <img id="modalPoster" src="" alt="Movie Poster" class="w-full md:w-1/3 h-auto rounded-md self-start md:self-center">
                <div class="flex-1">
                    <h3 id="modalTitle" class="text-2xl md:text-3xl mb-2 text-white font-bold"></h3>
                    <p id="modalDirector" class="text-md mb-1 text-text"></p>
                    <p id="modalYear" class="text-sm mb-1 text-text"></p>
                    <p id="modalGenre" class="text-sm mb-3 text-text"></p>
                </div>
            </div>
            <p id="modalOverview" class="text-sm mb-6 text-gray-300 leading-relaxed"></p>
            <div class="text-right">
                <button class="bg-accent hover:bg-accent/90 text-white px-5 py-2.5 rounded-md transition-colors duration-300" onclick="closeModal()">Close</button>
            </div>
        </div>
    </div>

    <!-- Back to Top Button -->
    <button id="backToTop" class="fixed bottom-6 right-6 bg-accent text-white p-3 rounded-full hidden opacity-0 transition-opacity duration-300 shadow-lg hover:bg-accent/90 z-[1040]" onclick="window.scrollTo({ top: 0, behavior: 'smooth' })">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 19V5M5 12l7-7 7 7"/></svg>
    </button>

    <script>
        // PASTIKAN PATH INI BENAR dan file gambar ada di public/images/
        const placeholderPoster = "{{ asset('images/poster_placeholder.png') }}";

        // Ambil data movies dari Blade
        // Jika Anda menggunakan paginasi di controller ($movies = Movie::paginate(15);)
        const moviesData = @json($movies->items());
        // Jika Anda TIDAK menggunakan paginasi ($movies = Movie::get(); atau Movie::all();)
        // const moviesData = @json($movies);

        function displayMovies(movies) {
            const container = document.getElementById('movieGrid');
            if (!container) {
                console.error('Element dengan ID "movieGrid" tidak ditemukan.');
                return;
            }
            container.innerHTML = ''; // Kosongkan container untuk mencegah duplikasi jika dipanggil ulang

            // Hapus pesan "Belum ada film" dari Blade jika ada dan movies tidak kosong
            const bladeNoMovieMsg = container.parentElement.querySelector('p.no-movies-message');
            if (movies.length > 0 && bladeNoMovieMsg) {
                bladeNoMovieMsg.remove();
            }

            if (movies.length === 0) {
                // Jika pesan dari Blade sudah dihapus (atau tidak ada) dan movies tetap kosong, tambahkan dari JS
                if (!bladeNoMovieMsg || (bladeNoMovieMsg && !bladeNoMovieMsg.parentNode)) {
                    const p = document.createElement('p');
                    p.className = 'no-movies-message';
                    p.textContent = 'Belum ada film yang dapat ditampilkan saat ini.';
                    container.appendChild(p);
                }
                return;
            }

            movies.forEach(movie => {
                const movieElement = document.createElement('div');
                movieElement.className = 'movie-card animate-fadeIn';

                // Langsung gunakan movie.poster_url jika ada (ini adalah URL internet lengkap)
                // Jika tidak ada, gunakan placeholderPoster
                const posterUrl = movie.poster_url ? movie.poster_url : placeholderPoster;

                const detailUrl = `{{ url('movies') }}/${movie.id}`; // URL ke halaman detail

                movieElement.innerHTML = `
                    <div class="relative">
                        <img src="${posterUrl}" alt="${movie.title || 'Poster Film'}" class="movie-poster" onerror="this.onerror=null; this.src='${placeholderPoster}';">
                        <div class="overlay">
                            <a href="${detailUrl}" class="btn-details">Details</a>
                        </div>
                    </div>
                    <div class="p-3 text-center">
                        <h3 class="text-lg font-bold text-white mb-1 truncate" title="${movie.title || 'Judul Tidak Tersedia'}">${movie.title || 'Judul Tidak Tersedia'}</h3>
                        <p class="text-sm text-gray-400 truncate" title="${movie.sutradara || ''}">${movie.sutradara ? 'Sutradara: ' + movie.sutradara : 'Sutradara: N/A'}</p>
                        <p class="text-xs text-gray-400">${movie.tahun_rilis ? 'Tahun: ' + movie.tahun_rilis : 'Tahun: N/A'}</p>
                    </div>
                `;
                container.appendChild(movieElement);
            });
        }

        // Fungsi showMovieDetails dan closeModal (untuk modal)
        // Tidak lagi dipanggil oleh kartu film utama, tapi bisa disimpan jika ada kegunaan lain
        function showMovieDetails(movieId) {
            const movie = moviesData.find(m => m.id === parseInt(movieId));
            if (!movie) { console.warn('Movie not found for ID:', movieId); return; }

            const modal = document.getElementById('movieModal');
            if(!modal) { console.warn('Modal element not found'); return; }

            const posterUrl = movie.poster_url ? movie.poster_url : placeholderPoster; // Gunakan logika yang sama
            const modalPosterEl = modal.querySelector('#modalPoster');
            if(modalPosterEl) {
                modalPosterEl.src = posterUrl;
                modalPosterEl.alt = (movie.title || 'N/A') + " Poster";
            }

            const modalTitleEl = modal.querySelector('#modalTitle');
            if(modalTitleEl) modalTitleEl.textContent = movie.title || 'N/A';

            const modalOverviewEl = modal.querySelector('#modalOverview');
            if(modalOverviewEl) modalOverviewEl.textContent = movie.sinopsis || movie.description || 'Tidak ada deskripsi.';

            const modalDirectorEl = modal.querySelector('#modalDirector');
            if(modalDirectorEl) modalDirectorEl.textContent = `Sutradara: ${movie.sutradara || 'N/A'}`;

            const modalYearEl = modal.querySelector('#modalYear');
            if(modalYearEl) modalYearEl.textContent = `Tahun: ${movie.tahun_rilis || 'N/A'}`;

            const modalGenreEl = modal.querySelector('#modalGenre');
            if(modalGenreEl) modalGenreEl.textContent = `Genre: ${movie.genre || 'N/A'}`;

            modal.style.display = 'flex';

            const modalContent = modal.querySelector('.bg-primary');
            if(modalContent){
                 modalContent.classList.remove('animate-zoomOut');
                 modalContent.classList.add('animate-slideIn');
            }
        }

        function closeModal() {
            const modal = document.getElementById('movieModal');
            if (!modal) return;
            const modalContent = modal.querySelector('.bg-primary');
            if (modalContent) {
                modalContent.classList.remove('animate-slideIn');
                modalContent.classList.add('animate-zoomOut');
                setTimeout(() => {
                    modal.style.display = 'none';
                }, 380); // Sesuaikan dengan durasi animasi CSS Anda
            } else {
                 modal.style.display = 'none';
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            if (typeof moviesData !== 'undefined' && Array.isArray(moviesData)) {
                if (typeof placeholderPoster === 'undefined') {
                    console.error('Variabel placeholderPoster tidak terdefinisi!');
                }
                displayMovies(moviesData);
            } else {
                 console.warn('moviesData tidak tersedia atau bukan array yang valid.');
                 const container = document.getElementById('movieGrid');
                 const existingMessage = container ? container.querySelector('.no-movies-message') : null;
                 if(container && !existingMessage && !container.hasChildNodes()){
                    const p = document.createElement('p');
                    p.className = 'no-movies-message';
                    p.textContent = 'Belum ada film yang dapat ditampilkan (data tidak tersedia).';
                    const bladeNoMovieMsg = container.parentElement ? container.parentElement.querySelector('p.no-movies-message') : null;
                    if(bladeNoMovieMsg) bladeNoMovieMsg.remove();
                    container.appendChild(p);
                 }
            }

            const scrollProgressBar = document.getElementById('scrollProgressBar');
            if (scrollProgressBar) {
                window.addEventListener('scroll', () => {
                    const scrollTop = window.scrollY;
                    const docHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
                    const scrollPercent = docHeight > 0 ? (scrollTop / docHeight) * 100 : 0;
                    scrollProgressBar.style.width = scrollPercent + '%';
                });
            }

            const backToTopButton = document.getElementById('backToTop');
            const sectionsToReveal = document.querySelectorAll('.section');
            function handleScrollEffects() {
                if(backToTopButton){
                    if (window.scrollY > 300) {
                        backToTopButton.classList.remove('hidden', 'opacity-0');
                        backToTopButton.classList.add('opacity-100');
                    } else {
                        backToTopButton.classList.add('hidden', 'opacity-0');
                        backToTopButton.classList.remove('opacity-100');
                    }
                }
                sectionsToReveal.forEach(section => {
                    if(!section) return;
                    const sectionTop = section.getBoundingClientRect().top;
                    const windowHeight = window.innerHeight;
                    if (sectionTop < windowHeight * 0.85) {
                        section.classList.add('in-view');
                    }
                });
            }
            if(sectionsToReveal.length > 0 || backToTopButton){ // Hanya tambahkan event listener jika elemen ada
                window.addEventListener('scroll', handleScrollEffects);
                handleScrollEffects(); // Panggil sekali saat load
            }


            const movieModalElement = document.getElementById('movieModal');
            if(movieModalElement){
                window.addEventListener('click', function(event) {
                    if (event.target === movieModalElement) closeModal();
                });
                window.addEventListener('keydown', function(event) {
                    if (event.key === 'Escape' && movieModalElement.style.display === 'flex') closeModal();
                });
            }
        });
    </script>
@endsection