<nav class="bg-white dark:bg-gray-800 shadow">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <div class="flex space-x-4"> <!-- Use space-x-4 for spacing -->
                <a href="{{ url('/') }}" class="text-gray-500 hover:text-gray-700 dark:hover:text-gray-300">Home</a>
                <a href="{{ url('/workouts') }}" class="text-gray-500 hover:text-gray-700 dark:hover:text-gray-300">Workout Plans</a>
            </div>
            <div class="flex items-center space-x-4"> <!-- Use space-x-4 for spacing -->
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
<!--test-->