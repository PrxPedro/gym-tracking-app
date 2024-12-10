<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display the admin dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function dashboard()
    {
        return view('admin.dashboard'); // Ensure this view exists in resources/views/admin/dashboard.blade.php
    }

    /**
     * Manage user accounts.
     *
     * @return \Illuminate\View\View
     */
    public function manageAccounts()
    {
        // You can fetch users or any necessary data here
        return view('admin.accounts'); // Ensure this view exists in resources/views/admin/accounts.blade.php
    }

    /**
     * View and manage messages.
     *
     * @return \Illuminate\View\View
     */
    public function manageMessages()
    {
        // Fetch messages or any required data
        return view('admin.messages'); // Ensure this view exists in resources/views/admin/messages.blade.php
    }
}
