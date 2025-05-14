<nav id="navbar" class="fixed top-0 left-0 right-0 bg-[#2D283E] bg-opacity-80 backdrop-blur-md z-40 transition-all duration-300 shadow-md">
    <div class="container mx-auto px-4 py-4 flex justify-between items-center">
        <!-- Logo -->
        <a href="#" class="text-2xl font-bold text-[#D1D7E0] flex items-center transition-transform duration-300 hover:scale-105">
            <img src="{{ asset('Watchverse.svg') }}" alt="logo" class="h-8 mr-2 filter drop-shadow-md">
        </a>

        <!-- Menu + Profile -->
        <div class="hidden md:flex items-center space-x-6 gap-8">
            <a href="home" class="text-[#D1D7E0] text-base font-medium hover:text-[#802BB1] transition-all duration-300 hover:scale-105">Home</a>
            <a href="series" class="text-[#D1D7E0] text-base font-medium hover:text-[#802BB1] transition-all duration-300 hover:scale-105">Series</a>
            <a href="movie" class="text-[#D1D7E0] text-base font-medium hover:text-[#802BB1] transition-all duration-300 hover:scale-105">Movies</a>
            <a href="watchlist" class="text-[#D1D7E0] text-base font-medium hover:text-[#802BB1] transition-all duration-300 hover:scale-105">Watchlist</a>

            <!-- Profile Button -->
            <div>
                <button id="profileButton" class="text-[#7F8487] text-xl hover:text-[#802BB1] transition-all duration-300 focus:outline-none transform hover:scale-110">
                    <i class="fas fa-user-circle drop-shadow-md"></i>
                </button>

                <!-- Popup profil -->
                <div id="logoutPopup" class="absolute right-4 mt-2 w-56 bg-[#4C495D] rounded-lg shadow-xl p-4 hidden z-50 border border-[#564F6F] opacity-0 transform scale-95 transition-all duration-200">
                    <p class="text-sm text-[#D1D7E0] mb-3">
                        Login sebagai <strong class="text-[#D1D7E0] font-semibold">NamaUser</strong>
                    </p>
                    <button id="logoutConfirmBtn" class="w-full text-left text-[#ee5a5a] hover:text-[#af0000] hover:underline transition-all duration-150 flex items-center">
                        <i class="fas fa-sign-out-alt mr-2"></i>Logout
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Inline CSS for Navbar and Popup -->
    <style>
        /* Ensure bg-transparent works */
        #navbar.bg-transparent {
            background: transparent !important; /* Override gradient when transparent */
            backdrop-filter: none; /* Remove blur when transparent */
        }

        /* Default navbar styling with gradient */
        #navbar:not(.bg-transparent) {
            background: linear-gradient(to bottom, rgba(45, 40, 62, 0.8), #2D283E 90%) !important;
        }

        /* Text Shadow for Logo */
        .text-shadow {
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        /* Popup Positioning and Styling */
        #logoutPopup {
            top: 100%; /* Position below the navbar */
        }

        #logoutPopup.show {
            display: block;
            opacity: 1;
            transform: scale(1);
        }

        /* Hover Effect for Profile Button */
        #profileButton:hover i {
            filter: drop-shadow(0 0 5px rgba(128, 43, 177, 0.5));
        }
    </style>

    <!-- Inline JavaScript for Popup Toggle -->
    <script>
        // Get elements
        const profileButton = document.getElementById('profileButton');
        const logoutPopup = document.getElementById('logoutPopup');
        const logoutConfirmBtn = document.getElementById('logoutConfirmBtn');

        // Toggle popup on profile button click
        profileButton.addEventListener('click', (e) => {
            e.stopPropagation(); // Prevent click from bubbling up to document
            logoutPopup.classList.toggle('show');
        });

        // Close popup when clicking outside
        document.addEventListener('click', (e) => {
            if (!logoutPopup.contains(e.target) && e.target !== profileButton) {
                logoutPopup.classList.remove('show');
            }
        });

        // Prevent popup from closing when clicking inside it
        logoutPopup.addEventListener('click', (e) => {
            e.stopPropagation();
        });

        // Logout button functionality (for demonstration)
        logoutConfirmBtn.addEventListener('click', () => {
            alert('Logging out...');
            logoutPopup.classList.remove('show');
            // Add actual logout logic here (e.g., redirect to logout route)
        });
    </script>
</nav>