<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->is_admin) {
            return $next($request);
        }

        // Nếu không phải admin, chuyển hướng tới trang chủ
        return redirect('/')->with('error', 'Bạn không có quyền truy cập vào trang này.');
    }
}
