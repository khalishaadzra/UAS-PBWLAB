@extends('layouts.layout')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-10">
        <h1 class="text-4xl font-bold">Watchlist</h1>
        <span class="text-lg text-gray-300">All your watchlist here</span>
    </div>

    <div class="mt-8">
        @php
            // Dummy data example
            $watchlist = [
                (object) [
                    'id' => 1,
                    'title' => 'Star Wars: The Force Awakens',
                    'poster' => 'star-wars.png',
                    'year' => '2015',
                    'status' => 'Belum nonton'
                ]
            ];
        @endphp
        @if(count($watchlist ?? []) > 0)
            <div class="grid grid-cols-1 gap-6">
                <!-- Header -->
                <div class="grid grid-cols-12 gap-4 px-4 py-2 bg-secondary/50 rounded-lg">
                    <div class="col-span-5 font-medium text-center">Judul</div>
                    <div class="col-span-5 font-medium text-center">Status</div>
                    <div class="col-span-2 font-medium text-center">Hapus</div>
                </div>
                
                <!-- Watchlist Items -->
                @foreach($watchlist ?? [] as $item)
                <div class="grid grid-cols-12 gap-4 items-center bg-primary/30 rounded-lg p-2 hover:bg-primary/50 transition">
                    <div class="col-span-5 flex items-center space-x-4">
                        <img src="{{ $item->poster ?? 'https://via.placeholder.com/150x225' }}" alt="{{ $item->title ?? 'Movie Poster' }}" class="w-48 h-25 object-cover rounded-md">
                        <div>
                            <h3 class="font-semibold">{{ $item->title ?? 'Movie Title' }}</h3>
                            <p class="text-sm text-gray-400">{{ $item->year ?? '2023' }}</p>
                        </div>
                    </div>
                    
                    <div class="col-span-5">
                        <div class="relative">
                            <button id="status-button-{{ $item->id ?? 1 }}" class="w-full flex items-center justify-between bg-secondary px-4 py-2 rounded-md" onclick="toggleDropdown('status-dropdown-{{ $item->id ?? 1 }}')">
                                <span id="status-text-{{ $item->id ?? 1 }}">{{ $item->status ?? 'Belum nonton' }}</span>
                                <i class="fas fa-chevron-down text-xs"></i>
                            </button>
                            
                            <div id="status-dropdown-{{ $item->id ?? 1 }}" class="absolute hidden z-10 mt-1 w-full bg-secondary rounded-md shadow-lg">
                                <div class="py-1">
                                    <a href="#" class="status-option block px-4 py-2 hover:bg-primary text-sm" 
                                       onclick="updateStatus('{{ $item->id ?? 1 }}', 'Belum nonton')">Belum nonton</a>
                                    <a href="#" class="status-option block px-4 py-2 hover:bg-primary text-sm"
                                       onclick="updateStatus('{{ $item->id ?? 1 }}', 'Sedang nonton')">Sedang nonton</a>
                                    <a href="#" class="status-option block px-4 py-2 hover:bg-primary text-sm"
                                       onclick="updateStatus('{{ $item->id ?? 1 }}', 'Selesai nonton')">Selesai nonton</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-span-2 text-center">
                        <button onclick="removeFromWatchlist('{{ $item->id ?? 1 }}')" class="text-red-400 hover:text-red-600 transition">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="flex flex-col items-center justify-center py-20 text-center">
                <div class="text-7xl mb-4 opacity-30">
                    <i class="fas fa-film"></i>
                </div>
                <h3 class="text-2xl font-medium text-gray-400 mb-2">Your watchlist is empty</h3>
                <p class="text-gray-500 mb-6">Start adding movies or TV shows from the details page</p>
                <a href="/" class="px-6 py-3 bg-accent text-primary font-medium rounded-lg hover:bg-opacity-90 transition">
                    Browse Content
                </a>
            </div>
        @endif
    </div>
</div>

<script>
    function toggleDropdown(id) {
        document.getElementById(id).classList.toggle('hidden');
    }
    
    function updateStatus(itemId, newStatus) {
        // Update visual state immediately
        document.getElementById('status-text-' + itemId).textContent = newStatus;
        document.getElementById('status-dropdown-' + itemId).classList.add('hidden');
        
        // In a real application, you would send an AJAX request to update the database
        // Example:
        // fetch('/api/watchlist/' + itemId + '/status', {
        //     method: 'POST',
        //     headers: {
        //         'Content-Type': 'application/json',
        //         'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        //     },
        //     body: JSON.stringify({ status: newStatus })
        // })
        // .then(response => response.json())
        // .then(data => {
        //     console.log('Status updated successfully');
        // })
        // .catch(error => {
        //     console.error('Error updating status:', error);
        // });
    }
    
    function removeFromWatchlist(itemId) {
        // For demonstration purposes - animate and remove from DOM
        const itemElement = document.getElementById('status-button-' + itemId).closest('.grid');
        itemElement.classList.add('opacity-0');
        setTimeout(() => {
            itemElement.remove();
            
            // Check if watchlist is now empty and show empty state if needed
            const watchlistItems = document.querySelectorAll('.grid.grid-cols-12.gap-4.items-center');
            if (watchlistItems.length === 0) {
                location.reload(); // Simple approach to show empty state
            }
        }, 300);
        
        // In a real application, you would send an AJAX request to remove from database
        // Example:
        // fetch('/api/watchlist/' + itemId, {
        //     method: 'DELETE',
        //     headers: {
        //         'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        //     }
        // })
        // .then(response => response.json())
        // .then(data => {
        //     console.log('Removed successfully');
        // })
        // .catch(error => {
        //     console.error('Error removing item:', error);
        // });
    }
    
    // Close dropdowns when clicking outside
    window.addEventListener('click', function(e) {
        const dropdowns = document.querySelectorAll('[id^="status-dropdown-"]');
        dropdowns.forEach(dropdown => {
            const button = document.getElementById('status-button-' + dropdown.id.split('-')[2]);
            if (!button.contains(e.target) && !dropdown.contains(e.target)) {
                dropdown.classList.add('hidden');
            }
        });
    });
</script>
@endsection