<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $users = User::count();

        $widget = [
            'users' => $users
        ];

        return view('admin.dashboard', [
            'widget' => $widget
        ]);
    }
}
