<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;
use Illuminate\Http\Request;
class CheckAuthWeb
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
                if(Auth::user()->status==0){
                    return $next($Request);
                }else{
                    $Request->session()->put('url',url()->current());
                    return redirect()->route('web.home.index')->with('status_login','Tài khoản của bạn đã bị khóa !');
                }
            }else {
                $Request->session()->put('url',url()->current());
                return redirect()->route('web.home.index')->with('status_login','Vui lòng đăng nhập để tiếp tục !');
            }
    }
}
