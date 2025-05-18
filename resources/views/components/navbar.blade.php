<nav id="navbar" class="fixed top-0 left-0 right-0 bg-[#2D283E] bg-opacity-80 backdrop-blur-md z-40 transition-all duration-300 shadow-md">
    <div class="container mx-auto px-4 py-4 flex justify-between items-center">
        <!-- Logo -->
        <a href="{{ url('/') }}" class="text-2xl font-bold text-[#D1D7E0] flex items-center transition-transform duration-300 hover:scale-105">
            <img src="{{ asset('Watchverse.svg') }}" alt="logo" class="h-8 mr-2 filter drop-shadow-md">
        </a>

        <!-- Menu + Profile -->
        <div class="hidden md:flex items-center space-x-6 gap-8">
            <a href="{{ route('beranda') }}" class="text-[#D1D7E0] text-base font-medium hover:text-[#802BB1] transition-all duration-300 hover:scale-105">Home</a>
            <a href="{{ route('series.index') }}" class="text-[#D1D7E0] text-base font-medium hover:text-[#802BB1] transition-all duration-300 hover:scale-105">Series</a>
            <a href="{{ route('movies.index') }}" class="text-[#D1D7E0] text-base font-medium hover:text-[#802BB1] transition-all duration-300 hover:scale-105">Movies</a>
            <a href="{{ route('watchlist') }}" class="text-[#D1D7E0] text-base font-medium hover:text-[#802BB1] transition-all duration-300 hover:scale-105">Watchlist</a>

            @auth {{-- Tampil jika pengguna sudah login --}}
            <!-- Profile Button & Dropdown -->
            <div class="relative">
                <button id="profileButton" class="text-[#D1D7E0] text-xl hover:text-[#802BB1] transition-all duration-300 focus:outline-none transform hover:scale-110 flex items-center">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=random&color=fff&size=32&rounded=true" alt="User Avatar" class="w-8 h-8 rounded-full mr-2 border-2 border-transparent group-hover:border-accent transition-all">
                    <span class="text-base font-medium">{{ Auth::user()->name }}</span>
                    {{-- Jika ingin ikon user FontAwesome: <i class="fas fa-user-circle drop-shadow-md"></i> --}}
                </button>

                <!-- Popup profil -->
                <div id="profilePopup" class="absolute right-0 mt-2 w-56 bg-[#4C495D] rounded-lg shadow-xl p-0 hidden z-50 border border-[#564F6F] opacity-0 transform scale-95 transition-all duration-200 origin-top-right">
                    <div class="p-4 border-b border-[#564F6F]">
                        <p class="text-sm text-[#D1D7E0] mb-1">
                            Login sebagai
                        </p>
                        <p class="font-semibold text-white truncate" title="{{ Auth::user()->email }}">{{ Auth::user()->name }}</p>
                    </div>
                    <div class="py-1">
                        <!-- Form Logout -->
                        <form method="POST" action="{{ route('logout') }}" id="logout-form-navbar">
                            @csrf
                            <button type="button" {{-- Ubah jadi button type="button" agar tidak submit form utama jika ada --}}
                                    onclick="document.getElementById('logout-form-navbar').submit();"
                                    class="w-full text-left px-4 py-2 text-sm text-[#ee5a5a] hover:bg-[#564F6F] hover:text-[#ff7878] transition-colors duration-150 flex items-center">
                                <i class="fas fa-sign-out-alt mr-2"></i>Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @else {{-- Tampil jika pengguna belum login --}}
                <a href="{{ route('page.auth') }}" class="text-[#D1D7E0] text-base font-medium hover:text-[#802BB1] transition-all duration-300 hover:scale-105 flex items-center">
                    <i class="fas fa-sign-in-alt mr-2"></i> Login/Register
                </a>
            @endguest
        </div>
    </div>

    <!-- Inline CSS for Navbar and Popup -->
    <style>
        /* ... CSS Anda yang sudah ada ... */
        /* Pastikan #navbar.bg-transparent dan #navbar:not(.bg-transparent) sudah benar */

        #profilePopup.show { /* Ganti dari logoutPopup ke profilePopup */
            display: block;
            opacity: 1;
            transform: scale(1);
        }
    </style>

    <!-- Inline JavaScript for Popup Toggle -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const profileButton = document.getElementById('profileButton');
            const profilePopup = document.getElementById('profilePopup'); // Ganti dari logoutPopup

            if (profileButton && profilePopup) {
                profileButton.addEventListener('click', (e) => {
                    e.stopPropagation();
                    profilePopup.classList.toggle('show');
                });

                document.addEventListener('click', (e) => {
                    if (!profilePopup.contains(e.target) && e.target !== profileButton && !profileButton.contains(e.target) ) {
                        profilePopup.classList.remove('show');
                    }
                });

                profilePopup.addEventListener('click', (e) => {
                    e.stopPropagation();
                });
            }

            // Navbar scroll behavior (pindahkan ke sini jika belum ada atau dari beranda.blade.php)
            const navbar = document.querySelector('#navbar');
            if (navbar) {
                window.addEventListener('scroll', () => {
                    if (window.scrollY > 50) { // Ubah nilai 50 sesuai kebutuhan
                        navbar.classList.remove('bg-transparent');
                        // Class untuk background saat scroll sudah Anda atur di style: #navbar:not(.bg-transparent)
                    } else {
                        navbar.classList.add('bg-transparent');
                    }
                });
                 // Panggil sekali saat load untuk set initial state
                if (window.scrollY > 50) {
                    navbar.classList.remove('bg-transparent');
                } else {
                    navbar.classList.add('bg-transparent');
                }
            }
        });
    </script>
</nav>