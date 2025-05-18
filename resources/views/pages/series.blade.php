{{-- resources/views/pages/series.blade.php --}}
@extends('layouts.layout')

@section('content')
    <style>
        body {
            top: 70px;
            position: relative;
            background: linear-gradient(135deg, #2D283E 0%, #4C495D 100%);
            min-height: calc(100vh - 70px);
            padding-bottom: 2rem;
            color: var(--text, #D1D7E0);
        }

        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        @keyframes slideIn { from { transform: translateY(20px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }
        @keyframes zoomOut { from { transform: scale(1); opacity: 1; } to { transform: scale(0.9); opacity: 0; } }
        .animate-fadeIn { animation: fadeIn 1s ease-out; }
        .animate-slideIn { animation: slideIn 0.8s ease-out; }
        .animate-zoomOut { animation: zoomOut 0.4s ease-out; }

        :root {
            --primary: #2D283E;
            --secondary: #4C495D;
            --accent: #802BB1;
            --text: #D1D7E0;
            --gray: #564F6F;
            --shadow-accent: 0 8px 25px rgba(128, 43, 177, 0.25);
        }

        /* Scroll Progress Bar */
        .scroll-progress {
            position: fixed;
            top: 0; /* Pastikan ini 0 jika header fixed dan scroll progress di atas header */
            left: 0;
            width: 100%;
            height: 4px;
            background: var(--gray);
            z-index: 1050; /* Di atas sebagian besar elemen, di bawah modal jika perlu */
        }
        .scroll-progress-bar {
            height: 100%;
            background: var(--accent);
            width: 0;
            transition: width 0.1s linear;
        }

        /* Movie Card Styling (digunakan juga untuk series card) */
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
        /* img.series-poster dan img.movie-poster BISA DIGABUNG */
        .movie-card img.series-poster,
        .movie-card img.movie-poster {
            transition: transform 0.5s ease;
            height: 24rem; /* 384px, atau sesuaikan (misal h-96 Tailwind) */
            width: 100%;
            object-fit: cover;
        }
        .movie-card:hover img.series-poster,
        .movie-card:hover img.movie-poster {
            transform: scale(1.05);
        }

        /* === BAGIAN KRUSIAL YANG HARUS ADA DAN LENGKAP === */
        .movie-card .overlay {
            position: absolute;
            inset: 0; /* Membuat overlay mengisi seluruh parent (.relative) */
            background: linear-gradient(to top, rgba(30, 28, 47, 0.9) 0%, rgba(30, 28, 47, 0.4) 70%, transparent 100%);
            opacity: 0; /* Sembunyikan secara default */
            transition: opacity 0.3s ease-in-out;
            display: flex;
            justify-content: center; /* Pusatkan tombol horizontal */
            align-items: center;    /* Pusatkan tombol vertikal */
            padding: 1rem;
        }
        .movie-card:hover .overlay {
            opacity: 1; /* Tampilkan saat kartu di-hover */
        }
        .movie-card .overlay .btn-details {
            padding: 0.6rem 1.2rem;
            border-radius: 0.5rem; /* 8px */
            transition: background-color 0.3s ease, transform 0.2s ease;
            text-decoration: none;
            color: white; /* Teks tombol putih */
            font-size: 0.9rem;
            text-align: center;
            border: none;
            cursor: pointer;
            background-color: var(--accent); /* Warna latar tombol ungu */
            font-weight: 500;
        }
        .movie-card .overlay .btn-details:hover {
            background-color: #6a208e; /* Warna accent lebih gelap saat hover */
            transform: scale(1.05);
        }
        /* === AKHIR BAGIAN KRUSIAL === */

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
        .no-items-message {
            color: var(--text); grid-column: 1 / -1; text-align: center;
            font-size: 1.25rem; padding: 2rem 0;
        }
        /* Modal Styling */
        #seriesDetailModal img { object-fit: cover; }
    </style>

    <!-- Scroll Progress Bar -->
    <div class="scroll-progress">
        <div class="scroll-progress-bar" id="scrollProgressBarSeries"></div>
    </div>

    <!-- Series Grid Section -->
    <section class="py-12 px-6 md:px-12 relative z-20 section" id="seriesSection">
        <div class="flex flex-wrap justify-between items-center mb-8 gap-4">
            <div class="border-b-2 border-accent inline-block pb-1 animate-fadeIn">
                <h2 class="text-3xl font-bold text-white">Daftar Series</h2>
            </div>
        </div>

        @if (session('success'))
            <div class="alert-success animate-fadeIn">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6 md:gap-8" id="seriesGrid">
            @if ($seriesItems->isEmpty())
                <p class="no-items-message">Belum ada series yang ditambahkan.</p>
            @endif
        </div>
        @if ($seriesItems->hasPages())
            <div class="mt-8">
                {{ $seriesItems->links('pagination::tailwind') }}
            </div>
        @endif
    </section>

    {{-- Modal for Details --}}
    <div id="seriesDetailModal" class="fixed inset-0 bg-black bg-opacity-80 z-[1060] hidden justify-center items-center p-4" role="dialog" aria-modal="true" style="top: 0;">
        <div class="bg-primary p-6 md:p-8 rounded-xl max-w-md w-full text-left shadow-2xl animate-slideIn relative">
            <button class="absolute top-3 right-3 text-gray-400 hover:text-accent transition-colors duration-300 text-2xl leading-none" onclick="closeSeriesModal()">✕</button>
            <div class="flex flex-col md:flex-row gap-4 md:gap-6 mb-4">
                <img id="modalSeriesPoster" src="" alt="Series Poster" class="w-full md:w-1/3 h-auto rounded-md self-start md:self-center">
                <div class="flex-1">
                    <h3 id="modalSeriesTitle" class="text-2xl md:text-3xl mb-2 text-white font-bold"></h3>
                    <p id="modalSeriesDirector" class="text-md mb-1 text-text"></p>
                    <p id="modalSeriesYear" class="text-sm mb-1 text-text"></p>
                    <p id="modalSeriesGenre" class="text-sm mb-3 text-text"></p>
                </div>
            </div>
            <p id="modalSeriesOverview" class="text-sm mb-6 text-gray-300 leading-relaxed"></p>
            <div class="text-right">
                <button class="bg-accent hover:bg-accent/90 text-white px-5 py-2.5 rounded-md transition-colors duration-300" onclick="closeSeriesModal()">Close</button>
            </div>
        </div>
    </div>

    <!-- Back to Top Button -->
    <button id="backToTopSeries" class="fixed bottom-6 right-6 bg-accent text-white p-3 rounded-full hidden opacity-0 transition-opacity duration-300 shadow-lg hover:bg-accent/90 z-[1040]" onclick="window.scrollTo({ top: 0, behavior: 'smooth' })">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 19V5M5 12l7-7 7 7"/></svg>
    </button>

    <script>
        const placeholderPoster = "{{ asset('images/poster_placeholder.png') }}";
        const seriesData = @json($seriesItems->items());

        function displaySeriesItems(items) {
            const container = document.getElementById('seriesGrid');
            if (!container) {
                console.error('Element dengan ID "seriesGrid" tidak ditemukan.');
                return;
            }
            container.innerHTML = '';

            const noItemsMsgBlade = container.parentElement.querySelector('p.no-items-message');
            if (items.length > 0 && noItemsMsgBlade) {
                noItemsMsgBlade.remove();
            }

            if (items.length === 0) {
                if (!noItemsMsgBlade || (noItemsMsgBlade && !noItemsMsgBlade.parentNode)) {
                    const p = document.createElement('p');
                    p.className = 'no-items-message';
                    p.textContent = 'Belum ada series yang dapat ditampilkan.';
                    container.appendChild(p);
                }
                return;
            }

            items.forEach(item => {
                const itemElement = document.createElement('div');
                itemElement.className = 'movie-card animate-fadeIn';

                const posterUrl = item.poster_url ? item.poster_url : placeholderPoster;
                const detailUrl = `{{ url('movies') }}/${item.id}`; // Menggunakan rute movies untuk detail

                itemElement.innerHTML = `
                    <div class="relative">
                        <img src="${posterUrl}" alt="${item.title || 'Poster Series'}" class="series-poster" onerror="this.onerror=null; this.src='${placeholderPoster}';">
                        <div class="overlay">
                            <a href="${detailUrl}" class="btn-details">Details</a>
                        </div>
                    </div>
                    <div class="p-3 text-center">
                        <h3 class="text-lg font-bold text-white mb-1 truncate" title="${item.title || 'Judul Tidak Tersedia'}">${item.title || 'Judul Tidak Tersedia'}</h3>
                        <p class="text-sm text-gray-400 truncate" title="${item.sutradara || ''}">${item.sutradara ? 'Sutradara: ' + item.sutradara : 'Sutradara: N/A'}</p>
                        <p class="text-xs text-gray-400">${item.tahun_rilis ? 'Tahun: ' + item.tahun_rilis : 'Tahun: N/A'}</p>
                    </div>
                `;
                container.appendChild(itemElement);
            });
        }

        function showSeriesDetails(itemId) {
            const item = seriesData.find(s => s.id === parseInt(itemId));
            if (!item) { console.warn('Series item not found for ID:', itemId); return; }

            const modal = document.getElementById('seriesDetailModal');
            if(!modal) { console.warn('Modal element #seriesDetailModal not found'); return; }

            const posterUrl = item.poster_url ? item.poster_url : placeholderPoster;
            modal.querySelector('#modalSeriesPoster').src = posterUrl;
            modal.querySelector('#modalSeriesPoster').alt = (item.title || 'N/A') + " Poster";
            modal.querySelector('#modalSeriesTitle').textContent = item.title || 'N/A';
            modal.querySelector('#modalSeriesOverview').textContent = item.sinopsis || item.description || 'Tidak ada deskripsi.'; // Menambahkan fallback ke description
            modal.querySelector('#modalSeriesDirector').textContent = `Sutradara: ${item.sutradara || 'N/A'}`;
            modal.querySelector('#modalSeriesYear').textContent = `Tahun: ${item.tahun_rilis || 'N/A'}`;
            modal.querySelector('#modalSeriesGenre').textContent = `Genre: ${item.genre || 'N/A'}`;
            modal.style.display = 'flex';

            const modalContent = modal.querySelector('.bg-primary');
            if(modalContent){
                 modalContent.classList.remove('animate-zoomOut');
                 modalContent.classList.add('animate-slideIn');
            }
        }

        function closeSeriesModal() {
            const modal = document.getElementById('seriesDetailModal');
            if (!modal) return;
            const modalContent = modal.querySelector('.bg-primary');
            if (modalContent) {
                modalContent.classList.remove('animate-slideIn');
                modalContent.classList.add('animate-zoomOut');
                setTimeout(() => {
                    modal.style.display = 'none';
                }, 380);
            } else {
                 modal.style.display = 'none';
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            if (typeof seriesData !== 'undefined' && Array.isArray(seriesData)) {
                if (typeof placeholderPoster === 'undefined') {
                    console.error('Variabel placeholderPoster tidak terdefinisi!');
                }
                displaySeriesItems(seriesData);
            } else {
                 console.warn('seriesData tidak tersedia atau bukan array yang valid.');
                 const container = document.getElementById('seriesGrid');
                 const existingMessage = container ? container.querySelector('.no-items-message') : null;
                 if(container && !existingMessage && !container.hasChildNodes()){
                    const p = document.createElement('p');
                    p.className = 'no-items-message';
                    p.textContent = 'Belum ada series yang dapat ditampilkan (data tidak tersedia).';
                    const bladeNoItemMsg = container.parentElement ? container.parentElement.querySelector('p.no-items-message') : null;
                    if(bladeNoItemMsg) bladeNoItemMsg.remove();
                    container.appendChild(p);
                 }
            }

            const scrollProgressBar = document.getElementById('scrollProgressBarSeries');
            if (scrollProgressBar) {
                window.addEventListener('scroll', () => {
                    const scrollTop = window.scrollY;
                    const docHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
                    const scrollPercent = docHeight > 0 ? (scrollTop / docHeight) * 100 : 0;
                    scrollProgressBar.style.width = scrollPercent + '%';
                });
            }

            const backToTopButton = document.getElementById('backToTopSeries');
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
            if(sectionsToReveal.length > 0 || backToTopButton){
                window.addEventListener('scroll', handleScrollEffects);
                handleScrollEffects();
            }

            const seriesModalElement = document.getElementById('seriesDetailModal');
            if(seriesModalElement){
                window.addEventListener('click', function(event) { if (event.target === seriesModalElement) closeSeriesModal(); });
                window.addEventListener('keydown', function(event) { if (event.key === 'Escape' && seriesModalElement.style.display === 'flex') closeSeriesModal(); });
            }
        });
    </script>
@endsection