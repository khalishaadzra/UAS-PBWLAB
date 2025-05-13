<!-- resources/views/components/navbar.blade.php -->
<nav id="navbar" class="fixed top-0 left-0 right-0 bg-opacity-80 backdrop-blur-md bg-secondary z-40 transition-all duration-300">
    <div class="container mx-auto px-4 py-4 flex justify-between items-center">
        <!-- Logo -->
        <a href="#" class="text-2xl font-bold text-white flex items-center">
            <img src="{{ asset('Watchverse.svg') }}" alt="logo" class="h-8">
        </a>

        <!-- Menu + Profile -->
        <div class="hidden md:flex items-center space-x-6 gap-8">
            <button class="text-white hover:text-accent">Home</button>
            <button class="text-white hover:text-accent">Shows</button>
            <button class="text-white hover:text-accent">Movies</button>
            <a href="#" class="text-white hover:text-accent">Whistlist</a>

            <div class="relative">
    <button id="profileButton" class="text-[#7F8487] text-2xl hover:text-[#2A933C] transition duration-200 focus:outline-none">
        <i class="fas fa-user-circle"></i>
    </button>

    <!-- Popup profil -->
    <div id="logoutPopup" class="absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-lg p-4 hidden z-50 border border-gray-100">
        <p class="text-sm text-gray-500 mb-3">
            Login sebagai <strong class="text-gray-700">NamaUser</strong>
        </p>
        <button id="logoutConfirmBtn" class="w-full text-left text-red-500 hover:text-red-700 hover:underline transition duration-150">
            <i class="fas fa-sign-out-alt mr-2"></i>Logout
        </button>
    </div>
</div>
        </div>
    </div>
</nav>
