<!-- resources/views/components/navbar.blade.php -->
<nav id="navbar" class="fixed top-0 left-0 right-0 bg-opacity-80 backdrop-blur-md bg-secondary z-40 transition-all duration-300">
    <div class="container mx-auto px-4 py-4 flex justify-between items-center">
        <a href="#" class="text-2xl font-bold text-white flex items-center">
            <img src="{{ asset('Watchverse.svg') }}" alt="logo" class="h-8">
        </a>
        <div class="hidden md:flex space-x-6">
            <button class="text-white hover:text-accent">About</button>
            <button class="text-white hover:text-accent">Offer</button>
            <button class="text-white hover:text-accent">Features</button>
            <a href="#" class="text-white hover:text-accent">Contact</a>
        </div>
        <button class="bg-secondary hover:bg-opacity-90 text-white px-6 py-4 rounded-md">Create an account</button>
    </div>
</nav>
