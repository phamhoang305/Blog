<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;
use Illuminate\Http\Request;
class CheckPageLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $Request ,Closure $next)
    {
        if (Auth::check()) {
            return redirect()->route('web.home.index')->with('status','Bạn đã nhập rồi vui lòng đăng xuất để thực hiện đăng nhập hoặt đăng ký tài khoản khác !');
        }else {
            return $next($Request);
        }
    }
}
