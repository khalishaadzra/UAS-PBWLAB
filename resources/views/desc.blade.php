<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Black Bag (2025) - Trakt</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Helvetica Neue', Arial, sans-serif;
      background-color: #2D283E;
      color: #D1D7E0;
      line-height: 1.6;
      overflow-x: hidden;
    }

    /* Header */
    .top-nav {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 0.85rem 2rem;
      position: fixed;
      width: 100%;
      z-index: 1000;
      transition: background-color 0.3s ease;
    }

    .top-nav:hover {
      background-color: rgba(42, 42, 42, 1);
    }

    .top-nav .logo {
      font-size: 1.5rem;
      font-weight: bold;
      color: #802BB1;
      text-decoration: none;
      text-transform: lowercase;
      position: relative;
      padding-left: 1.5rem;
      display: flex;
      align-items: center;
    }

    .top-nav .logo::before {
      content: '✓';
      position: absolute;
      left: 0;
      color: #802BB1;
      font-weight: bold;
      font-size: 1.2rem;
    }

    .top-nav .nav-right {
      display: flex;
      align-items: center;
      gap: 2rem;
    }

    .top-nav nav ul {
      display: flex;
      gap: 1.5rem;
      list-style: none;
      margin: 0;
      padding: 0;
    }

    .top-nav nav ul li a {
      color: #D1D7E0;
      text-decoration: none;
      font-size: 0.95rem;
      font-weight: 500;
      text-transform: uppercase;
      transition: color 0.2s ease, transform 0.2s ease;
    }

    .top-nav nav ul li a:hover {
      color: #802BB1;
      transform: scale(1.1);
    }

    .join-btn {
      background-color: #802BB1;
      color: #D1D7E0;
      border: none;
      padding: 0.6rem 1.2rem;
      border-radius: 5px;
      font-size: 0.95rem;
      font-weight: 500;
      text-transform: uppercase;
      cursor: pointer;
      transition: background-color 0.3s ease, transform 0.2s ease, box-shadow 0.3s ease;
    }

    .join-btn:hover {
      background-color: #6A1F93;
      transform: scale(1.05);
      box-shadow: 0 4px 12px rgba(128, 43, 177, 0.4);
    }

    /* Main Container */
    .main-container {
      position: relative;
      padding: 5rem 4rem 2rem;
      min-height: 100vh;
    }

    /* Background Image */
    .background-image {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-image: url('large.jpg');
      background-size: cover;
      background-position: center;
      opacity: 0.4;
      z-index: 1;
      animation: fadeIn 1s ease-in;
    }

    .background-overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100vh;
      background: linear-gradient(to bottom, rgba(45, 40, 62, 0.3), #2D283E 90%);
      z-index: 2;
    }

    @keyframes fadeIn {
      from { opacity: 0; }
      to { opacity: 0.2; }
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

    .poster-section .interactive-btn {
      position: absolute;
      top: 10px;
      right: 10px;
      background: rgba(76, 73, 93, 0.8);
      border: none;
      color: #D1D7E0;
      font-size: 1.3rem;
      cursor: pointer;
      padding: 6px;
      border-radius: 50%;
      transition: background 0.3s ease, transform 0.2s ease;
    }

    .poster-section .interactive-btn:hover {
      background: rgba(76, 73, 93, 1);
      transform: scale(1.2);
      color: #802BB1;
    }

    .tooltip {
      position: absolute;
      top: 40px;
      right: 10px;
      background: #4C495D;
      color: #D1D7E0;
      padding: 6px 12px;
      border-radius: 5px;
      font-size: 0.9rem;
      display: none;
      z-index: 10;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
    }

    .interactive-btn:hover .tooltip {
      display: block;
      animation: fadeIn 0.3s ease;
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

    .metadata .trakt-rating {
      color: #802BB1;
    }

    .metadata .imdb-rating {
      color: #F5C518;
    }

    .metadata .certification {
      background-color: #564F6F;
      color: #D1D7E0;
      border: 1px solid #6A1F93;
      padding: 0.25rem 0.5rem;
      font-size: 0.9rem;
    }

    .actions {
      display: flex;
      gap: 0.6rem;
      margin-bottom: 1.8rem;
      flex-wrap: wrap;
      animation: fadeIn 1s ease-out;
    }

    .rate-btn, .watchlist-btn, .trailer-btn, .share-btn {
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

    .rate-btn:hover, .watchlist-btn:hover, .trailer-btn:hover, .share-btn:hover {
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

    .trailer-btn {
      background-color: #802BB1;
      border: none;
      color: #D1D7E0;
    }

    .trailer-btn:hover {
      background-color: #6A1F93;
    }

    .share-btn {
      background-color: #4C495D;
      border: 1px solid #564F6F;
      color: #D1D7E0;
    }

    .share-btn:hover {
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

    .details-section p a {
      color: #802BB1;
      text-decoration: none;
      transition: color 0.2s ease;
    }

    .details-section p a:hover {
      color: #6A1F93;
      text-decoration: underline;
    }

    .more-btn {
      background: none;
      border: none;
      color: #802BB1;
      cursor: pointer;
      font-size: 1rem;
      padding: 0;
      margin-top: 0.6rem;
      transition: color 0.2s ease, transform 0.2s ease;
    }

    .more-btn:hover {
      color: #6A1F93;
      transform: scale(1.1);
    }

    /* Tabs */
    .tabs {
      display: flex;
      gap: 1.8rem;
      margin: 2.2rem 0 1.2rem;
      border-bottom: 2px solid #4C495D;
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
    }

    .tab-content.active {
      display: block;
    }

    /* Comments Section */
    .comment-section {
      margin-top: 1.2rem;
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

    /* Rating Section */
    .rating-section {
      margin-top: 1.2rem;
      animation: fadeIn 1.2s ease-out;
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

    /* Actors Section */
    .actors-section {
      margin-top: 2.2rem;
    }

    .actors-section h3 {
      font-size: 1.3rem;
      color: #D1D7E0;
      margin-bottom: 1.2rem;
      text-transform: uppercase;
      animation: fadeInDown 1s ease-out;
    }

    .actors-list {
      display: flex;
      gap: 1.2rem;
      overflow-x: auto;
      padding-bottom: 0.6rem;
      scroll-behavior: smooth;
    }

    .actor-card {
      width: 160px;
      text-align: center;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .actor-card:hover {
      transform: scale(1.1);
      box-shadow: 0 6px 15px rgba(0, 0, 0, 0.4);
    }

    .actor-card img {
      width: 100%;
      height: 220px;
      object-fit: cover;
      border-radius: 10px;
      margin-bottom: 0.6rem;
      transition: opacity 0.3s ease;
    }

    .actor-card:hover img {
      opacity: 0.9;
    }

    .actor-card p {
      font-size: 1rem;
      color: #D1D7E0;
    }

    .actor-card p a {
      color: #802BB1;
      text-decoration: none;
      transition: color 0.2s ease;
    }

    .actor-card p a:hover {
      color: #6A1F93;
      text-decoration: underline;
    }

    /* Similar Movies Section */
    .similar-movies-section {
      margin-top: 2.2rem;
    }

    .similar-movies-section h3 {
      font-size: 1.3rem;
      color: #D1D7E0;
      margin-bottom: 1.2rem;
      text-transform: uppercase;
      animation: fadeInDown 1s ease-out;
    }

    .similar-movies-list {
      display: flex;
      gap: 1.2rem;
      overflow-x: auto;
      padding-bottom: 0.6rem;
      scroll-behavior: smooth;
    }

    .movie-card {
      width: 160px;
      text-align: center;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .movie-card:hover {
      transform: scale(1.1);
      box-shadow: 0 6px 15px rgba(0, 0, 0, 0.4);
    }

    .movie-card img {
      width: 100%;
      height: 220px;
      object-fit: cover;
      border-radius: 10px;
      margin-bottom: 0.6rem;
      transition: opacity 0.3s ease;
    }

    .movie-card:hover img {
      opacity: 0.9;
    }

    .movie-card p {
      font-size: 1rem;
      color: #D1D7E0;
    }

    .movie-card p a {
      color: #802BB1;
      text-decoration: none;
      transition: color 0.2s ease;
    }

    .movie-card p a:hover {
      color: #6A1F93;
      text-decoration: underline;
    }

    /* Rating Breakdown Section */
    .rating-breakdown {
      margin-top: 2.2rem;
    }

    .rating-breakdown h3 {
      font-size: 1.3rem;
      color: #D1D7E0;
      margin-bottom: 1.2rem;
      text-transform: uppercase;
      animation: fadeInDown 1s ease-out;
    }

    .rating-bar {
      display: flex;
      align-items: center;
      gap: 0.6rem;
      margin-bottom: 0.6rem;
    }

    .rating-bar span {
      font-size: 1rem;
      color: #564F6F;
    }

    .rating-bar .bar {
      flex: 1;
      height: 10px;
      background-color: #4C495D;
      border-radius: 5px;
      overflow: hidden;
    }

    .rating-bar .bar-fill {
      height: 100%;
      background-color: #802BB1;
      transition: width 0.5s ease-in-out;
      animation: fillBar 1s ease-out;
    }

    @keyframes fillBar {
      from { width: 0; }
      to { width: var(--fill-width); }
    }

    /* User Stats Section */
    .user-stats {
      margin-top: 2.2rem;
    }

    .user-stats h3 {
      font-size: 1.3rem;
      color: #D1D7E0;
      margin-bottom: 1.2rem;
      text-transform: uppercase;
      animation: fadeInDown 1s ease-out;
    }

    .stats-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 1.2rem;
    }

    .stat-item {
      background-color: #4C495D;
      padding: 1.2rem;
      border-radius: 8px;
      text-align: center;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .stat-item:hover {
      transform: translateY(-5px);
      box-shadow: 0 6px 15px rgba(0, 0, 0, 0.3);
    }

    .stat-item h4 {
      font-size: 1.1rem;
      color: #D1D7E0;
      margin-bottom: 0.6rem;
    }

    .stat-item p {
      font-size: 1rem;
      color: #564F6F;
    }

    /* Top Review Section */
    .top-review-section {
      margin-top: 2.2rem;
    }

    .top-review-section h3 {
      font-size: 1.3rem;
      color: #D1D7E0;
      margin-bottom: 1.2rem;
      text-transform: uppercase;
      animation: fadeInDown 1s ease-out;
    }

    .review {
      background-color: #4C495D;
      padding: 1.2rem;
      border-radius: 8px;
      margin-bottom: 0.6rem;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .review:hover {
      transform: translateY(-5px);
      box-shadow: 0 6px 15px rgba(0, 0, 0, 0.3);
    }

    .review p {
      font-size: 1rem;
      color: #D1D7E0;
    }

    .review .review-meta {
      font-size: 0.9rem;
      color: #564F6F;
      margin-top: 0.6rem;
    }

    /* Social Activity Section */
    .social-activity-section {
      margin-top: 2.2rem;
    }

    .social-activity-section h3 {
      font-size: 1.3rem;
      color: #D1D7E0;
      margin-bottom: 1.2rem;
      text-transform: uppercase;
      animation: fadeInDown 1s ease-out;
    }

    .activity {
      background-color: #4C495D;
      padding: 0.9rem;
      border-radius: 8px;
      margin-bottom: 0.6rem;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .activity:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }

    .activity p {
      font-size: 1rem;
      color: #D1D7E0;
    }

    /* Where to Watch Section */
    .where-to-watch-section {
      margin-top: 2.2rem;
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
        padding: 5rem 1rem 1rem;
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

      .actors-list, .similar-movies-list {
        flex-wrap: nowrap;
      }

      .stats-grid {
        grid-template-columns: 1fr;
      }

      .top-nav {
        flex-direction: column;
        padding: 0.5rem 1rem;
      }

      .top-nav .nav-right {
        flex-direction: column;
        gap: 0.5rem;
        width: 100%;
      }

      .top-nav nav ul {
        gap: 0.8rem;
      }
    }
  </style>
</head>
<body>
  <!-- Top Navigation -->
  <header class="top-nav">
    <div class="nav-left">
      <a href="#" class="logo">trakt</a>
    </div>
    <div class="nav-right">
      <nav>
        <ul>
          <li><a href="#">Home</a></li>
          <li><a href="#">Shows</a></li>
          <li><a href="#">Movies</a></li>
        </ul>
      </nav>
      <button class="join-btn">Join Trakt</button>
    </div>
  </header>

  <!-- Main Content -->
  <div class="main-container">
    <div class="background-image"></div>
    <div class="background-overlay"></div>
    <div class="content-container">
      <div class="poster-section">
        <img src="large.jpg" alt="Black Bag 2025 Poster">
        <div class="poster-text">Black Bag</div>
        <button class="interactive-btn">
          ⓘ
          <span class="tooltip">Share or Info</span>
        </button>
      </div>
      <div class="info-section">
        <h1 class="title">Black Bag</h1>
        <div class="genres">Thriller / Drama / Mystery</div>
        <div class="metadata">
          <span class="trakt-rating">❤️ 68% <span style="color: #564F6F;">2.71K</span></span>
          <span class="imdb-rating">⭐ 6.9/31.6K</span>
          <span style="color: #564F6F;">0 watching</span>
          <span style="color: #564F6F;">2025 227K plays</span>
          <span class="certification">R</span>
        </div>
        <div class="actions">
          <button class="rate-btn">Rate</button>
          <button class="watchlist-btn">Add to Watchlist</button>
          <button class="trailer-btn">Watch Trailer</button>
          <button class="share-btn">Share</button>
        </div>
        <p class="overview-text">
          When intelligence agent Kathryn Woodhouse is suspected of betraying the nation, her husband – also a legendary agent – faces the ultimate test of whether to be loyal to his marriage, or his country.
        </p>
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
            <h3>Director</h3>
            <p><a href="#">Steven Soderbergh (Director)</a></p>
          </div>
          <div>
            <h3>Writer</h3>
            <p><a href="#">David Koepp (Writer)</a></p>
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
          <div>
            <h3>Genre</h3>
            <p>Thriller / Drama <button class="more-btn">+ 1 more</button></p>
          </div>
        </div>

        <!-- Tabs -->
        <div class="tabs">
          <button class="tab active" data-tab="overview">Overview</button>
          <button class="tab" data-tab="comments">Comments</button>
          <button class="tab" data-tab="rating">Rating</button>
          <button class="tab" data-tab="more">More</button>
        </div>

        <!-- Tab Content -->
        <div class="tab-content active" id="overview">
          <p class="overview-text">
            When intelligence agent Kathryn Woodhouse is suspected of betraying the nation, her husband – also a legendary agent – faces the ultimate test of whether to be loyal to his marriage, or his country.
          </p>
          <ul class="details-list">
            <li><strong>Director:</strong> Steven Soderbergh</li>
            <li><strong>Writer:</strong> David Koepp</li>
            <li><strong>Stars:</strong> Michael Fassbender, Cate Blanchett</li>
            <li><strong>Genres:</strong> Thriller, Drama, Mystery</li>
          </ul>
        </div>

        <div class="tab-content" id="comments">
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

        <div class="tab-content" id="rating">
          <div class="rating-section">
            <h3>Rate This Movie</h3>
            <div class="rating-stars">
              <span class="rating-star" data-value="1">★</span>
              <span class="rating-star" data-value="2">★</span>
              <span class="rating-star" data-value="3">★</span>
              <span class="rating-star" data-value="4">★</span>
              <span class="rating-star" data-value="5">★</span>
            </div>
            <div class="rating-value" id="rating-value">Not rated yet</div>
          </div>
        </div>

        <div class="tab-content" id="more">
          <p>Additional info or similar movies...</p>
          <button class="watchlist-btn">Add to Watchlist</button>
          <button class="trailer-btn">Watch Trailer</button>
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

        <!-- Actors Section -->
        <div class="actors-section">
          <h3>Actors</h3>
          <div class="actors-list">
            <div class="actor-card">
              <img src="https://via.placeholder.com/150x200" alt="Michael Fassbender">
              <p><a href="#">Michael Fassbender</a></p>
            </div>
            <div class="actor-card">
              <img src="https://via.placeholder.com/150x200" alt="Cate Blanchett">
              <p><a href="#">Cate Blanchett</a></p>
            </div>
            <div class="actor-card">
              <img src="https://via.placeholder.com/150x200" alt="Actor 3">
              <p><a href="#">Actor 3</a></p>
            </div>
            <div class="actor-card">
              <img src="https://via.placeholder.com/150x200" alt="Actor 4">
              <p><a href="#">Actor 4</a></p>
            </div>
          </div>
        </div>

        <!-- Similar Movies Section -->
        <div class="similar-movies-section">
          <h3>Similar Movies</h3>
          <div class="similar-movies-list">
            <div class="movie-card">
              <img src="https://via.placeholder.com/150x200" alt="Movie 1">
              <p><a href="#">Movie 1</a></p>
            </div>
            <div class="movie-card">
              <img src="https://via.placeholder.com/150x200" alt="Movie 2">
              <p><a href="#">Movie 2</a></p>
            </div>
            <div class="movie-card">
              <img src="https://via.placeholder.com/150x200" alt="Movie 3">
              <p><a href="#">Movie 3</a></p>
            </div>
            <div class="movie-card">
              <img src="https://via.placeholder.com/150x200" alt="Movie 4">
              <p><a href="#">Movie 4</a></p>
            </div>
          </div>
        </div>

        <!-- Rating Breakdown Section -->
        <div class="rating-breakdown">
          <h3>Rating Breakdown</h3>
          <div class="rating-bar">
            <span>5 stars</span>
            <div class="bar">
              <div class="bar-fill" style="--fill-width: 40%;"></div>
            </div>
            <span>40%</span>
          </div>
          <div class="rating-bar">
            <span>4 stars</span>
            <div class="bar">
              <div class="bar-fill" style="--fill-width: 30%;"></div>
            </div>
            <span>30%</span>
          </div>
          <div class="rating-bar">
            <span>3 stars</span>
            <div class="bar">
              <div class="bar-fill" style="--fill-width: 20%;"></div>
            </div>
            <span>20%</span>
          </div>
          <div class="rating-bar">
            <span>2 stars</span>
            <div class="bar">
              <div class="bar-fill" style="--fill-width: 8%;"></div>
            </div>
            <span>8%</span>
          </div>
          <div class="rating-bar">
            <span>1 star</span>
            <div class="bar">
              <div class="bar-fill" style="--fill-width: 2%;"></div>
            </div>
            <span>2%</span>
          </div>
        </div>

        <!-- User Stats Section -->
        <div class="user-stats">
          <h3>User Stats</h3>
          <div class="stats-grid">
            <div class="stat-item">
              <h4>Total Views</h4>
              <p>227K</p>
            </div>
            <div class="stat-item">
              <h4>Watchlists</h4>
              <p>15K</p>
            </div>
            <div class="stat-item">
              <h4>Comments</h4>
              <p>1.2K</p>
            </div>
          </div>
        </div>

        <!-- Top Review Section -->
        <div class="top-review-section">
          <h3>Top Review</h3>
          <div class="review">
            <p><strong>User3:</strong> This movie was a thrilling ride from start to finish! The tension between the characters was palpable.</p>
            <div class="review-meta">Posted 2 days ago</div>
          </div>
        </div>

        <!-- Social Activity Section -->
        <div class="social-activity-section">
          <h3>Social Activity</h3>
          <div class="activity">
            <p><strong>User4</strong> watched Black Bag.</p>
          </div>
          <div class="activity">
            <p><strong>User5</strong> added Black Bag to their watchlist.</p>
          </div>
        </div>
      </div>
    </div>
  </div>

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

    // Interactive Button
    const interactiveBtn = document.querySelector('.interactive-btn');
    interactiveBtn.addEventListener('click', () => {
      alert('Info or Share Action');
    });

    // Watchlist Button
    const watchlistBtns = document.querySelectorAll('.watchlist-btn');
    watchlistBtns.forEach(btn => {
      btn.addEventListener('click', () => {
        btn.textContent = btn.textContent === 'Add to Watchlist' ? 'Added to Watchlist' : 'Add to Watchlist';
        btn.style.backgroundColor = btn.textContent === 'Added to Watchlist' ? '#4C495D' : '#564F6F';
      });
    });

    // Trailer Button
    const trailerBtns = document.querySelectorAll('.trailer-btn');
    trailerBtns.forEach(btn => {
      btn.addEventListener('click', () => {
        alert('Playing Trailer...');
      });
    });

    // Share Button
    const shareBtn = document.querySelector('.share-btn');
    shareBtn.addEventListener('click', () => {
      const shareUrl = window.location.href;
      navigator.clipboard.writeText(shareUrl).then(() => {
        alert('Link copied to clipboard: ' + shareUrl);
      }).catch(err => {
        alert('Failed to copy link: ' + err);
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

    // More Button for Genre
    const moreBtn = document.querySelector('.more-btn');
    moreBtn.addEventListener('click', () => {
      const parent = moreBtn.parentElement;
      parent.innerHTML = 'Thriller / Drama / Mystery';
    });

    // Animate Rating Bars on Scroll
    const ratingBars = document.querySelectorAll('.rating-bar .bar-fill');
    const animateBars = () => {
      ratingBars.forEach(bar => {
        const width = bar.style.getPropertyValue('--fill-width');
        bar.style.width = '0%';
        setTimeout(() => {
          bar.style.width = width;
        }, 100);
      });
    };

    window.addEventListener('scroll', () => {
      const ratingSection = document.querySelector('.rating-breakdown');
      const rect = ratingSection.getBoundingClientRect();
      if (rect.top < window.innerHeight && rect.bottom >= 0) {
        animateBars();
      }
    });

    // Initial Animation
    document.addEventListener('DOMContentLoaded', animateBars);
  </script>
</body>
</html>