<?php

namespace App\Http\Middleware;

use App\Models\Role;
use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $user = Auth::guard($guard)->user();
                $roleId = $user->role_id;

                switch ($roleId) {
                    case Role::where('name', 'Admin')->first()->id:
                        return redirect()->route('admin.dashboard')->with('message', 'You are currently logged in.');
                    case Role::where('name', 'Validator')->first()->id:
                        return redirect()->route('validator.dashboard')->with('message', 'You are currently logged in.');
                    default:
                        Auth::logout();
                        return redirect()->route('login');
                }
            }
        }

        return $next($request);
    }
}
