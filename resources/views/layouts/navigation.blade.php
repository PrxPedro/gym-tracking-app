<nav class="bg-white dark:bg-gray-800 shadow">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Left-side Navigation Links -->
            <div class="flex space-x-4">
                <a href="{{ url('/') }}" class="text-gray-500 hover:text-gray-700 dark:hover:text-gray-300 {{ request()->is('/') ? 'font-bold text-gray-700 dark:text-gray-200' : '' }}">Home</a>
                <a href="{{ url('/workouts') }}" class="text-gray-500 hover:text-gray-700 dark:hover:text-gray-300 {{ request()->is('workouts*') ? 'font-bold text-gray-700 dark:text-gray-200' : '' }}">Workout Plans</a>
                
                <!-- Community Dropdown with Toggle on Click -->
                <div class="relative" x-data="{ open: false }">
                    <!-- Toggle Dropdown on Click -->
                    <button @click="open = !open" class="text-gray-500 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none {{ request()->is('community*') ? 'font-bold text-gray-700 dark:text-gray-200' : '' }}">
                        Community
                    </button>
                    <!-- Dropdown Menu -->
                    <div x-show="open" @click.away="open = false" x-cloak
                         class="absolute left-0 mt-2 w-40 bg-white dark:bg-gray-700 rounded-md shadow-lg z-10">
                        <a href="{{ route('community.index') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-t-md">Community Posts</a>
                        <!-- Additional links can be added here if needed -->
                    </div>
                </div>
            </div>

            <!-- Right-side Auth Links -->
            <div class="flex items-center space-x-4">
                @if (Auth::check())
                    <span class="text-gray-500 dark:text-gray-300">Welcome, {{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-gray-500 hover:text-gray-700 dark:hover:text-gray-300">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-gray-500 hover:text-gray-700 dark:hover:text-gray-300">Login</a>
                    <a href="{{ route('register') }}" class="text-gray-500 hover:text-gray-700 dark:hover:text-gray-300">Sign Up</a>
                @endif
            </div>
        </div>
    </div>
</nav>
