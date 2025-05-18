{{-- resources/views/pages/desc.blade.php --}}
@extends('layouts.layout')

@section('content')
<div class="main-container-desc">
    {{-- Dinamic Background Overlay --}}
    <div class="background-visual" style="background-image: url('{{ $movie->poster_url ?: asset('images/poster_placeholder.png') }}');"></div>
    <div class="background-gradient-overlay"></div>

    <div class="content-container-desc">
        {{-- Kolom Kiri: Poster --}}
        <div class="poster-column-desc">
            <img src="{{ $movie->poster_url ?: asset('images/poster_placeholder.png') }}" alt="{{ $movie->title }} Poster" class="movie-detail-poster" onerror="this.onerror=null;this.src='{{ asset('images/poster_placeholder.png') }}';">
        </div>

        {{-- Kolom Kanan: Informasi dan Konten Tab --}}
        <div class="info-column-desc">
            <h1 class="title-desc">{{ $movie->title }}</h1>

            <div class="metadata-desc">
                @if($movie->genre)<span><i class="fas fa-tag mr-1 text-xs"></i> {{ $movie->genre }}</span>@endif
                @if($movie->tahun_rilis)<span><i class="fas fa-calendar-alt mr-1 text-xs"></i> {{ $movie->tahun_rilis }}</span>@endif
                @if(isset($movie->runtime) && $movie->runtime)
                    <span><i class="fas fa-clock mr-1 text-xs"></i> {{ $movie->runtime }}</span>
                @endif
                @if($averageRating > 0)
                    <span class="flex items-center"><i class="fas fa-star text-yellow-400 mr-1 text-xs"></i> {{ number_format($averageRating, 1) }}/5 ({{ $reviews->total() }} ulasan)</span>
                @else
                    <span class="flex items-center"><i class="fas fa-star text-gray-500 mr-1 text-xs"></i> Belum Ada Rating</span>
                @endif
            </div>

            <div class="actions-desc">
                <button class="rate-btn-desc" id="rateMovieBtnInDesc">
                    <i class="fas fa-star mr-2"></i> Rate This Movie
                </button>
                <form action="{{ route('watchlist.add', $movie->id) }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="watchlist-btn-desc">
                        <i class="fas fa-plus-circle mr-2"></i> Add to Watchlist
                    </button>
                </form>
            </div>

            <div class="details-grid-desc">
                <div><h3>Premiered</h3><p>{{ $movie->tahun_rilis ? \Carbon\Carbon::createFromFormat('Y', (string)$movie->tahun_rilis)->format('M Y') : 'N/A' }}</p></div>
                <div><h3>Runtime</h3><p>{{ $movie->runtime ?? 'N/A' }}</p></div>
                <div><h3>Country</h3><p>{{ $movie->negara ?: 'N/A' }}</p></div>
                <div><h3>Language</h3><p>{{ $movie->bahasa ?: 'N/A' }}</p></div>
                <div class="detail-item-full"><h3>Studio</h3><p>{{ $movie->studio ?? 'N/A' }}</p></div>
                <div class="detail-item-full"><h3>Sutradara</h3><p>{{ $movie->sutradara ?: 'N/A' }}</p></div>
                <div class="detail-item-full"><h3>Penulis</h3><p>{{ $movie->penulis ?: 'N/A' }}</p></div>
                <div class="detail-item-full"><h3>Aktor Utama</h3><p>{{ $movie->aktor_utama ?: 'N/A' }}</p></div>
            </div>

            <!-- Tabs -->
            <div class="tabs-desc">
                <button class="tab-desc active" data-tab-target="#overviewContentDesc">Overview</button>
                <button class="tab-desc" data-tab-target="#reviewContentDesc">Review ({{ $reviews->total() }})</button>
            </div>

            <!-- Tab Content -->
            <div class="tab-content-container-desc">
                <div class="tab-content-desc active" id="overviewContentDesc">
                    <h3 class="section-title-desc">Synopsis</h3>
                    <p class="overview-text-desc">
                        {{ $movie->sinopsis ?: 'Sinopsis tidak tersedia.' }}
                    </p>
                </div>

                <div class="tab-content-desc" id="reviewContentDesc">
                    @include('pages.partials.review-section', [
                        'movie' => $movie,
                        'reviews' => $reviews,
                        'userHasReviewed' => $userHasReviewed,
                        'userReview' => $userReview
                    ])
                </div>
            </div>

            <!-- Where to Watch Section -->
            <div class="where-to-watch-section-desc">
                <h3 class="section-title-desc">Where to Watch</h3>
                <div class="watch-options-desc">
                    <div class="watch-option-desc"><span>Amazon Prime <i class="fas fa-external-link-alt ml-1 text-xs"></i></span></div>
                    <div class="watch-option-desc"><span>Netflix <i class="fas fa-external-link-alt ml-1 text-xs"></i></span></div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal Edit Review --}}
<div id="editReviewModal" class="fixed inset-0 bg-black bg-opacity-75 z-[1070] hidden justify-center items-center p-4">
    <div class="bg-secondary p-6 rounded-lg shadow-xl w-full max-w-md">
        <h3 class="text-xl font-semibold text-white mb-4">Edit Your Review</h3>
        <form id="editReviewForm" method="POST" action=""> @csrf @method('PUT')
            <input type="hidden" name="review_id" id="edit_review_id">
            <div class="rating-stars mb-3" id="edit_rating_stars_container">
                @for ($i = 1; $i <= 5; $i++)
                <input type="radio" name="rating" id="edit_rate-{{ $i }}" value="{{ $i }}" class="sr-only peer edit-rate-star">
                <label for="edit_rate-{{ $i }}" class="rating-star text-2xl cursor-pointer peer-hover:text-yellow-300 peer-checked:text-yellow-400 text-gray-500" data-value="{{ $i }}">★</label>
                @endfor
            </div>
            <textarea name="comment" id="edit_comment_text" rows="4" class="w-full p-2 bg-gray-800 border border-gray-600 rounded-md text-white focus:ring-accent-desc focus:border-accent-desc" required></textarea>
            <div class="mt-6 flex justify-end space-x-3">
                <button type="button" onclick="closeEditReviewModal()" class="px-4 py-2 text-gray-300 hover:bg-gray-700 rounded-md">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-accent hover:bg-accent/90 text-white rounded-md">Update Review</button>
            </div>
        </form>
    </div>
</div>

<style>
    :root {
        --primary-desc: #1E1C2F; --secondary-desc: #2D283E; --card-bg-desc: #4C495D;
        --accent-desc: #DD9BB5; --text-desc: #E0E0E0; --text-muted-desc: #a0aec0;
        --border-color-desc: #564F6F; --star-active-color: #F5C518; --star-inactive-color: #564F6F;
    }
    .main-container-desc {
        position: relative; padding: 2rem 1rem; margin-top: 70px;
        min-height: calc(100vh - 70px); overflow-x: hidden;
    }
    .background-visual {
        position: absolute; top: 0; left: 0; width: 100%; height: 50vh;
        background-size: cover; background-position: center 30%;
        filter: blur(10px) brightness(0.35); z-index: 1; transform: scale(1.1);
    }
    .background-gradient-overlay {
        position: absolute; top: 0; left: 0; width: 100%; height: 85vh;
        background: linear-gradient(to bottom, rgba(30, 28, 47, 0) 20%, var(--primary-desc) 95%);
        z-index: 2;
    }
    .content-container-desc {
        display: grid; grid-template-columns: 1fr; gap: 1.5rem; position: relative;
        z-index: 3; max-width: 1200px; margin: 0 auto; padding-top: 1rem;
    }
    .poster-column-desc { display: flex; justify-content: center; }
    .movie-detail-poster {
        width: 250px; height: auto; max-height: 375px; border-radius: 8px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.5); object-fit: cover;
    }
    .info-column-desc { padding: 0.5rem; }
    .title-desc {
        font-size: 2.25rem; color: var(--text-desc); margin-bottom: 0.75rem;
        font-weight: 700; line-height: 1.2;
    }
    .metadata-desc {
        display: flex; flex-wrap: wrap; gap: 0.5rem 1rem; margin-bottom: 1.25rem;
        color: var(--text-muted-desc); font-size: 0.875rem;
    }
    .metadata-desc span { background-color: rgba(76, 73, 93, 0.4); padding: 0.3rem 0.6rem; border-radius: 0.25rem; display:inline-flex; align-items:center; }
    .actions-desc { display: flex; gap: 0.75rem; margin-bottom: 1.5rem; }
    .actions-desc button {
        border: none; padding: 0.6rem 1.25rem; border-radius: 6px; font-size: 0.875rem;
        text-transform: uppercase; cursor: pointer; transition: background-color 0.3s, transform 0.2s;
        font-weight: 600; display: flex; align-items: center;
    }
    .rate-btn-desc { background-color: var(--accent-desc); color: var(--primary-desc); }
    .rate-btn-desc:hover { background-color: #c786a5; }
    .watchlist-btn-desc { background-color: var(--card-bg-desc); color: var(--text-desc); }
    .watchlist-btn-desc:hover { background-color: var(--border-color-desc); }

    .details-grid-desc {
        display: grid; grid-template-columns: repeat(2, 1fr);
        gap: 0.5rem 1.5rem; font-size: 0.875rem; margin-bottom: 2rem;
    }
    .details-grid-desc h3 {
        font-size: 0.75rem; margin-bottom: 0.1rem; color: var(--text-muted-desc);
        text-transform: uppercase; font-weight: 500; letter-spacing: 0.05em;
    }
    .details-grid-desc p { color: var(--text-desc); margin:0; font-weight: 300; }
    .detail-item-full { grid-column: span 2 / span 2; }

    .tabs-desc {
        display: flex;
        gap: 1.5rem;
        margin-bottom: 0.5rem;
        /* border-bottom: 1px solid var(--border-color-desc); */ /* Garis dihilangkan/dikomentari */
    }
    .tab-desc {
        background: none; border: none; padding: 0.75rem 0.1rem; font-size: 1rem;
        cursor: pointer; color: var(--text-muted-desc); position: relative;
        transition: color 0.3s; text-transform: uppercase; font-weight: 600; margin-right: 1.5rem;
    }
    .tab-desc.active, .tab-desc:hover { color: var(--text-desc); }
    .tab-desc.active::after {
        content: ''; position: absolute; bottom: -1px; /* Disesuaikan jika border-bottom tabs-desc dihilangkan */
        left: 0; width: 100%; height: 3px;
        background-color: var(--accent-desc); animation: slideInWidth 0.3s ease;
    }
    @keyframes slideInWidth { from { width: 0%; } to { width: 100%; } }

    .tab-content-container-desc {}
    .tab-content-desc { display: none; padding-top: 1.5rem; }
    .tab-content-desc.active { display: block; animation: fadeInContent 0.5s ease; }
    @keyframes fadeInContent { from { opacity: 0; } to { opacity: 1; } }

    .section-title-desc { font-size: 1.25rem; color: var(--text-desc); margin-bottom: 1rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em;}
    .overview-text-desc { font-size: 0.95rem; line-height: 1.7; color: var(--text-muted-desc); }

    .where-to-watch-section-desc { margin-top: 2.5rem; }
    .watch-options-desc { display: flex; gap: 0.75rem; flex-wrap: wrap; }
    .watch-option-desc {
        background-color: var(--card-bg-desc); padding: 0.6rem 1rem; border-radius: 6px;
        display: flex; align-items: center; gap: 0.5rem; font-size: 0.9rem; color: var(--text-desc);
        transition: background-color 0.2s;
    }
    .watch-option-desc:hover { background-color: var(--border-color-desc); }

    @media (min-width: 768px) { /* md breakpoint */
        .main-container-desc { padding: 3rem 2rem; }
        .content-container-desc {
            grid-template-columns: 300px 1fr; gap: 2.5rem; padding-top: 8vh;
        }
        .poster-column-desc { justify-content: flex-start; }
        .movie-detail-poster { width: 300px; max-height: 450px; }
        .title-desc { text-align: left; font-size: 2.75rem; }
        .metadata-desc { justify-content: flex-start; }
        .actions-desc { justify-content: flex-start; }
        .details-grid-desc { grid-template-columns: repeat(2, minmax(0, 1fr)); }
        .detail-item-full { grid-column: span 2 / span 2; }
    }
    @media (min-width: 1024px) { /* lg breakpoint */
        .details-grid-desc { grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 0.75rem 2rem;}
         .title-desc { font-size: 3.25rem; }
    }

    .rating-star { cursor: pointer; transition: color 0.2s, transform 0.1s; font-size: 1.75rem; color: var(--star-inactive-color); }
    .rating-star:hover { transform: scale(1.15); }
    .rating-star.active { color: var(--star-active-color) !important; }
    .peer:checked + label.rating-star { color: var(--star-active-color) !important; }
    .peer:checked + label.rating-star ~ label.rating-star { color: var(--star-inactive-color) !important; }
    .sr-only {
        position: absolute; width: 1px; height: 1px; padding: 0; margin: -1px;
        overflow: hidden; clip: rect(0, 0, 0, 0); white-space: nowrap; border-width: 0;
    }
</style>

<script>
    function updateStars(starElements, rating) {
        starElements.forEach(s => {
            s.classList.toggle('active', parseInt(s.dataset.value) <= rating);
        });
    }

    function setupStarRating(starContainerSelector) {
        const starContainer = document.querySelector(starContainerSelector);
        if (!starContainer) { console.warn(`Star rating container tidak ditemukan: ${starContainerSelector}`); return 0; }
        const stars = starContainer.querySelectorAll('.rating-star');
        const radioInputs = starContainer.querySelectorAll('input[type="radio"]');
        let currentRating = 0;
        const checkedRadio = starContainer.querySelector('input[name="rating"]:checked');
        if (checkedRadio) {
            currentRating = parseInt(checkedRadio.value);
            updateStars(stars, currentRating);
        }
        stars.forEach(star => {
            star.addEventListener('click', () => {
                currentRating = parseInt(star.dataset.value);
                radioInputs.forEach(radio => { radio.checked = (parseInt(radio.value) === currentRating); });
                updateStars(stars, currentRating);
            });
            star.addEventListener('mouseover', () => {
                const hoverValue = parseInt(star.dataset.value);
                stars.forEach(s => { s.style.color = (parseInt(s.dataset.value) <= hoverValue) ? 'var(--star-active-color)' : 'var(--star-inactive-color)'; });
            });
            star.addEventListener('mouseout', () => { updateStars(stars, currentRating); });
        });
        return currentRating;
    }

    const editReviewModal = document.getElementById('editReviewModal');
    const editReviewForm = document.getElementById('editReviewForm');
    const editReviewIdInput = document.getElementById('edit_review_id');
    const editCommentTextInput = document.getElementById('edit_comment_text');
    const editRatingStarsContainer = document.getElementById('edit_rating_stars_container');

    function openEditReviewModal(reviewId, currentRating, currentComment) {
        if (!editReviewModal || !editReviewForm || !editRatingStarsContainer) { console.error("Elemen modal edit review tidak ditemukan semua."); return; }
        editReviewForm.action = `{{ url('reviews') }}/${reviewId}`;
        if(editReviewIdInput) editReviewIdInput.value = reviewId;
        if(editCommentTextInput) editCommentTextInput.value = currentComment;
        const editStars = editRatingStarsContainer.querySelectorAll('.rating-star');
        const editRadios = editRatingStarsContainer.querySelectorAll('input[name="rating"].edit-rate-star');
        editRadios.forEach(radio => radio.checked = (parseInt(radio.value) === currentRating));
        updateStars(editStars, currentRating);
        setupStarRating('#edit_rating_stars_container');
        editReviewModal.style.display = 'flex';
    }

    function closeEditReviewModal() {
        if (editReviewModal) editReviewModal.style.display = 'none';
    }

    document.addEventListener('DOMContentLoaded', function() {
        const tabs = document.querySelectorAll('.tab-desc');
        const tabContents = document.querySelectorAll('.tab-content-desc');
        const rateMovieButton = document.getElementById('rateMovieBtnInDesc');

        if (tabs.length && tabContents.length) {
            tabs.forEach(tab => {
                tab.addEventListener('click', () => {
                    tabs.forEach(t => t.classList.remove('active'));
                    tabContents.forEach(c => c.classList.remove('active'));
                    tab.classList.add('active');
                    const targetContentSelector = tab.dataset.tabTarget;
                    const targetContent = document.querySelector(targetContentSelector);
                    if (targetContent) {
                        targetContent.classList.add('active');
                    } else { console.error('Target content not found for tab selector:', targetContentSelector); }
                });
            });
        }

        if (rateMovieButton) {
            rateMovieButton.addEventListener('click', () => {
                const reviewTabButton = document.querySelector('.tab-desc[data-tab-target="#reviewContentDesc"]');
                if (reviewTabButton) {
                    reviewTabButton.click();
                    const reviewSectionElement = document.getElementById('reviewContentDesc');
                    if (reviewSectionElement) {
                        const navbarHeight = document.getElementById('navbar') ? document.getElementById('navbar').offsetHeight : 70;
                        const elementPosition = reviewSectionElement.getBoundingClientRect().top + window.pageYOffset;
                        const offsetPosition = elementPosition - navbarHeight - 20;
                        window.scrollTo({ top: offsetPosition, behavior: 'smooth' });
                    }
                } else { console.error('Tombol tab review (data-tab-target="#reviewContentDesc") tidak ditemukan.'); }
            });
        }

        if (document.getElementById('add_rating_stars_container')) {
            setupStarRating('#add_rating_stars_container');
        }

        if(editReviewModal){
            window.addEventListener('click', function(event) { if (event.target === editReviewModal) closeEditReviewModal(); });
            window.addEventListener('keydown', function(event) { if (event.key === 'Escape' && editReviewModal.style.display === 'flex') closeEditReviewModal(); });
        }
    });
</script>
@endsection