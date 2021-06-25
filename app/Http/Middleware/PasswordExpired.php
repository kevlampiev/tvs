<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;

class PasswordExpired
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();
        $password_changed_at = new Carbon($user->password_changed_at);

        if (is_null($user->password_changed_at) || Carbon::now()->diffInDays($password_changed_at) >= 30) {
            return redirect()->route('password.expired');
        }
        return $next($request);
    }
}
