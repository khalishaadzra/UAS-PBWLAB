{{-- resources/views/pages/watchlist.blade.php --}}
@extends('layouts.layout')

@section('content')
<style>
    body {
        /* === PERUBAHAN UTAMA ADA DI SINI === */
        top: 85px; /* GANTI 85px DENGAN TINGGI NAVBAR ANDA + SEDIKIT SPASI */
        position: relative;
        /* =================================== */
        background: linear-gradient(135deg, #2D283E 0%, #4C495D 100%);
        min-height: calc(100vh - 85px); /* Sesuaikan juga ini dengan nilai 'top' di atas */
        padding-bottom: 2rem;
        color: var(--text, #D1D7E0);
    }

    /* Style lain yang sudah Anda miliki untuk halaman watchlist bisa tetap di sini */
    /* Contoh dari kode Anda sebelumnya: */
    .watchlist-container {
       text-align: center;
       /* min-height: 70vh; Anda mungkin tidak butuh ini lagi jika body sudah di-offset */
       display: flex;
       flex-direction: column;
       align-items: center;
       justify-content: center;
    }
    .empty-watchlist i { font-size: 5rem; color: var(--gray, #564F6F); margin-bottom: 1rem; }
    .empty-watchlist h2 { font-size: 1.5rem; color: var(--text, #D1D7E0); margin-bottom: 0.5rem; }
    .empty-watchlist p { font-size: 1rem; color: var(--gray, #564F6F); margin-bottom: 1.5rem; }
    /* ... tambahkan style lain yang sudah Anda buat untuk header tabel, item, dll. ... */

</style>

{{-- Kontainer utama konten Anda, pastikan tidak ada padding-top yang berlebihan di sini jika body sudah di-offset --}}
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-10">
        <h1 class="text-4xl font-bold">My Watchlist</h1>
        <span class="text-lg text-gray-300">All your saved movies and series</span>
    </div>

    <div class="mt-8">
        {{-- Data akan diambil dari variabel $watchlistItems yang dikirim controller --}}
        @if(isset($watchlistItems) && $watchlistItems->count() > 0)
            <div class="grid grid-cols-12 gap-4 px-4 py-2 bg-secondary/50 rounded-lg">
                <!-- Header -->
                <div class="col-span-1 md:col-span-1 font-medium text-center">Poster</div>
                <div class="col-span-4 md:col-span-4 font-medium">Judul</div>
                <div class="col-span-3 md:col-span-3 font-medium text-center">Status</div>
                <div class="col-span-2 md:col-span-2 font-medium text-center">Tipe</div>
                <div class="col-span-2 md:col-span-2 font-medium text-center">Aksi</div>
            </div>

            <!-- Watchlist Items -->
            @foreach($watchlistItems as $item) {{-- Asumsi $watchlistItems adalah hasil paginasi dari relasi Movie --}}
            <div class="grid grid-cols-12 gap-4 items-center bg-primary/30 rounded-lg p-2 hover:bg-primary/50 transition">
                {{-- Kolom Poster --}}
                <div class="col-span-1 md:col-span-1">
                    <a href="{{ route('movies.show', $item->id) }}"> {{-- Link ke halaman detail movie --}}
                        <img src="{{ $item->poster_url ? $item->poster_url : asset('images/poster_placeholder.png') }}"
                             alt="{{ $item->title }} Poster"
                             class="w-16 h-24 object-cover rounded-md"
                             onerror="this.onerror=null;this.src='{{ asset('images/poster_placeholder.png') }}';">
                    </a>
                </div>

                {{-- Kolom Judul & Tahun --}}
                <div class="col-span-4 md:col-span-4">
                    <a href="{{ route('movies.show', $item->id) }}" class="hover:text-accent">
                        <h3 class="font-semibold">{{ $item->title }}</h3>
                    </a>
                    <p class="text-sm text-gray-400">{{ $item->tahun_rilis }}</p>
                </div>

                {{-- Kolom Status (Dropdown JavaScript Anda yang sebelumnya) --}}
                <div class="col-span-3 md:col-span-3">
                    <div class="relative">
                        <button id="status-button-{{ $item->id }}" class="w-full flex items-center justify-between bg-secondary px-4 py-2 rounded-md text-sm" onclick="toggleDropdown('status-dropdown-{{ $item->id }}')">
                            <span id="status-text-{{ $item->id }}">{{ $item->pivot->status ?? 'Belum nonton' }}</span>
                            <i class="fas fa-chevron-down text-xs"></i>
                        </button>
                        <div id="status-dropdown-{{ $item->id }}" class="absolute hidden z-20 mt-1 w-full bg-secondary rounded-md shadow-lg border border-gray-700">
                            <div class="py-1">
                                <a href="#" class="status-option block px-4 py-2 hover:bg-primary text-sm"
                                   onclick="event.preventDefault(); updateWatchlistStatus({{ $item->id }}, 'Belum nonton')">Belum nonton</a>
                                <a href="#" class="status-option block px-4 py-2 hover:bg-primary text-sm"
                                   onclick="event.preventDefault(); updateWatchlistStatus({{ $item->id }}, 'Sedang nonton')">Sedang nonton</a>
                                <a href="#" class="status-option block px-4 py-2 hover:bg-primary text-sm"
                                   onclick="event.preventDefault(); updateWatchlistStatus({{ $item->id }}, 'Selesai nonton')">Selesai nonton</a>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Kolom Tipe Film/Series --}}
                <div class="col-span-2 md:col-span-2 text-center text-sm text-gray-400">
                    {{ $item->tipe }}
                </div>

                {{-- Kolom Aksi Hapus --}}
                <div class="col-span-2 md:col-span-2 text-center">
                    <form action="{{ route('watchlist.remove', $item->id) }}" method="POST" onsubmit="return confirm('Hapus {{ $item->title }} dari watchlist?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-400 hover:text-red-600 transition">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
            {{-- Paginasi --}}
            @if ($watchlistItems->hasPages())
            <div class="mt-8">
                {{ $watchlistItems->links('pagination::tailwind') }}
            </div>
            @endif
        @else
            <div class="flex flex-col items-center justify-center py-20 text-center watchlist-container"> {{-- Tambahkan watchlist-container jika perlu style spesifik --}}
                <div class="text-7xl mb-4 opacity-30">
                    <i class="fas fa-film"></i>
                </div>
                <h3 class="text-2xl font-medium text-gray-400 mb-2">Your watchlist is empty</h3>
                <p class="text-gray-500 mb-6">Start adding movies or TV shows from the details page</p>
                <a href="{{ route('movies.index') }}" class="px-6 py-3 bg-accent text-primary font-medium rounded-lg hover:bg-opacity-90 transition">
                    Browse Movies
                </a>
            </div>
        @endif
    </div>
</div>

<script>
    // JavaScript Anda yang sudah ada untuk toggleDropdown dan updateWatchlistStatus
    // TIDAK SAYA UBAH, hanya fokus pada perbaikan tampilan tertimpa.
    function toggleDropdown(id) {
        const dropdown = document.getElementById(id);
        if (dropdown) {
            dropdown.classList.toggle('hidden');
        }
    }

    function updateWatchlistStatus(movieId, newStatus) {
        const statusTextElement = document.getElementById('status-text-' + movieId);
        const dropdownElement = document.getElementById('status-dropdown-' + movieId);

        if (statusTextElement) {
            statusTextElement.textContent = newStatus;
        }
        if (dropdownElement) {
            dropdownElement.classList.add('hidden');
        }

        fetch(`{{ url('/watchlist/update-status') }}/${movieId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ status: newStatus })
        })
        .then(response => {
            if (!response.ok) { throw new Error('Network response was not ok'); }
            return response.json();
        })
        .then(data => { console.log('Status updated:', data); })
        .catch(error => {
            console.error('Error updating status:', error);
            alert('Gagal mengupdate status.');
        });
    }

    window.addEventListener('click', function(e) {
        const allDropdowns = document.querySelectorAll('[id^="status-dropdown-"]');
        allDropdowns.forEach(dropdown => {
            const buttonId = 'status-button-' + dropdown.id.replace('status-dropdown-', '');
            const button = document.getElementById(buttonId);
            if (button && !button.contains(e.target) && !dropdown.contains(e.target)) {
                dropdown.classList.add('hidden');
            }
        });
    });
</script>
@endsection