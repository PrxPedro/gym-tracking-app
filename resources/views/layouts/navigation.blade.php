<nav class="bg-white dark:bg-gray-800 shadow">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Left-side Navigation Links -->
<div class="flex">
    <a href="{{ url('/') }}" class="px-4 text-gray-500 hover:text-gray-700 dark:hover:text-gray-300 {{ request()->is('/') ? 'font-bold text-gray-700 dark:text-gray-200' : '' }} text-lg">Home</a>
    <a href="{{ url('/workouts') }}" class="px-4 text-gray-500 hover:text-gray-700 dark:hover:text-gray-300 {{ request()->is('workouts*') ? 'font-bold text-gray-700 dark:text-gray-200' : '' }} text-lg">Workout Plans</a>
    <a href="{{ route('calorie.index') }}" class="px-4 text-gray-500 hover:text-gray-700 dark:hover:text-gray-300 {{ request()->is('calorie*') ? 'font-bold text-gray-700 dark:text-gray-200' : '' }} text-lg">Calorie Calculator</a>
    <div class="relative px-4" x-data="{ open: false }">
        <button @click="open = !open" class="text-gray-500 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none {{ request()->is('community*') ? 'font-bold text-gray-700 dark:text-gray-200' : '' }} text-lg">
            Community
        </button>
        <div x-show="open" @click.away="open = false" x-cloak
             class="absolute left-0 mt-2 w-40 bg-white dark:bg-gray-700 rounded-md shadow-lg z-10">
            <a href="{{ route('community.index') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-t-md">Posts</a>
            @auth
            <a href="{{ route('community.messages') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600">Messages</a>
            <a href="{{ route('profile.show', ['user' => Auth::user()->id]) }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600">Profile</a>
            @endauth
        </div>
    </div>
</div>

            <!-- Right-side Auth and Admin Links -->
            <div class="flex items-center">
                @if (Auth::check())
                    <!-- Admin Dropdown -->
                    @if (Auth::user()->role === 'admin')
                        <div class="relative px-4" x-data="{ open: false }">
                            <button @click="open = !open" class="text-gray-500 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none">
                                Admin
                            </button>
                            <div x-show="open" @click.away="open = false" x-cloak
                                 class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-700 rounded-md shadow-lg z-10">
                                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600">Dashboard</a>
                                <a href="{{ route('admin.accounts') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600">Manage Accounts</a>
                                <a href="{{ route('admin.messages') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600">Manage Messages</a>
                            </div>
                        </div>
                    @endif
                    @auth
<!-- Notification Dropdown -->
<div class="relative" x-data="{ open: false }">
    <button @click="open = !open" class="text-gray-500 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none">
        <i class="fas fa-bell"></i>
        <span class="notification-count">{{ auth()->user()->unreadNotifications->count() }}</span>
    </button>
    <div x-show="open" @click.away="open = false" x-cloak class="absolute right-0 mt-2 w-64 bg-white dark:bg-gray-700 rounded-md shadow-lg z-10">
        <div class="py-2 px-4 text-gray-700 dark:text-gray-300">
            <h3 class="font-semibold">Notifications</h3>
            <ul class="notification-list">
                @foreach (auth()->user()->unreadNotifications as $notification)
                    <li class="border-b border-gray-200 dark:border-gray-600 py-2">
                        <a href="{{ $notification->data['url'] }}" class="block hover:bg-gray-100 dark:hover:bg-gray-600 px-2 py-1 rounded">
                            {{ $notification->data['message'] }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endauth

                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                        const bell = document.getElementById('notificationBell');
                        const dropdown = document.getElementById('notificationDropdown');
                        const notificationList = document.getElementById('notificationList');
                        const notificationCount = document.getElementById('notificationCount');

                        async function fetchNotifications() {
                            const response = await fetch('/notifications');
                            const notifications = await response.json();

                            // Update notification count
                            notificationCount.textContent = notifications.length;

                            // Populate dropdown
                            if (notifications.length > 0) {
                                notificationList.innerHTML = notifications.map(notification => {
                                    const data = notification.data;
                                    const link = data.url || '#';
                                    const message = data.message || 'New notification';

                                    return `
                                        <li>
                                            <a href="${link}" class="block px-4 py-2 hover:bg-gray-100" onclick="markAsRead(event, '${notification.id}')">
                                                ${message}
                                            </a>
                                        </li>
                                    `;
                                }).join('');
                            } else {
                                notificationList.innerHTML = `<li class="text-gray-400 text-sm">No new notifications</li>`;
                            }
                        }

                        async function markAsRead(event, id) {
                            event.preventDefault();
                            await fetch(`/notifications/${id}/mark-as-read`, {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                }
                            });
                            fetchNotifications(); // Refresh notifications after marking as read
                        }

                        bell.addEventListener('click', () => {
                            dropdown.classList.toggle('hidden');
                        });

                        fetchNotifications();
                    });
                    </script>


                    <span class="px-4 text-gray-500 dark:text-gray-300 text-lg">Welcome, {{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="px-4 text-gray-500 hover:text-gray-700 dark:hover:text-gray-300 text-lg">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="px-4 text-gray-500 hover:text-gray-700 dark:hover:text-gray-300 text-lg">Login</a>
                    <a href="{{ route('register') }}" class="px-4 text-gray-500 hover:text-gray-700 dark:hover:text-gray-300 text-lg">Sign Up</a>
                @endif
            </div>
        </div>
    </div>
</nav>
