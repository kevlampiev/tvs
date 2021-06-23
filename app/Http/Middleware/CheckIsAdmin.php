<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::user()->role!='admin') {
//            Session::flash('error','У Вас нет прав досткпа к разделу администратора');
            return redirect()->route('home')->with('error','У Вас нет прав доступа к разделу администратора');
        }
        return $next($request);
    }
}
