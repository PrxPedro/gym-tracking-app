import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

import Echo from 'laravel-echo';
window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    forceTLS: true
});

const userId = document.querySelector('meta[name="user-id"]').getAttribute('content');

window.Echo.private('App.Models.User.' + userId)
    .notification((notification) => {
        console.log('New notification:', notification);
        const notificationCount = document.querySelector('.notification-count');
        notificationCount.textContent = parseInt(notificationCount.textContent) + 1;

        const notificationList = document.querySelector('.notification-list');
        const newNotification = document.createElement('li');
        newNotification.classList.add('border-b', 'border-gray-200', 'dark:border-gray-600', 'py-2');
        newNotification.innerHTML = `<a href="${notification.url}" class="block hover:bg-gray-100 dark:hover:bg-gray-600 px-2 py-1 rounded">${notification.message}</a>`;
        notificationList.prepend(newNotification);
    });