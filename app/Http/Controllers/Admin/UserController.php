<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return view('admin.user.index', [
            'user' => $user
        ]);
    }

    public function create()
    {
        $roles = Role::whereNotIn('name', ['Driver'])->get();

        return view('admin.user.create', [
            'roles' => $roles
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'role_id' => [
                'required',
                Rule::in(Role::whereNotIn('name', ['Driver'])->pluck('id')->toArray())
            ],
        ]);

        $user = new User();
        $user->name = $request->input('name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->role_id = $request->input('role_id');
        $user->save();

        return redirect()->route('admin.user')->with('success', 'User created successfully');
    }

    public function edit(User $user)
    {
        $roles = Role::whereNotIn('name', ['Driver'])->get();

        return view('admin.user.edit', [
            'user' => $user,
            'roles' => $roles
        ]);
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id),
            ],
            'password' => 'nullable|string|min:8',
            'role_id' => [
                'required',
                Rule::in(Role::whereNotIn('name', ['Driver'])->pluck('id')->toArray())
            ],
        ]);

        $user->name = $request->input('name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }
        $user->role_id = $request->input('role_id');
        $user->save();

        return redirect()->route('admin.user')->with('success', 'User updated successfully');
    }

    public function destroy(User $user)
    {
        $currentUser = Auth::user();

        if ($user->id === $currentUser->id) {
            return redirect()->route('admin.user')->with('error', 'You cannot delete your own account');
        }

        $user->delete();

        return redirect()->route('admin.user')->with('success', 'User deleted successfully');
    }
}
