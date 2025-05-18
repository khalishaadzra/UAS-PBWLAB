{{-- resources/views/pages/partials/review-section.blade.php --}}
<div class="review-section">
    <h3 class="section-title-desc">Rate & Review This Movie</h3>
    @auth
        @if (!$userHasReviewed)
            <form action="{{ route('reviews.store', $movie->id) }}" method="POST" class="comment-form mb-8 p-6 bg-opacity-25 bg-gray-500 rounded-lg shadow-md">
                @csrf
                <div class="mb-3">
                    <label for="rating" class="block text-sm font-medium text-gray-300 mb-1">Your Rating:</label>
                    <div class="rating-stars flex items-center" id="add_rating_stars_container">
                        @for ($i = 1; $i <= 5; $i++)
                        <input type="radio" name="rating" id="add_rate-{{ $i }}" value="{{ $i }}" class="sr-only peer add-rate-star" {{ old('rating') == $i ? 'checked' : '' }} required>
                        <label for="add_rate-{{ $i }}" class="rating-star text-3xl cursor-pointer" data-value="{{ $i }}">★</label>
                        @endfor
                    </div>
                    @error('rating') <span class="text-xs text-red-400 block mt-1">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label for="comment" class="block text-sm font-medium text-gray-300 mb-1">Your Comment:</label>
                    <textarea name="comment" id="comment" rows="4" class="w-full p-3 bg-gray-800 border border-gray-600 rounded-md text-white focus:ring-accent-desc focus:border-accent-desc" placeholder="Write your review here...">{{ old('comment') }}</textarea>
                    @error('comment') <span class="text-xs text-red-400 block mt-1">{{ $message }}</span> @enderror
                </div>
                <div>
                    <button type="submit" class="add-comment-btn">Post Review</button>
                </div>
            </form>
        @else
            <div class="mb-8 p-6 bg-opacity-25 bg-gray-500 rounded-lg shadow-md">
                <h4 class="text-lg font-semibold text-white mb-2">Your Review:</h4>
                <div class="rating-stars mb-1">
                    @for ($i = 1; $i <= 5; $i++)
                        <span class="rating-star text-2xl {{ $i <= $userReview->rating ? 'active' : '' }}">★</span>
                    @endfor
                </div>
                <p class="text-gray-300 mb-3">{{ $userReview->comment }}</p>
                <button onclick="openEditReviewModal({{ $userReview->id }}, {{ $userReview->rating }}, '{{ addslashes(htmlspecialchars($userReview->comment)) }}')" class="text-sm text-blue-400 hover:text-blue-300">Edit Your Review</button>
            </div>
        @endif
    @else
        <p class="text-center text-gray-400 my-6">
            <a href="{{ route('login') }}?redirect={{ url()->current() }}" class="text-accent-desc hover:underline">Login</a> atau
            <a href="{{ route('register') }}?redirect={{ url()->current() }}" class="text-accent-desc hover:underline">Register</a>
            untuk memberikan review.
        </p>
    @endauth

    <h3 class="section-title-desc mt-10">User Comments</h3>
    <div class="comment-list space-y-4">
        @if ($reviews->isEmpty())
            <p class="text-gray-400">Belum ada komentar untuk film ini.</p>
        @else
            @foreach ($reviews as $review)
            <div class="comment p-4 rounded-lg shadow-md bg-opacity-25 bg-gray-500">
                <div class="flex items-start mb-2">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($review->user->name) }}&background=random&color=fff&size=40&rounded=true" alt="{{ $review->user->name }}" class="w-10 h-10 rounded-full mr-3">
                    <div>
                        <p class="font-semibold text-white">{{ $review->user->name }}</p>
                        <div class="rating-stars text-lg">
                            @for ($i = 1; $i <= 5; $i++)
                                <span class="rating-star {{ $i <= $review->rating ? 'active' : '' }}">★</span>
                            @endfor
                        </div>
                    </div>
                </div>
                <p class="text-gray-300 leading-relaxed mb-1">{{ $review->comment }}</p>
                <div class="comment-meta text-xs text-gray-500">{{ $review->created_at->diffForHumans() }}</div>

                @if(Auth::check() && Auth::id() == $review->user_id && ($userReview ? $review->id != $userReview->id : true))
                    <div class="mt-2 text-right space-x-2">
                        <button onclick="openEditReviewModal({{ $review->id }}, {{ $review->rating }}, '{{ addslashes(htmlspecialchars($review->comment)) }}')" class="text-xs text-blue-400 hover:text-blue-300">Edit</button>
                        <form action="{{ route('reviews.destroy', $review->id) }}" method="POST" class="inline" onsubmit="return confirm('Anda yakin ingin menghapus review ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-xs text-red-400 hover:text-red-300">Hapus</button>
                        </form>
                    </div>
                @endif
            </div>
            @endforeach
            <div class="mt-6">
                {{ $reviews->links('pagination::tailwind') }} {{-- Menggunakan view paginasi Tailwind --}}
            </div>
        @endif
    </div>
</div>

{{-- Modal Edit Review akan ada di desc.blade.php utama --}}

{{-- JavaScript untuk rating bintang dan modal edit, sebaiknya di-defer ke script utama di desc.blade.php atau file JS terpisah --}}
{{-- Untuk saat ini, pastikan fungsi setupStarRating, openEditReviewModal ada di desc.blade.php --}}
<script>
    // Panggil setupStarRating untuk form tambah review jika ada di halaman ini
    // Dipanggil dari desc.blade.php utama setelah DOMContentLoaded
    if (document.getElementById('add_rating_stars_container')) {
        setupStarRating('#add_rating_stars_container');
    }
</script>