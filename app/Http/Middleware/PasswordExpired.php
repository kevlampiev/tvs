<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

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
        $expireDays = Config::get('auth.passwords.users.expire', 30);

        if (is_null($user->password_changed_at) || Carbon::now()->diffInDays($password_changed_at) >= $expireDays) {
            return redirect()->route('password.expired');
        }
        return $next($request);
    }
}
