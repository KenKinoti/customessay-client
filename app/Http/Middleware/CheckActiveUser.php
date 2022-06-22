<?php

namespace App\Http\Middleware;

use Alert;
use Closure;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CheckActiveUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (!Auth::guard($guard)->check()) {
            return $next($request);
        }

        if (Auth::user()->status == User::DEACTIVATED ) {
            Alert::error(__('auth.deactivated_title'), __('auth.deactivated_message'));
            Auth::logout();

            return redirect(route('login'));
        }

        return $next($request);
    }
}
