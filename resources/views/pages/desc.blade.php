<!-- resources/views/movie.blade.php -->
@extends('layouts.layout')

@section('content')
<div class="main-container">
    <!-- Removed .background-image -->
    <div class="background-overlay"></div>
    <div class="content-container">
        <div class="poster-section">
            <img src="{{ asset('large.jpg') }}" alt="Black Bag 2025 Poster">
            <div class="poster-text">Black Bag</div>
        </div>
        <div class="info-section">
            <h1 class="title">Black Bag</h1>
            <div class="metadata">
                <!-- Metadata content can be dynamically added here -->
            </div>
            <div class="actions">
                <button class="rate-btn">Rate</button>
                <button class="watchlist-btn">Add to Watchlist</button>
            </div>
            <!-- Removed the overview-text paragraph here -->
            <div class="details-section">
                <div>
                    <h3>Premiered</h3>
                    <p>March 14th, 2025</p>
                </div>
                <div>
                    <h3>Runtime</h3>
                    <p>1h 34m</p>
                </div>
                <div>
                    <h3>Country</h3>
                    <p>United States</p>
                </div>
                <div>
                    <h3>Language</h3>
                    <p>English</p>
                </div>
                <div>
                    <h3>Studio</h3>
                    <p>Casey Silver Productions</p>
                </div>
            </div>

            <!-- Tabs -->
            <div class="tabs">
                <button class="tab active" data-tab="overview">Overview</button>
                <button class="tab" data-tab="review">Review</button>
            </div>

            <!-- Tab Content -->
            <div class="tab-content active" id="overview">
                <p class="overview-text">
                    When intelligence agent Kathryn Woodhouse is suspected of betraying the nation, her husband – also a legendary agent – faces the ultimate test of whether to be loyal to his marriage, or his country.
                </p>
            </div>

            <div class="tab-content" id="review">
                <div class="review-section">
                    <h3>Rate This Movie</h3>
                    <div class="rating-stars">
                        <span class="rating-star" data-value="1">★</span>
                        <span class="rating-star" data-value="2">★</span>
                        <span class="rating-star" data-value="3">★</span>
                        <span class="rating-star" data-value="4">★</span>
                        <span class="rating-star" data-value="5">★</span>
                    </div>
                    <div class="rating-value" id="rating-value">Not rated yet</div>
                    <h3>Comments</h3>
                    <div class="comment-section">
                        <div class="comment">
                            <p><strong>User1:</strong> Great movie!</p>
                            <div class="comment-meta">Posted on May 12, 2025</div>
                        </div>
                        <div class="comment">
                            <p><strong>User2:</strong> Intense plot.</p>
                            <div class="comment-meta">Posted on May 11, 2025</div>
                        </div>
                        <div class="comment-form">
                            <input type="text" id="comment-name" placeholder="Your name" required>
                            <textarea id="comment-text" placeholder="Add a comment..." required></textarea>
                            <button class="add-comment-btn">Post</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Where to Watch Section -->
            <div class="where-to-watch-section">
                <h3>Where to Watch</h3>
                <div class="watch-options">
                    <div class="watch-option">
                        <span>Amazon Prime 🎥</span>
                    </div>
                    <div class="watch-option">
                        <span>Netflix 🍿</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    * {
        margin: 0;
        padding: 0;
        top: 20px;
        box-sizing: border-box;
    }

    body {
        font-family: 'Helvetica Neue', Arial, sans-serif;
        background-color: #2D283E;
        color: #D1D7E0;
        line-height: 1.6;
        overflow-x: hidden;
    }

    /* Main Container */
    .main-container {
        position: relative;
        padding: 2rem 4rem;
        min-height: 100vh;
        margin-top: 20px; /* Shift entire container down */
    }

    /* Background Overlay */
    .background-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(to bottom, rgba(45, 40, 62, 0.8), #2D283E 90%);
        z-index: 2;
        opacity: 1;
    }

    /* Content Container */
    .content-container {
        display: flex;
        gap: 2.5rem;
        position: relative;
        z-index: 3;
        max-width: 1200px;
        margin: 0 auto;
        animation: slideIn 1s ease-out;
    }

    @keyframes slideIn {
        from { transform: translateY(20px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }

    /* Poster Section */
    .poster-section {
        position: relative;
        width: 250px;
        height: 375px;
        background-color: #4C495D;
        border-radius: 10px;
        display: flex;
        align-items: flex-end;
        padding: 1rem;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.6);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .poster-section:hover {
        transform: scale(1.05);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.8);
    }

    .poster-section img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 10px;
        position: absolute;
        top: 0;
        left: 0;
        opacity: 0.95;
        transition: opacity 0.3s ease;
    }

    .poster-section:hover img {
        opacity: 1;
    }

    .poster-section .poster-text {
        color: #D1D7E0;
        font-size: 1.8rem;
        font-weight: bold;
        text-transform: uppercase;
        z-index: 1;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
    }

    /* Info Section */
    .info-section {
        flex: 1;
        max-width: 800px;
    }

    .info-section .title {
        font-size: 2.8rem;
        color: #D1D7E0;
        margin-bottom: 0.6rem;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        animation: fadeInDown 1s ease-out;
    }

    @keyframes fadeInDown {
        from { opacity: 0; transform: translateY(-20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .info-section .genres {
        font-size: 1rem;
        color: #564F6F;
        margin-bottom: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .metadata {
        display: flex;
        gap: 1.2rem;
        margin-bottom: 1.2rem;
        font-size: 1rem;
        flex-wrap: wrap;
    }

    .metadata span {
        display: flex;
        align-items: center;
        gap: 0.4rem;
        background-color: #4C495D;
        padding: 0.3rem 0.6rem;
        border-radius: 6px;
        transition: transform 0.2s ease;
    }

    .metadata span:hover {
        transform: scale(1.05);
    }

    .actions {
        display: flex;
        gap: 0.6rem;
        margin-bottom: 1.8rem;
        flex-wrap: wrap;
        animation: fadeIn 1s ease-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    .rate-btn, .watchlist-btn {
        background-color: #802BB1;
        color: #D1D7E0;
        border: none;
        padding: 0.8rem 1.6rem;
        border-radius: 6px;
        font-size: 1rem;
        text-transform: uppercase;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.2s ease, box-shadow 0.3s ease;
        display: flex;
        align-items: center;
        gap: 0.6rem;
        box-shadow: 0 3px 8px rgba(128, 43, 177, 0.3);
    }

    .rate-btn:hover, .watchlist-btn:hover {
        background-color: #6A1F93;
        transform: scale(1.05);
        box-shadow: 0 6px 15px rgba(128, 43, 177, 0.5);
    }

    .rate-btn {
        background-color: #F5C518;
        color: #2D283E;
    }

    .rate-btn:hover {
        background-color: #E0B016;
    }

    .watchlist-btn {
        background-color: #4C495D;
        color: #D1D7E0;
        border: 1px solid #564F6F;
    }

    .watchlist-btn:hover {
        background-color: #564F6F;
        color: #D1D7E0;
    }

    .overview-text {
        font-size: 1.1rem;
        color: #564F6F;
        margin-bottom: 1.8rem;
        max-width: 600px;
        line-height: 1.7;
        animation: fadeIn 1.2s ease-out;
    }

    /* Details Section */
    .details-section {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1.2rem;
        font-size: 1rem;
        margin-bottom: 2.2rem;
        animation: fadeInUp 1s ease-out;
    }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .details-section h3 {
        font-size: 1.1rem;
        margin-bottom: 0.6rem;
        color: #D1D7E0;
        text-transform: uppercase;
    }

    .details-section p {
        color: #564F6F;
    }

    /* Tabs */
    .tabs {
        display: flex;
        gap: 1.8rem;
        margin: 2.2rem 0 1.2rem;
        animation: fadeIn 1.2s ease-out;
    }

    .tab {
        background: none;
        border: none;
        padding: 0.6rem 0;
        font-size: 1.1rem;
        cursor: pointer;
        color: #564F6F;
        position: relative;
        transition: color 0.3s ease, transform 0.2s ease;
        text-transform: uppercase;
    }

    .tab:hover {
        color: #D1D7E0;
        transform: scale(1.05);
    }

    .tab.active {
        color: #D1D7E0;
    }

    .tab.active::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 100%;
        height: 3px;
        background-color: #802BB1;
        animation: slideInBottom 0.3s ease-out;
    }

    @keyframes slideInBottom {
        from { width: 0; }
        to { width: 100%; }
    }

    .tab-content {
        display: none;
        animation: fadeIn 0.5s ease-out;
        margin-top: 40px;
    }

    .tab-content.active {
        display: block;
    }

    /* Review Section */
    .review-section {
        margin-top: 1.2rem;
    }

    .review-section h3 {
        font-size: 1.3rem;
        color: #D1D7E0;
        margin-bottom: 1.2rem;
        text-transform: uppercase;
    }

    .comment {
        background-color: #4C495D;
        padding: 0.9rem;
        border-radius: 8px;
        margin-bottom: 0.6rem;
        box-shadow: 0 3px 8px rgba(0, 0, 0, 0.2);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .comment:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 12px rgba(0, 0, 0, 0.3);
    }

    .comment p {
        margin: 0;
        font-size: 1rem;
        color: #D1D7E0;
    }

    .comment .comment-meta {
        font-size: 0.8rem;
        color: #564F6F;
        margin-top: 0.3rem;
    }

    .comment-form {
        display: flex;
        flex-direction: column;
        gap: 0.6rem;
    }

    .comment-form input {
        padding: 0.6rem;
        border-radius: 6px;
        border: 1px solid #564F6F;
        background-color: #2D283E;
        color: #D1D7E0;
        font-size: 1rem;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    .comment-form input:focus {
        border-color: #802BB1;
        box-shadow: 0 0 8px rgba(128, 43, 177, 0.3);
        outline: none;
    }

    .comment-form textarea {
        width: 100%;
        padding: 0.9rem;
        border-radius: 6px;
        border: 1px solid #564F6F;
        background-color: #2D283E;
        color: #D1D7E0;
        resize: vertical;
        font-size: 1rem;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    .comment-form textarea:focus {
        border-color: #802BB1;
        box-shadow: 0 0 8px rgba(128, 43, 177, 0.3);
        outline: none;
    }

    .add-comment-btn {
        background-color: #802BB1;
        color: #D1D7E0;
        border: none;
        padding: 0.6rem 1.2rem;
        border-radius: 6px;
        font-size: 1rem;
        text-transform: uppercase;
        cursor: pointer;
        margin-top: 0.6rem;
        transition: background-color 0.3s ease, transform 0.2s ease, box-shadow 0.3s ease;
        box-shadow: 0 3px 8px rgba(128, 43, 177, 0.3);
    }

    .add-comment-btn:hover {
        background-color: #6A1F93;
        transform: scale(1.05);
        box-shadow: 0 6px 15px rgba(128, 43, 177, 0.5);
    }

    .rating-stars {
        display: flex;
        gap: 0.3rem;
        margin-bottom: 0.6rem;
    }

    .rating-star {
        font-size: 1.8rem;
        color: #564F6F;
        cursor: pointer;
        transition: color 0.3s ease, transform 0.2s ease;
    }

    .rating-star:hover, .rating-star.active {
        color: #F5C518;
        transform: scale(1.2);
    }

    .rating-value {
        font-size: 1rem;
        color: #D1D7E0;
        margin-top: 0.3rem;
    }

    /* Where to Watch Section */
    .where-to-watch-section {
        margin-top: 2.2rem;
        margin-bottom: 2rem;
    }

    .where-to-watch-section h3 {
        font-size: 1.3rem;
        color: #D1D7E0;
        margin-bottom: 1.2rem;
        text-transform: uppercase;
        animation: fadeInDown 1s ease-out;
    }

    .watch-options {
        display: flex;
        gap: 1.2rem;
        flex-wrap: wrap;
    }

    .watch-option {
        background-color: #4C495D;
        padding: 0.9rem 1.2rem;
        border-radius: 8px;
        display: flex;
        align-items: center;
        gap: 0.6rem;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        cursor: pointer;
    }

    .watch-option:hover {
        transform: scale(1.05);
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.3);
    }

    .watch-option span {
        font-size: 1rem;
        color: #D1D7E0;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .main-container {
            padding: 2rem 1rem;
        }

        .content-container {
            flex-direction: column;
        }

        .poster-section {
            width: 100%;
            max-width: 300px;
            height: auto;
            margin: 0 auto;
        }

        .info-section {
            margin-top: 1.2rem;
        }

        .details-section {
            grid-template-columns: 1fr;
            gap: 1rem;
        }

        .tabs {
            flex-direction: column;
        }

        .tab {
            padding: 0.3rem 0;
        }
    }
</style>

<script>
    // Tab Switching
    const tabs = document.querySelectorAll('.tab');
    const contents = document.querySelectorAll('.tab-content');

    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            tabs.forEach(t => t.classList.remove('active'));
            contents.forEach(c => c.classList.remove('active'));
            tab.classList.add('active');
            document.getElementById(tab.dataset.tab).classList.add('active');
        });
    });

    // Watchlist Button
    const watchlistBtns = document.querySelectorAll('.watchlist-btn');
    watchlistBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            btn.textContent = btn.textContent === 'Add to Watchlist' ? 'Added to Watchlist' : 'Add to Watchlist';
            btn.style.backgroundColor = btn.textContent === 'Added to Watchlist' ? '#4C495D' : '#564F6F';
        });
    });

    // Comment Functionality
    const commentNameInput = document.getElementById('comment-name');
    const commentTextInput = document.getElementById('comment-text');
    const addCommentBtn = document.querySelector('.add-comment-btn');

    addCommentBtn.addEventListener('click', () => {
        const name = commentNameInput.value.trim();
        const text = commentTextInput.value.trim();
        if (name && text) {
            const commentDiv = document.createElement('div');
            commentDiv.classList.add('comment');
            const now = new Date();
            commentDiv.innerHTML = `
                <p><strong>${name}:</strong> ${text}</p>
                <div class="comment-meta">Posted on ${now.toLocaleDateString()}</div>
            `;
            const commentsContainer = document.querySelector('.comment-section');
            commentsContainer.insertBefore(commentDiv, commentTextInput.parentElement);
            commentNameInput.value = '';
            commentTextInput.value = '';
        }
    });

    // Rating Functionality
    const stars = document.querySelectorAll('.rating-star');
    const ratingValue = document.getElementById('rating-value');
    let userRating = localStorage.getItem('userRating') ? parseInt(localStorage.getItem('userRating')) : 0;

    stars.forEach(star => {
        if (userRating >= parseInt(star.dataset.value)) star.classList.add('active');
        star.addEventListener('click', () => {
            const value = parseInt(star.dataset.value);
            userRating = value;
            localStorage.setItem('userRating', value);
            stars.forEach(s => s.classList.remove('active'));
            for (let i = 0; i < value; i++) {
                stars[i].classList.add('active');
            }
            ratingValue.textContent = `Your rating: ${value} star${value > 1 ? 's' : ''}`;
            alert(`You rated this movie ${value} star${value > 1 ? 's' : ''}!`);
        });

        star.addEventListener('mouseover', () => {
            const value = parseInt(star.dataset.value);
            stars.forEach(s => s.classList.remove('active'));
            for (let i = 0; i < value; i++) {
                stars[i].classList.add('active');
            }
        });

        star.addEventListener('mouseout', () => {
            stars.forEach(s => s.classList.remove('active'));
            for (let i = 0; i < userRating; i++) {
                stars[i].classList.add('active');
            }
        });
    });

    if (userRating > 0) {
        ratingValue.textContent = `Your rating: ${userRating} star${userRating > 1 ? 's' : ''}`;
    }
</script>
@endsection